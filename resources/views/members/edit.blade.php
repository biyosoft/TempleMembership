@extends('layouts.main')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-10">
        <div class="card card-body">
            <h2 class="h3 mb-4">{{ __('labels.update_member') }}</h2>
            <form action="{{route('members.update',$members->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">{{ __('labels.member_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseCompanyName}}" name="gvBrowseCompanyName">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">{{ __('labels.head_of_family') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseAttention}}" name="gvBrowseAttention">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.member_skmc_no') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_NOAHLISKMC}}" name="gvBrowseUDF_NOAHLISKMC" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.birthplace') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_TEMPATLAHIR}}" name="gvBrowseUDF_TEMPATLAHIR">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.ic_no') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_ICNO}}" name="gvBrowseUDF_ICNO">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.phone') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowsePhone1}}" name="gvBrowsePhone1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.address') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseAddress1}}" name="gvBrowseAddress1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="Area">{{ __('labels.area') }} <span class="text-danger">*</span></label>
                            <select name="area_id" id="" class="form-control">
                                <option value=""> --- Select --- </option>
                                @foreach($areas as $area)
                                <option {{ $members->area_id == $area->area_id ? "selected" : "" }} value="{{$area->area_id}}">{{$area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.dob') }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{$members->gvBrowseUDF_DOB}}" name="gvBrowseUDF_DOB">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.date_of_application') }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{$members->gvBrowseUDF_TARIKHMEMOHON}}" name="gvBrowseUDF_TARIKHMEMOHON">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.work') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_PEKERJAAN}}" name="gvBrowseUDF_PEKERJAAN">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.gender') }} <span class="text-danger">*</span></label>
                            <select name="gvBrowseUDF_JANTINA" class="form-control">
                                <option value=""> --- Select --- </option>
                                <option {{ $members->gvBrowseUDF_JANTINA == "Lelaki" ? "selected" : "" }} value="Lelaki">LELAKI</option>
                                <option {{ $members->gvBrowseUDF_JANTINA == "Perempuan" ? "selected" : "" }} value="Perempuan">PEREMPUAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option {{ $members->status == "Active" ? "selected" : "" }} value="Active">Active</option>
                                <option {{ $members->status == "Inactive" ? "selected" : "" }} value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.last_payment_year') }} </label>
                            <select class="form-control" name="item_id" id="">
                                <option class="text-center" value=""></option>
                                @foreach($items as $item)
                                <option value="{{$item->id}}" @if($members->item_id == $item->id) selected @endif>{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-primary btn-lg" type="submit">{{ __('labels.update_member') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection