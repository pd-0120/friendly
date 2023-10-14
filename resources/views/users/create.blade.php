@extends('layout.app')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary">Add User</div>
            <div class="card-body">
                @livewire('user-component')
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
