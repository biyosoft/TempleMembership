@extends('layouts.main')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card card-body">
            <h4 class="text-center text-info"><i>Add New Payment Here</i></h4>
            <hr>
            <form action="{{route('payments.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer-select">Select Customer</label>
                            <select class="form-control select2" name="member_id" id="customer-select" required>
                                <option value=""></option>
                                @foreach($memberships as $member)
                                <option {{$member_id == $member->id ? "selected" : ""}} value="{{$member->id}}">{{$member->gvBrowseCompanyName}} - {{$member->gvBrowseAttention}} ({{$member->gvBrowseCode}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="household-select">Select Household</label>
                            <select id="household-select" class="form-control select2">
                                <option value=""></option>
                                @foreach($households as $household)
                                <option value="{{$household->id}}">{{$household->household}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="item-select">Item Code</label>
                            <select multiple="multiple" class="form-control select2-multiple" name="item_code_ids[]" id="item-select" required>
                                <option value=""> --- select --- </option>
                                @foreach($items as $item)
                                <option data-amount="{{$item->amount}}" value="{{$item->id}}">{{$item->title}} - {{$item->year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-none" id="siblings-container">
                        <div class="form-group mb-3">
                            <label for="family-select">Select Members</label>
                            <select multiple="multiple" class="form-control select2-multiple" name="household_ids[]" id="family-select">
                                <option value=""> --- select --- </option>
                            </select>
                        </div>
                    </div>
                </div>
                <input name="amount" class="form-control" readonly id="amount-input" required hidden />
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-info d-inline-block" type="submit">Save Payment</button>
                    <span class="fs-3">RM<span class="fs-3" id="amount-span">0</span></span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        const members = <?= json_encode($memberships) ?>;
        let siblings = [];

        $('.select2').select2({
            placeholder: "Select",
            allowClear: true,
            width: "100%"
        });

        $('.select2-multiple').select2({
            placeholder: "Select",
            allowClear: true,
            tags: true,
            tokenSeparators: [','],
            width: "100%"
        });

        $("#item-select").on("change", function(event) {
            let total = totalAmount();

            const selectedMembers = $("#family-select").val()
            const selectedMembersCount = selectedMembers.length;

            if (selectedMembersCount > 1) {
                total = total * selectedMembersCount;
            }
            $('#amount-input').val(total);
            $('#amount-span').text(thousandSeparator(total));

        });

        $("#customer-select").on("change", function(event) {
            const selectedValue = $(this).val();
            if (selectedValue === "") {
                $("#household-select").prop("disabled", false);
            } else {
                $("#household-select").prop("disabled", true);
            }
        });

        $("#household-select").on("change", function(event) {
            const selectedValue = $(this).val();
            if (selectedValue === "") {
                $("#siblings-container").addClass("d-none");
                $("#customer-select").prop("disabled", false);
                $("#family-select").prop("required", false);
                $("#family-select").html('<option value="">--- select --- </option>');
            } else {
                $("#customer-select").prop("disabled", true);
                $("#siblings-container").removeClass("d-none");

                const selectedMember = members.find(member => member.id == selectedValue);
                siblings = members.filter(member => member.gvBrowseAttention == selectedMember.gvBrowseAttention);

                if (siblings.length > 0) {
                    let html = ``;
                    $.each(siblings, function(index, sibling) {
                        html += `<option value="${sibling.id}">${sibling.gvBrowseCompanyName} - ${sibling.gvBrowseAttention} ( ${sibling.gvBrowseCode} )</option>`;
                    });
                    $('#family-select').html(html);
                    $("#family-select").prop("required", true);
                }
            }
        });

        $("#family-select").on("change", function(event) {
            const selectedMembers = $(this).val();
            const selectedMembersCount = selectedMembers.length;

            if (selectedMembersCount > 0) {
                const total = totalAmount();
                $('#amount-input').val(total * selectedMembersCount);
                $('#amount-span').text(thousandSeparator(total * selectedMembersCount));
            }
        });

        function totalAmount() {
            const element = $("#item-select");
            let totalAmount = 0;

            element.find(':selected').each(function() {
                totalAmount += parseInt($(this).data('amount'));
            });

            return totalAmount;
        }

        function thousandSeparator(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });
</script>
@endsection