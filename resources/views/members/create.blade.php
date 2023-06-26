@extends('layouts.main')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-10">
        <div class="card card-body">
            <h2 class="h3 mb-4">{{ __('labels.add_member') }}</h2>
            <form action="{{route('members.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">{{ __('labels.member_name') }}</label>
                            <input type="text" class="form-control " name="gvBrowseCompanyName" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">{{ __('labels.head_of_family') }}</label>
                            <input type="text" class="form-control" name="gvBrowseAttention" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.no_ahli') }}</label>
                            <input type="text" class="form-control " name="no_ahli"  value="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.member_skmc_no') }}</label>
                            <input type="text" class="form-control " name="gvBrowseUDF_NOAHLISKMC"  value="{{ $no_ahli_skmc }}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.birthplace') }}</label>
                            <input type="text" class="form-control  " name="gvBrowseUDF_TEMPATLAHIR" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.ic_no') }}</label>
                            <input type="text" class="form-control  " name="gvBrowseUDF_ICNO" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.phone') }}</label>
                            <input type="text" class="form-control  " name="gvBrowsePhone1" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.address') }}</label>
                            <input type="text" class="form-control  " name="gvBrowseAddress1" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="Area">{{ __('labels.area') }}</label>
                            <select class="form-control" name="area_id" id="" >
                                <option class="text-center" value=""> --- Select --- </option>
                                @foreach($areas as $area)
                                 <option class="text-center" value="{{$area->id}}">{{$area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.dob') }}</label>
                            <input type="date" class="form-control  " name="gvBrowseUDF_DOB" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.date_of_application') }}</label>
                            <input type="date" class="form-control  " name="gvBrowseUDF_TARIKHMEMOHON" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.work') }}</label>
                            <input type="text" class="form-control  " name="gvBrowseUDF_PEKERJAAN">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.gender') }}</label>
                            <select class="form-control  " name="gvBrowseUDF_JANTINA"  >
                                <option class="text-center" value=""> --- Select --- </option>
                                <option value="LELAKI">LELAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Status</label>
                            <select class="form-control  " name="status"  >
                                <option class="text-center" value=""> --- Select --- </option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.last_payment_year') }} </label>
                            <select class="form-control  " name="item_id" id="">
                                <option class="text-center" value=""> --- Select --- </option>
                                @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary btn-lg" type="submit">{{ __('labels.save_member') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('.select2').select2({
            placeholder: "Select",
            allowClear: true,
            width: "100%"
        });

    });
</script>
@endsection