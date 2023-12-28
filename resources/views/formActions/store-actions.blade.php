<div>
    @if($authUser->can('edit_store'))
    <a class="btn btn-primary mt-2 mr-2" href="{{ route('store.edit', $data) }}">
        <i class="fa fa-pen"></i>
    </a>
    @endif

    @if($authUser->can('delete_store'))
    <button class="btn btn-danger mt-2 delete-btn" data-id="{{ $data->id }}">
        <i class="fa fa-trash"></i>
    </button>
    @endif
</div>
