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
                    <li class="breadcrumb-item"><a href="{{ route('pay.index') }}">Users Pay</a></li>
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
                <a class="btn btn-primary" type="button" href="{{ route('pay.create') }}">
                    Generate Pay
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-primary">User Pay</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="pay-table" width="100%">
                            <thead>
                                <tr>
                                    <td>Employee Name</td>
                                    <td>Pay Period</td>
                                    <td>Total Hours</td>
                                    <td>Total Pay</td>
                                    <td>Is Paid</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script>
    $(function () {
            const datatable = $('#pay-table').DataTable({
				processing:true,
				pageLength: 20,
				lengthMenu: [
					[10,20,40,80,-1], [10, 20,40,80,"All"]
				],
				serverSide: true,
				scrollX: true,
				ajax: route('pay.index'),
				columns:[
                    {
                        data:'user_id' , name:'user_id'
                    },
                    {
                        data:'pay_period' , name:'pay_period'
                    },
                    {
                        data:'total_working_hours' , name:'total_working_hours'
                    },
                    {
                        data:'net_pay' , name:'net_pay'
                    },
                    {
                        data:'is_paid' , name:'is_paid'
                    },
					{
                        data:'action' , name:'action', orderable: false, searchable:false
                    },
				]
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
                    return axios.delete(route('pay.delete', id))
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
        });
</script>
@endpush
