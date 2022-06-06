@extends('layouts.main')
@section('content')
<div class="row mt-4">
    <div class="col-12 col-sm-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="px-xl-0">
                    <h2 class="h5">Customers</h2>
                    <h3 class="fw-extrabold mb-1">{{$memberships_count}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="px-xl-0">
                    <h2 class="h5">Test</h2>
                    <h3 class="fw-extrabold mb-1">0</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="px-xl-0">
                    <h2 class="h5">Test</h2>
                    <h3 class="fw-extrabold mb-1">0</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h4>Customer Per Year for 5 Years</h4>
            </div>
            <div class="card-body">
                @foreach($members_per_year as $index => $member_per_year)
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <div class="h6 mb-0 d-flex align-items-center"><svg class="icon icon-xs text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                            </svg> {{$member_per_year->year}}</div>
                    </div>
                    <div>{{$member_per_year->count}} <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h4>Payments for Last 5 Years</h4>
            </div>
            <div class="card-body">
                @foreach($payments_per_year as $index => $payment_per_year)
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <div class="h6 mb-0 d-flex align-items-center"><svg class="icon icon-xs text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                            </svg> {{$payment_per_year->year}}</div>
                    </div>
                    <div>{{$payment_per_year->sum}} <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection