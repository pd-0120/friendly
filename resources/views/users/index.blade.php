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
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <a class="btn btn-primary" type="button" href="{{ route('user.create') }}">
                    Add New User
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-primary">Users</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="user-table" width="100%">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Phone</td>
                                    <td>Stores</td>
                                    <td>Actions</td>
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
            const datatable = $('#user-table').DataTable({
				processing:true,
				pageLength: 20,
				lengthMenu: [
					[10,20,40,80,-1], [10, 20,40,80,"All"]
				],
				serverSide: true,
				scrollX: true,
				ajax: route('user.index'),
				columns:[
					{data:'name' , name:'name'},
					{data:'user_detail.phone' , name:'name'},
					{data:'email' , name:'email'},
					{data:'action' , name:'action', orderable: false, searchable:false},
				]
			});
        });
    </script>
@endpush
