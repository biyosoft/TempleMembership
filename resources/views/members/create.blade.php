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
                            <label for="">{{ __('labels.member_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('gvBrowseCompanyName') is-invalid @enderror" name="gvBrowseCompanyName" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">{{ __('labels.head_of_family') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('gvBrowseAttention') is-invalid @enderror" name="gvBrowseAttention" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.member_skmc_no') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('gvBrowseUDF_NOAHLISKMC') is-invalid @enderror" name="gvBrowseUDF_NOAHLISKMC" readonly value="{{ $no_ahli_skmc }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.birthplace') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control  @error('gvBrowseUDF_TEMPATLAHIR') is-invalid @enderror" name="gvBrowseUDF_TEMPATLAHIR" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.ic_no') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control  @error('gvBrowseUDF_ICNO') is-invalid @enderror" name="gvBrowseUDF_ICNO" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.phone') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control  @error('gvBrowsePhone1') is-invalid @enderror" name="gvBrowsePhone1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.address') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control  @error('gvBrowseAddress1') is-invalid @enderror" name="gvBrowseAddress1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="Area">{{ __('labels.area') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="area_id" id="" required>
                                <option class="text-center" value="">---select---</option>
                                @foreach($areas as $area)
                                 <option class="text-center" value="{{$area->id}}">{{$area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.dob') }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control  @error('gvBrowseUDF_DOB') is-invalid @enderror" name="gvBrowseUDF_DOB" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.date_of_application') }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control  @error('gvBrowseUDF_TARIKHMEMOHON') is-invalid @enderror" name="gvBrowseUDF_TARIKHMEMOHON" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.work') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control  @error('gvBrowseUDF_PEKERJAAN') is-invalid @enderror" name="gvBrowseUDF_PEKERJAAN">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.gender') }} <span class="text-danger">*</span></label>
                            <select class="form-control  @error('gvBrowseUDF_JANTINA') is-invalid @enderror" name="gvBrowseUDF_JANTINA"  required>
                                <option class="text-center" value="">---select---</option>
                                <option value="LELAKI">LELAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">Status <span class="text-danger">*</span></label>
                            <select class="form-control  @error('status') is-invalid @enderror" name="status"  required>
                                <option class="text-center" value="">---select---</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.last_payment_year') }} </label>
                            <select class="form-control  @error('item_id') is-invalid @enderror" name="item_id" id="">
                                <option class="text-center" value="">--- select ---</option>
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