<div>
    @if($authUser->can('edit_user'))
    <a class="btn btn-primary mt-2 mr-2" href="{{ route('user.edit', $data) }}">
        <i class="fa fa-pen"></i>
    </a>
    @endif
    @if(auth()->user()->id != $data->id && $authUser->can('delete_user'))
    <button class="btn btn-danger mt-2 delete-btn" data-id="{{ $data->id }}">
        <i class="fa fa-trash"></i>
    </button>
    @endif
</div>
