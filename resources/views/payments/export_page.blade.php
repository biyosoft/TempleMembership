@extends('layouts.main')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <center> -->
    <div>
        @php
            $members = get_all_members();
        @endphp       
    </div>
    <div style="margin-top: 20px; margin-left: 10px;">
    <form action="{{route('payments.export')}}" method="GET">
    <label for="">
        Select household below for filtration:
        <select style="width: 60%;" class="js-example-basic-multiple" name="household[]" multiple="multiple">
            @foreach($members as $member)
                <option value="<?= $member->id; ?>"><?= $member->gvBrowseAttention; ?></option>
            @endforeach
        </select>
    </label>
        <br><br>
        <button type="submit" class="btn btn-warning btn-block">Click here to Export Payments Report</button>
    </form>
        <!-- <a href="{{route('payments.export')}}"><button class="btn btn-warning btn-block">Click here to Export Payments Report</button></a> -->
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
        $(".js-programmatic-enable").on("click", function () {
        $(".js-example-basic-multiple").prop("disabled", false);
        $(".js-example-basic-multiple-multi").prop("disabled", false);
});
</script>
@endsection
