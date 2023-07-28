@extends('layouts.main')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card card-body">
            <h2 class="h3 mb-4">{{ __('labels.add_payment') }}</h2>
            <form action="{{route('payments.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer-select">{{ __('labels.select_member_name') }}</label>
                            <select class="form-control select2" name="member_id" id="customer-select" required>
                                <option value=""></option>
                                @foreach($memberships as $member)
                                <option {{$member_id == $member->id ? "selected" : ""}} value="{{$member->id}}">{{$member->gvBrowseCompanyName}} - ({{$member->no_ahli ? $member->no_ahli : 'null'}}) - ({{ $member->item->year ?? "" }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="household-select">{{ __('labels.select_household') }}</label>
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
                            <label for="item-select">{{ __('labels.select_payment_year') }}</label>
                            <select multiple="multiple" class="form-control select2-multiple" name="item_code_ids[]" id="item-select" required>
                                <option value=""> --- select --- </option>
                                @foreach($items as $item)
                                <option data-amount="{{$item->amount}}" value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-none" id="siblings-container">
                        <div class="form-group mb-3">
                            <label for="family-select">{{ __('labels.select_members_name') }}</label>
                            <select multiple="multiple" class="form-control select2-multiple" name="household_ids[]" id="family-select">
                                <option value=""> --- select --- </option>
                            </select>
                        </div>
                    </div>
                </div>
                <input name="amount" class="form-control" readonly id="amount-input" required hidden />
                <div class="d-flex flex-column justify-content-end align-items-end fs-5">
                    <span>{{ __('messages.total_years') }}: <span class="fw-bold" id="total-years-span">0</span></span>
                    <span>{{ __('messages.total_members') }}: <span class="fw-bold" id="total-members-span">0</span></span>
                    <span>{{ __('messages.total_to_be_paid') }}: <span class="fw-bold">RM<span id="amount-span">0</span></span></span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-lg btn-primary" type="submit">{{ __('labels.save_payment') }}</button>
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

            const selectedItems = $(this).val();
            selectedItemsCount = selectedItems.length;

            const selectedMembers = $("#family-select").val()
            const selectedMembersCount = selectedMembers.length;

            if (selectedMembersCount > 1) {
                total = total * selectedMembersCount;
            }
            $('#amount-input').val(total);
            $('#amount-span').text(thousandSeparator(total));
            $("#total-years-span").text(selectedItemsCount);
        });

        $("#customer-select").on("change", function(event) {
            const selectedValue = $(this).val();
            if (selectedValue === "") {
                $("#household-select").prop("disabled", false);
                $("#total-members-span").text(0);
            } else {
                $("#household-select").prop("disabled", true);
                $("#total-members-span").text(1);
            }
        });

        $("#household-select").on("change", function(event) {
            const selectedValue = $(this).val();
            $("#family-select").html('<option value="">--- select --- </option>');
            $("#family-select").trigger("change");
            if (selectedValue === "") {
                $("#siblings-container").addClass("d-none");
                $("#customer-select").prop("disabled", false);
                $("#family-select").prop("required", false);
            } else {
                $("#customer-select").prop("disabled", true);
                $("#siblings-container").removeClass("d-none");

                const selectedMember = members.find(member => member.id == selectedValue);
                siblings = members.filter(member => member.gvBrowseAttention == selectedMember.gvBrowseAttention);
                if (siblings.length > 0) {
                    let html = ``;
                    $.each(siblings, function(index, sibling) {
                            html += `<option value="${sibling.id}">${sibling.gvBrowseCompanyName} (${sibling.gvBrowseUDF_NOAHLISKMC}) - (${sibling.item?.year ? sibling.item.year : ""})</option>`;
                    });
                    $('#family-select').html(html);
                    $("#family-select").prop("required", true);
                }
            }
        });

        $("#family-select").on("change", function(event) {
            const selectedMembers = $(this).val();
            const selectedMembersCount = selectedMembers.length;
            $("#total-members-span").text(selectedMembersCount);

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