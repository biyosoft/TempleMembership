@extends('layouts.main')
@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Payments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">Member</th>
                            <th class="border-0">Date</th>
                            <th class="border-0">Amount</th>
                            <th class="border-0">Admin Name</th>
                            <th class="border-0"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>
                                <div class="mt-1">{{ $payment->member->gvBrowseCompanyName }} ({{$payment->member->gvBrowseCode}})</div>
                                @foreach($payment->paymentDetails as $paymentDetails)
                                <div>
                                    <b>Item:</b> {{$paymentDetails->parentItem->title}}<br><b>Amount:</b> @convert($paymentDetails->amount)
                                </div>
                                @endforeach
                            </td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>@convert($payment->amount)</td>
                            <td>{{ $payment->admin->name }}</td>
                            <td><a href="#" class="btn btn-sm btn-github">Print Receipt</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{{ $payments->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection