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
                            <input type="text" class="form-control" value="{{$members->gvBrowseCompanyName}}" name="gvBrowseCompanyName" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">{{ __('labels.head_of_family') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseAttention}}" name="gvBrowseAttention" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.member_skmc_no') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_NOAHLISKMC}}" name="gvBrowseUDF_NOAHLISKMC" readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.birthplace') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_TEMPATLAHIR}}" name="gvBrowseUDF_TEMPATLAHIR" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.ic_no') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_ICNO}}" name="gvBrowseUDF_ICNO" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.phone') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowsePhone1}}" name="gvBrowsePhone1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.address') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseAddress1}}" name="gvBrowseAddress1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="Area">{{ __('labels.area') }} <span class="text-danger">*</span></label>
                            <select name="gvBrowseArea" id="" class="form-control">
                                <option value="{{$members->gvBrowseArea}}">{{$members->gvBrowseArea}}</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->area_name}}">{{$area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.dob') }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{$members->gvBrowseUDF_DOB}}" name="gvBrowseUDF_DOB" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.date_of_application') }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{$members->gvBrowseUDF_TARIKHMEMOHON}}" name="gvBrowseUDF_TARIKHMEMOHON" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.work') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$members->gvBrowseUDF_PEKERJAAN}}" name="gvBrowseUDF_PEKERJAAN" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.gender') }} <span class="text-danger">*</span></label>
                            <select name="gvBrowseUDF_JANTINA" class="form-control" required>
                                <option value="">{{$members->gvBrowseUDF_JANTINA}}</option>
                                <option value="LELAKI">LELAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Status <span class="text-danger">*</span></label>
                            <select class="form-control  @error('status') is-invalid @enderror" name="status"  required>
                                <option class="text-center" value="">{{$members->status}}</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.last_payment_year') }} </label>
                            <select class="form-control" name="item_id" id="">
                                <option class="text-center" value=""></option>
                                @foreach($items as $item)
                                <option value="{{$item->id}}" @if($members->item_id == $item->id) selected @endif>{{$item->title}} - {{$item->year}}</option>
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