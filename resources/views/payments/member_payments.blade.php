@extends('layouts.main')
@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header">
            <h4>{{$payments[0] ? $payments[0]->member->gvBrowseCompanyName : ""}}'s Payments</h4>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="mt-1">{{ $payment->member->gvBrowseCompanyName }}</div>
                                @foreach($payment->paymentDetails as $paymentDetails)
                                <div>
                                    <b>Item:</b> {{$paymentDetails->parentItem->title}}<br><b>Amount:</b> {{$paymentDetails->amount}}
                                </div>
                                @endforeach
                            </td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->admin->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection