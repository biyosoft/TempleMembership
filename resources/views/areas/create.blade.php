@extends('layouts.main')
@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-md-4">
        <div class="card card-body">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <h2 class="h4 mb-4">{{ __('labels.add_area') }}</h2>
            <form action="{{route('areas.store')}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.title') }} <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="area_name" required>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary  mt-2 text-white">{{ __('labels.save_new_area') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
