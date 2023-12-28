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
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        @if($authUser->can('add_role'))
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('role.create') }}" class="btn btn-primary" type="button">
                    Add New Role
                </a>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header bg-primary">Roles</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="role-table" width="100%">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Guard</td>
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
    $(function() {
        const datatable = $('#role-table').DataTable({
            processing: true,
            pageLength: 20,
            lengthMenu: [
                [10,20,40,80,-1], [10, 20,40,80,"All"]
            ],
            serverSide: true,
            scrollX: true,
            ajax: route('role.index'),
            columns: [{
                data: 'name', name: 'name',
            },{
                data: 'guard_name', name: 'guard_name',
            },{
                data: 'action', name: 'action',orderable: false, searchable:false
            }]
        });

        $(document).on('click', '.delete-btn', function() {
                Swal.fire({
                title: 'Do you really want to perforn this action ?',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Yes !',
                showLoaderOnConfirm: true,
                preConfirm: (id) => {
                    var id = $(this).data('id');
                    return axios.delete(route('role.delete', id))
                    .then(res => {
                        return res.data;
                    })
                    .catch(error => {
                        return res.data;
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: result.value.message,
                    })
                    datatable.ajax.reload()
                }
                })
            })
    })
</script>
@endpush

