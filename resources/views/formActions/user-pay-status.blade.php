<div class="row">
    <div class="col-md-6">
        @if ($data->is_paid)
            <button class='btn btn-xs btn-success mx-2 px-2 update-pay-status' data-id="{{ $data->id }}">Paid</button>
        @else
            <button class='btn btn-xs btn-danger mx-2 px-2 update-pay-status' data-id="{{ $data->id }}">Pending</button>
        @endif
    </div>
</div>
