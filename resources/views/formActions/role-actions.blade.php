<div>
    @if(!in_array($data->name, $preDefineRoles))

        @if($authUser->can('edit_role'))
        <a class="btn btn-primary mt-2 mr-2" href="{{ route('role.edit', $data) }}">
            <i class="fa fa-pen"></i>
        </a>
        @endif
        @if($authUser->can('delete_role'))
            <button class="btn btn-danger mt-2 delete-btn" data-id="{{ $data->id }}">
                <i class="fa fa-trash"></i>
            </button>
        @endif

        @endif
        @if($authUser->can('assign_permission'))
        <a class="btn btn-warning mt-2" href="{{ route('role.assignPermissions', $data->id) }}">
            <i class="fa fa-eye"></i>
        </a>
        @endif
</div>
