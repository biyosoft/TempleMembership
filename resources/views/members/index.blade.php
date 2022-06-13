@extends('layouts.main')
@section('content')
<style>
    .table-responsive.col-md-12{
        min-height: 500px;
    }
</style>
<div class="mt-4">
    <div class="card card-body">
        <livewire:membership-table />
    </div>
</div>
@endsection