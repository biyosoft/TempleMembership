@extends('layouts.main')
@section('content')
 <div class="row justify-content-center mt-4">
     <div class="col-md-10">
        <div class="card card-body">
                <h4 class="text-center text-info"><i>Add new Member Here</i></h4>
                <hr>
                <form action="{{route('members.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Code</label>
                                <input type="text" class="form-control" name="gvBrowseCode">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="">Company Name</label>
                                <input type="text" class="form-control" name="gvBrowseCompanyName">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="">Keluarga</label>
                                <input type="text" class="form-control" name="gvBrowseAttention">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Tempat Lahir</label>
                                <input type="text" class="form-control" name="gvBrowseUDF_TEMPATLAHIR">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">IC NO</label>
                                <input type="text" class="form-control" name="gvBrowseUDF_ICNO">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Phone 1</label>
                                <input type="text" class="form-control" name="gvBrowsePhone1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Address 1</label>
                                <input type="text" class="form-control" name="gvBrowseAddress1"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="Area">Area</label>
                                <input type="text" class="form-control" name="gvBrowseArea">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">D.O.B</label>
                                <input type="text" class="form-control" name="gvBrowseUDF_DOB">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">NO AHLI SKMC</label>
                                <input type="text" class="form-control" name="gvBrowseUDF_NOAHLISKMC">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Tarikh MEMOHON</label>
                                <input type="text" class="form-control" name="gvBrowseUDF_TARIKHMEMOHON">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <label for="">PEKERJAAN</label>
                            <input type="text" class="form-control" name="gvBrowseUDF_PEKERJAAN">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">JANTINA</label>
                                <input type="text" class="form-control" name="gvBrowseUDF_JANTINA">
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group mb-3">
                                <label for="">Last Payment Year</label>
                                <select class="form-control" name="item_id" id="">
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->title}} - {{$item->year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div  class="col-md-4 mt-4">
                        <div class="form-group mb-3">
                            <button style="margin-top: 7px;" class="btn  btn-info" type="submit">Save Member</button>
                        </div>
                    </div>
                    </div>

                    
                </form>
        </div>
     </div>
 </div>
@endsection