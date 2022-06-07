<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\item;
use App\Models\membership;
use App\Models\payment;
use App\Models\PaymentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $payments = payment::orderByDesc("payment_date")->paginate(10);
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
        $items = item::all();
        $memberships = membership::all();

        return view('payments.create', compact('items', 'memberships', 'member_id'));
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
        // get member and his latest payment
        $member = membership::find($input['member_id']);
        $latest_payment = $member ? item::find($member->item_id) : null;
        $latest_year_found = $latest_payment ? $latest_payment->year : null;

        // Create new payment
        $payment = payment::create([
            'payment_date' => $timeNow->toDateString(),
            'member_id' => $input['member_id'],
            'amount' => $input['amount'],
            'admin_id' => auth()->user()->id,
        ]);

        // From items selected by user find the latest year also save payment details
        $latest_year = 0;
        $latest_year_id = null;
        $items = item::findMany($input['item_code_ids']);
        $items->each(function ($item, $key) use ($payment, $latest_year, $latest_year_id) {
            if ($item->year > $latest_year) {
                $latest_year = $item->year;
                $latest_year_id = $item->id;
            }
            PaymentDetail::create([
                "payment_id" => $payment->id,
                "item_code_id" => $item->id,
                "amount" => $item->amount,
            ]);
        });

        if (is_null($latest_year_found)) {
            $member->item_id = $latest_year_id;
            $member->save();
        } else if ($latest_year_found < $latest_year) {
            $member->item_id = $latest_year_id;
            $member->save();
        }


        if ($input["sibling_ids"]) {
            foreach ($input["sibling_ids"] as $sibling_id) {
                $payment = payment::create([
                    'payment_date' => $timeNow->toDateString(),
                    'member_id' => $sibling_id,
                    'amount' => $input['amount'],
                    'admin_id' => auth()->user()->id,
                ]);

                // get sibling and his latest payment
                $sibling = membership::find($sibling_id);
                $latest_payment = $sibling ? item::find($sibling->item_id) : null;
                $latest_year_found = $latest_payment ? $latest_payment->year : null;

                // From items selected by user find the latest year also save payment details
                $latest_year = 0;
                $latest_year_id = null;
                $items->each(function ($item, $key) use ($payment, $latest_year, $latest_year_id) {
                    if ($item->year > $latest_year) {
                        $latest_year = $item->year;
                        $latest_year_id = $item->id;
                    }
                    PaymentDetail::create([
                        "payment_id" => $payment->id,
                        "item_code_id" => $item->id,
                        "amount" => $item->amount,
                    ]);
                });

                if (is_null($latest_year_found)) {
                    $sibling->item_id = $latest_year_id;
                    $sibling->save();
                } else if ($latest_year_found < $latest_year) {
                    $sibling->item_id = $latest_year_id;
                    $sibling->save();
                }
            }
        }

        return redirect()->route('payments.index')->with('success', 'New Payment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function member_payments($id)
    {
        // get all payments for a member
        $payments = payment::where('member_id', $id)->orderByDesc("payment_date")->paginate(10);
        return view("payments.member_payments", compact("payments"));
    }
}
