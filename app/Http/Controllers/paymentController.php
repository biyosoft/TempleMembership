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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class paymentController extends Controller
{
    public $check;
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
        
        // $items = item::where('year','2023')->get();
        $items = item::orderBy("year")->get();
        $memberships = membership::orderBy('gvBrowseCompanyName')->where('status','Active')->get();
        $households = DB::table("memberships")
            ->select(DB::raw("min(id) id, gvBrowseAttention household"))
            ->where("deleted_at", "=", null)
            ->where('status' ,'!=' , 'Inactive')
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

    public function export_page()
    {
        $payments = payment::orderByDesc("id")->paginate(10);
        return view("payments.export_page", compact("payments"));
    }

    public function export(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // echo $from_date.' / '.$to_date;die;
        if (!empty($from_date) && !empty($to_date)) {
            $payments = payment::orderBy("items.title", "asc")
            ->leftJoin('payment_details', 'payments.id', '=', 'payment_details.payment_id')
            ->leftJoin('items', 'payment_details.item_code_id', '=', 'items.id')
            ->whereBetween('payment_date', ["$from_date", "$to_date"])
            ->get();
        }else{
            $payments = payment::orderBy("items.title", "asc")
            ->leftJoin('payment_details', 'payments.id', '=', 'payment_details.payment_id')
            ->leftJoin('items', 'payment_details.item_code_id', '=', 'items.id')
            ->get();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $table_columns = array("DOCNO(20)", "CODE(10)", "DOCDATE", "TERMS(10)", "DESCRIPTION_HDR(200)", "AREA(10)", "AGENT(10)", "PROJECT_HDR(20)", "CURRENCYRATE", "DOCAMT", "CANCELLED(1)", "SEQ", "PROJECT_DTL(20)", "ACCOUNT(10)", "DESCRIPTION_DTL(200)", "TAX(10)", "TAXAMT", "TAXINCLUSIVE", "AMOUNT", "DOCTYPE");

			$column = 1;

			foreach($table_columns as $field)
			{
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
				$spreadsheet->getActiveSheet()->getStyleByColumnAndRow($column, 1)->getFont()->setBold(true);
				$column++;
			}
            $row = 2;
            // $all_data = array(1, 2, 3);
            $count = 1;
            $SEQ = 0;
			foreach ($payments as $payment) {
                $year = $payment->title;
                if ($year != $this->check) {
                    $SEQ++;
                }
                $this->check = $year;
                
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $payment->receipt_no);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $payment->member->gvBrowseCode);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $payment->payment_date);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $row, "C.O.D");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $row, "Free");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $row, find_area_by_id($payment->member->area_id));
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $row, "----");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $row, "----");
                $spreadsheet->getActiveSheet()->getCell("I$row")->setValueExplicit('1.00', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $payment->amount);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(11, $row, "F");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $SEQ);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(13, $row, "----");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(14, $row, "500-000");
                // foreach ($payment->paymentDetails as $paymentDetails) {
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(15, $row, "member fee - ".$payment->title);
                // }
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(16, $row, "");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(17, $row, "");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(18, $row, "");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(19, $row, "10");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(20, $row, "1");
                for ($i = 'A'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
                    $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
                }

				$row++;
                $count++;
			}

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Invoice-Report' . time() . '.xlsx"');
        header('Cache-Control: max-age=0');

        $xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        exit($xlsxWriter->save('php://output'));

    }

    public function export_customer_payment_page()
    {
        $payments = payment::orderByDesc("id")->paginate(10);
        return view("payments.export_customer_payment_page", compact("payments"));
    }

    public function export_customer_payment(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // echo $from_date.' / '.$to_date;die;
        if (!empty($from_date) && !empty($to_date)) {
            $payments = payment::orderBy("items.title", "asc")
            ->leftJoin('payment_details', 'payments.id', '=', 'payment_details.payment_id')
            ->leftJoin('items', 'payment_details.item_code_id', '=', 'items.id')
            ->whereBetween('payment_date', ["$from_date", "$to_date"])
            ->get();
        }else{
            $payments = payment::orderBy("items.title", "asc")
            ->leftJoin('payment_details', 'payments.id', '=', 'payment_details.payment_id')
            ->leftJoin('items', 'payment_details.item_code_id', '=', 'items.id')
            ->get();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $table_columns = array("DOCNO(20)", "CODE(10)", "DOCDATE", "POSTDATE", "DESCRIPTION(200)", "AREA(10)", "AGENT(10)", "PAYMENTMETHOD(10)", "CHEQUENUMBER(20)", "PROJECT(20)", "PAYMENTPROJECT(20)", "CURRENCYRATE", "BANKCHARGE", "DOCAMT", "UNAPPLIEDAMT", "CANCELLED", "NONREFUNDABLE", "BOUNCEDATE", "DOCTYPE", "KODOCNO", "KOAMT");

			$column = 1;

			foreach($table_columns as $field)
			{
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
				$spreadsheet->getActiveSheet()->getStyleByColumnAndRow($column, 1)->getFont()->setBold(true);
				$column++;
			}
            $row = 2;
            // $all_data = array(1, 2, 3);
            $count = 1;
            $SEQ = 0;
			foreach ($payments as $payment) {
                $year = $payment->title;
                if ($year != $this->check) {
                    $SEQ++;
                }
                $this->check = $year;
                
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $payment->receipt_no);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $payment->member->gvBrowseCode);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $payment->payment_date);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $payment->payment_date);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $row, "Payment for A/c");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $row, find_area_by_id($payment->member->area_id));
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $row, "----");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $row, "500-000");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(9, $row, "");
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(10, $row, "---");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(11, $row, "---");
                $spreadsheet->getActiveSheet()->getCell("L$row")->setValueExplicit('1.00', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(13, $row, "0");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $payment->amount);
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(15, $row, "0");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(16, $row, "F");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(17, $row, "0");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(18, $row, "");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(19, $row, "IV");
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $payment->receipt_no);
				$spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $payment->amount);
                for ($i = 'A'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
                    $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
                }

				$row++;
                $count++;
			}

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Customer-Payments' . time() . '.xlsx"');
        header('Cache-Control: max-age=0');

        $xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        exit($xlsxWriter->save('php://output'));

    }

    
}
