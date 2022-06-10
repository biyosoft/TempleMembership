@extends('layouts.main')
@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-md-4">
        <div class="card card-body">
            <h2 class="h3 mb-4">{{ __('labels.update_item_code') }}</h2>
            <form action="{{route('items.update', $item->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.title') }}</label>
                    <input type="text" class="form-control" name="title" placeholder="Member_fee-2020" value="{{$item->title}}">
                </div>
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.year') }}</label>
                    <input type="number" name="year" class="form-control" min="1900" max="2099" step="1" value="{{$item->year}}" />
                </div>
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.amount_u') }}</label>
                    <input type="text" class="form-control" name="amount" value="{{$item->amount}}">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary btn-lg mt-2">{{ __('labels.update_item_code') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection