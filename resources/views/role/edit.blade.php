@extends('layout.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Stores</a></li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary">Edit <b>{{ $role->name }}</b> Role and assign Permissions</div>
            <div class="card-body">
                @livewire('role-component', ['role' => $role])
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
