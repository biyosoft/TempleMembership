@extends('layouts.main')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <center> -->

<div class="row">
    <div class="col-12 col-sm-12 mb-12">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h4 class="h5">Export Customer Payment Report</h4>
            </div>
            <div class="card-body">
                <div style="margin-top: 20px; margin-bottom: 50px; margin-left: 10px;">
                    <form action="{{route('payments.export_customer_payment')}}" method="GET">
                        <div class="row">
                            <div class="col-sm-3">
                                <b><strong class="h6" style="margin-left: 5px;"> From </strong></b><br>
                                <input class="form-control" type="date" name="from_date" required>
                            </div>
                            <div class="col-sm-3">
                                <b><strong class="h6" style="margin-left: 5px;"> To </strong></b><br>
                                <input class="form-control" type="date" name="to_date" required>
                            </div>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-lg btn-primary">Export</button>
                    </form>
                    <!-- <a href="{{route('payments.export')}}"><button class="btn btn-warning btn-block">Click here to Export Payments Report</button></a> -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- </center> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "Select household",
            allowClear: true,
            closeOnSelect: false
        });
    });
    $(".js-programmatic-enable").on("click", function() {
        $(".js-example-basic-multiple").prop("disabled", false);
        $(".js-example-basic-multiple-multi").prop("disabled", false);
    });
</script>
@endsection
