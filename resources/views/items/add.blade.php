@extends('layouts.main')
@section('content')
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card card-body">
        <livewire:item-table/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-body">
            <h4 class="text-center text-success"><i>Add New Item</i></h4>
            <hr>
            <form action="{{route('items.store')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Member_fee-2020">
                </div>
                <div class="form-group mb-3">
                    <label for="">Year</label>
                    <input type="number" name="year" class="form-control" min="1900" max="2099" step="1" value="2016" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Amount</label>
                    <input type="text" class="form-control" name="amount">
                </div>
                <button type="submit" class="btn btn-success mt-2 text-white">save</button>
            </form>
        </div>
    </div>
</div>
@endsection