@extends('layouts.main')
@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-md-4">
        <div class="card card-body">
            <h2 class="h3 mb-4">Update Area</h2>
            <form action="{{route('areas.update', $area->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="">{{ __('labels.title') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="area_name" placeholder="Member_fee-2020" value="{{$area->area_name}}" required>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary btn-lg mt-2">Update Area</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection