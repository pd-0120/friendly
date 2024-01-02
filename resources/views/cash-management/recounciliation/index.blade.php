@extends('layout.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cash-management.recounciliation.index') }}">Recounciliation</a></li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        @if($authUser->can('add_store'))
        <div class="row mb-3">
            <div class="col-md-12">
                <a class="btn btn-primary" type="button" href="{{ route('cash-management.recounciliation.create') }}">
                    Cash Resounciliation
                </a>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header bg-primary">Clockings</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="clocking-table" width="100%">
                            <thead>
                                <tr>
                                    <td>User</td>
                                    <td>Date</td>
                                    <td>In Time</td>
                                    <td>Out Time</td>
                                    <td>Total Time</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@push('js')
<script>
    $(function () {

    });
</script>
@endpush
