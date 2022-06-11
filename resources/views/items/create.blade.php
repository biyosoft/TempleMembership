@extends('layouts.main')
@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-md-4">
        <div class="card card-body">
            <h2 class="h3 mb-4">{{ __('labels.add_item_code') }}</h2>
            <form action="{{route('items.store')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.title') }} <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.year') }} <span class="text-danger">*</span></label>
                    <input type="number" name="year" class="form-control" min="1900" max="2099" step="1" required>
                </div>
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.amount_u') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="amount" required>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary btn-lg mt-2 text-white">{{ __('labels.save_item_code') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection