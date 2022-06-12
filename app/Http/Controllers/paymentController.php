<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\item;
use App\Models\payment;
use App\Models\membership;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePaymentRequest;

class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get paginated payments
        $payments = payment::orderByDesc("id")->paginate(10);
        return view("payments.index", compact("payments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $member_id = request()->input("member_id");
        $member_id = $member_id ? $member_id : "";
        
        $items = item::orderBy("year")->get();
        $memberships = membership::orderBy('gvBrowseCompanyName')->get();
        $households = DB::table("memberships")
            ->select(DB::raw("min(id) id, gvBrowseAttention household"))
            ->where("deleted_at", "=", null)
            ->groupBy("gvBrowseAttention")
            ->orderBy("gvBrowseAttention")
            ->get();
        
        return view('payments.create', compact('items', 'memberships', 'member_id', 'households'));
    }

    /**
     * Store a newly created resource in storage.
     * First find member by id then find his latest payment, create new payment, then save item details in payment details
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        // validate input
        $input = $request->all();
        
        $timeNow = Carbon::now();

        // generate receipt_id
        $max_receipt_id = payment::withTrashed()->max('receipt_id');
        $receipt_id = $max_receipt_id ? $max_receipt_id + 1 : 1;
        $receiptId = $receipt_id;

        // check if member_id exists or not
        if (array_key_exists("member_id", $input)) {
            $member = membership::findOrFail($input["member_id"]);

            // save member payment
            $payment = new payment;
            $payment->member_id = $member->id;
            $payment->payment_date = $timeNow->toDateString();
            $payment->amount = $input["amount"];
            $payment->admin_id = auth()->user()->id;
            $payment->receipt_id = $receipt_id;
            $payment->save();
            
            $receiptId = $receipt_id;
            $memberItem = $member->item;
            $memberYear = $memberItem ? $memberItem->year : 0;

            $latest_year = 0;
            $latest_year_item_id = null;

            // save payment details
            foreach ($input["item_code_ids"] as $key => $item_id) {
                $item = item::findOrFail($item_id);

                if ($item->year > $latest_year) {
                    $latest_year = $item->year;
                    $latest_year_item_id = $item->id;
                }

                $payment_detail = PaymentDetail::create([
                    'payment_id' => $payment->id,
                    'item_code_id' => $item->id,
                    'amount' => $item->amount,
                ]);
            }

            if (is_null($memberYear) || $memberYear < $latest_year) {
                $member->item_id = $latest_year_item_id;
                $member->save();
            }

            return redirect()->route('payments.index')->with('success', __('messages.payment_created_successfully'))
            ->with('receiptId',$receiptId);
        }

        foreach ($input["household_ids"] as $key => $member_id) {
            $member = membership::findOrFail($member_id);

            // save member payment
            $payment = new payment;
            $payment->member_id = $member->id;
            $payment->payment_date = $timeNow->toDateString();
            $payment->amount = $input["amount"] / count($input["household_ids"]);
            $payment->admin_id = auth()->user()->id;
            $payment->receipt_id = $receipt_id;
            $payment->save();

            $receiptId = $receipt_id;
            $memberItem = $member->item;
            $memberYear = $memberItem ? $memberItem->year : 0;

            $latest_year = 0;
            $latest_year_item_id = null;

            // save payment details
            foreach ($input["item_code_ids"] as $key => $item_id) {
                $item = item::findOrFail($item_id);

                if ($item->year > $latest_year) {
                    $latest_year = $item->year;
                    $latest_year_item_id = $item->id;
                }

                $payment_detail = PaymentDetail::create([
                    'payment_id' => $payment->id,
                    'item_code_id' => $item->id,
                    'amount' => $item->amount,
                ]);
            }

            if (is_null($memberYear) || $memberYear < $latest_year) {
                $member->item_id = $latest_year_item_id;
                $member->save();
            }
        }

        if (count($input["household_ids"]) > 1) {
            return redirect()->route('payments.index')->with('success', __('messages.payments_created_successfully'))
            ->with('receiptId',$receiptId);
        }
        return redirect()->route('payments.index')->with('success', __('messages.payment_created_successfully'))
        ->with('receiptId',$receiptId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
        // delete payment details
        foreach ($payment->paymentDetails as $paymentDetail) {
            $paymentDetail->delete();
        }
        // delete payment
        $payment->delete();

        return redirect()->route('payments.index')->with('success', __('messages.payment_deleted_successfully'));
    }

    public function member_payments($id)
    {
        // get all payments for a member
        $payments = payment::where('member_id', $id)->orderByDesc("id")->paginate(10);
        return view("payments.member_payments", compact("payments"));
    }

     /**
     * pass the id for receipt
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function receipt($id)
    {
        $payments = payment::where('receipt_id' , $id)->get();  
        $amount_sum = payment::where('receipt_id' , $id)->sum('amount');  
        $member_count = payment::where('receipt_id' , $id)->count('member_id'); 
        
        return view('payments.receipt',compact('payments','amount_sum','member_count'));
    }
}
