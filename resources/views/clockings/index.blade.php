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
                    <li class="breadcrumb-item"><a href="{{ route('clocking.index') }}">Clockings</a></li>
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
                <a class="btn btn-primary" type="button" href="{{ route('clocking.create') }}">
                    Add Clocking
                </a>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header bg-primary">Clockings</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Users</label>
                        <select class="form-control select2bs4" id="user">
                            @forelse ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="clocking-table" width="100%">
                            <thead>
                                <tr>
                                    <td>User</td>
                                    <td>Date</td>
                                    <td>In Time</td>
                                    <td>ClockIn Data</td>
                                    <td>Out Time</td>
                                    <td>ClockOut Data</td>
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
<div class="modal fade" id="clockImageModel" tabindex="-1" role="dialog" aria-labelledby="clockImageModelLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Info</h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="imageData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function () {
            const datatable = $('#clocking-table').DataTable({
                order: [[1, 'desc']],
				processing:true,
				pageLength: 20,
				lengthMenu: [
					[10,20,40,80,-1], [10, 20,40,80,"All"]
				],
				serverSide: true,
				scrollX: true,
				ajax: route('clocking.index'),
				columns:[
					{data:'user' , name:'user'},
					{data:'date' , name:'date'},
					{data:'in_time' , name:'in_time'},
					{data:'in_agent' , name:'in_agent'},
                    {data:'out_time' , name:'out_time'},
                    {data:'out_agent' , name:'out_agent'},
                    {data:'working_hours' , name:'working_hours'},
                    {data:'action' , name:'action'},
				]
			});
            $('#user').change(function() {
                datatable
                .columns(0)
                .search($(this).val())
                .draw();
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
                    return axios.delete(route('clocking.delete', id))
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
            });

            $(document).on('click', '.clocking-data', function() {
                const clocktype = $(this).data('type');
                const id = $(this).data('id');

                const url = route('clocking.clockingData', {
                    type : 'image',
                    dataType: clocktype,
                    clocking: id,
                })
                return axios.get(url).then((res) => {
                    if(res.status == 200) {
                        const resData = res.data

                        if(resData.type == "success") {
                            $('#imageData').children('img').remove();
                            $('#imageData').append(resData.image);
                            $('#clockImageModel').modal('show')
                        }
                    }
                })
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
</script>
@endpush
