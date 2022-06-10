@extends('layouts.main')
@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header">
            <h4>{{ __('labels.payments') }}</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ __('labels.success') }}!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">{{ __('labels.action') }}</th>
                            <th class="border-0">{{ __('labels.member') }}</th>
                            <th class="border-0">{{ __('labels.date') }}</th>
                            <th class="border-0">{{ __('labels.amount') }}</th>
                            <th class="border-0">{{ __('labels.admin_name') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">{{ __('labels.print_receipt') }}</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); const sure = confirm('Sure to delete'); if(sure) document.getElementById('delete-form').submit();">{{ __('labels.delete') }}</a>
                                        <form id="delete-form" action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete" />
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mt-1">{{ $payment->member->gvBrowseCompanyName }} ({{$payment->member->gvBrowseUDF_NOAHLISKMC}})</div>
                                @foreach($payment->paymentDetails as $paymentDetails)
                                <div>
                                    <b>{{ __('labels.item') }}:</b> {{$paymentDetails->parentItem->title}}<br><b>{{ __('labels.amount') }}:</b> @convert($paymentDetails->amount)
                                </div>
                                @endforeach
                            </td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>@convert($payment->amount)</td>
                            <td>{{ $payment->admin->name }}</td>
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