@extends('layouts.main')
@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-md-4">
        <div class="card card-body">
            <h4 class="text-center text-success"><i>Update Item</i></h4>
            <hr>
            <form action="{{route('items.update', $item->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Member_fee-2020" value="{{$item->title}}">
                </div>
                <div class="form-group mb-3">
                    <label for="">Year</label>
                    <input type="number" name="year" class="form-control" min="1900" max="2099" step="1" value="{{$item->year}}" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Amount</label>
                    <input type="text" class="form-control" name="amount" value="{{$item->amount}}">
                </div>
                <button type="submit" class="btn btn-success mt-2 text-white">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection