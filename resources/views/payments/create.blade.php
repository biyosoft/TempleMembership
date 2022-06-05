@extends('layouts.main')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card card-body">
            <h4 class="text-center text-info"><i>Add New Payment Here</i></h4>
            <hr>
            <form action="{{route('payments.store')}}" method="POST">
                @csrf
                <div class="row justify-content-center">

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="customer-select">Select Customer</label>
                            <select class="form-control addro" name="member_id" id="customer-select" required>
                                <option value=""></option>
                                @foreach($memberships as $member)
                                <option value="{{$member->id}}">{{$member->gvBrowseCompanyName}} - {{$member->gvBrowseAttention}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="item-select">Item Code</label>
                            <select multiple="multiple" class="form-control addrow" name="item_code_ids[]" id="item-select" required>
                                <option value="">--- select --- </option>
                                @foreach($items as $item)
                                <option data-amount="{{$item->amount}}" value="{{$item->id}}">{{$item->title}} - {{$item->year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="amount-input">Amount</label>
                            <input name="amount" class="form-control" readonly id="amount-input" required/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group mb-3">
                        <button style="float: right;" class="btn btn-info" type="submit">Save Payment</button>
                    </div>
                </div>
        </div>

        </form>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $('.addro').select2({

        placeholder: "Select Customer",
        allowClear: true,
    });

    $('.addrow').select2({
        placeholder: "Select Year",
        allowClear: true,
        tags: true,
        tokenSeparators: [',']
    });

    $("#item-select").on("change", function(event) {
        let totalAmount = 0;

        $(this).find(':selected').each(function() {
            totalAmount += parseInt($(this).data('amount'));
        });

        $('#amount-input').val(totalAmount);
    });
</script>
@endsection