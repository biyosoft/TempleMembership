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
                            <input type="text" class="form-control" name="gvBrowseCompanyName" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="">{{ __('labels.head_of_family') }}</label>
                            <input type="text" class="form-control" name="gvBrowseAttention" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.member_skmc_no') }}</label>
                            <input type="text" class="form-control" name="gvBrowseUDF_NOAHLISKMC" readonly value="{{ $no_ahli_skmc }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.birthplace') }}</label>
                            <input type="text" class="form-control" name="gvBrowseUDF_TEMPATLAHIR" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.ic_no') }}</label>
                            <input type="text" class="form-control" name="gvBrowseUDF_ICNO" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.phone') }}</label>
                            <input type="text" class="form-control" name="gvBrowsePhone1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.address') }}</label>
                            <input type="text" class="form-control" name="gvBrowseAddress1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="Area">{{ __('labels.area') }}</label>
                            <input type="text" class="form-control" name="gvBrowseArea" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.dob') }}</label>
                            <input type="date" class="form-control" name="gvBrowseUDF_DOB" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.date_of_application') }}</label>
                            <input type="date" class="form-control" name="gvBrowseUDF_TARIKHMEMOHON" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.work') }}</label>
                            <input type="text" class="form-control" name="gvBrowseUDF_PEKERJAAN">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.gender') }}</label>
                            <input type="text" class="form-control" name="gvBrowseUDF_JANTINA" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="">{{ __('labels.last_payment_year') }}</label>
                            <select class="form-control" name="item_id" id="">
                                @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->title}} - {{$item->year}}</option>
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