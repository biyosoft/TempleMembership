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
                        <label for="">Select Customer</label>
                        <select  class="form-control addro" name="customer_id" id="selec">
                            @foreach($memberships as $member)
                                <option value="{{$member->gvBrowseCompanyName}}">{{$member->gvBrowseCompanyName}} - {{$member->gvBrowseAttention}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Item Code</label>
                            <select multiple="multiple"  class="form-control addrow" name="item_code_id[]" id="select">
                                <option value="">--- select --- </option>
                                @foreach($items as $item)
                                    <option value="{{$item->title}} - {{$item->year}}">{{$item->title}} - {{$item->year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Amount</label>
                            <select name="amount" class="form-control"  id="">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                        <label for="">Add </label><br>
                        <a href="javascript:void(0)" class="btn btn-success addrow">+</a>
                    </div>
                    <div class="col-md-2">
                        <label for="">Remove </label><br>
                        <a href="javascript:void(0)" class="btn btn-danger removerow">-</a>
                    </div> -->
                
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


</script>
@endsection