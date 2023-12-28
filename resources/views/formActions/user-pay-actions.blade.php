<div>
    @if($authUser->can('edit_pay'))
    <a class="btn btn-primary mt-2 mr-2" href="{{ route('pay.edit', $data) }}">
        <i class="fa fa-pen"></i>
    </a>
    @endif
    @if($authUser->can('delete_pay'))
    <button class="btn btn-danger mt-2 delete-btn" data-id="{{ $data->id }}">
        <i class="fa fa-trash"></i>
    </button>
    @endif
</div>
