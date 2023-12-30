<div>
    <table class="table ">
        <tr>
            <td>Permission Module</td>
            <td></td>
            <td>Permission Name</td>
            <td>Permission Description</td>
        </tr>
        @forelse ($this->permissions as $permissionModule)
            @forelse ($permissionModule as $permission)
            <tr class="form-group">
                    @if($loop->first)
                    <td rowspan="{{ $loop->count }}">{{ $permission['module'] }}</td>
                    @endif
                    <td>
                        <input type="checkbox" class="form-control" wire:model='{{ 'state.'.$permission['name'] }}'>
                    </td>
                    <td>{{ $permission['name'] }}</td>
                    <td>{{ $permission['description'] }}</td>
                </tr>
                @empty
            @endforelse
            @empty
        @endforelse
    </table>
</div>
