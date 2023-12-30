<div>
    <form wire:submit='saveData'>
        <table class="table table-bordered">
            <tr>
            <td align="center">Permission Module</td>
            <td align="center"></td>
            <td align="center">Permission Name</td>
            <td align="center">Permission Description</td>
        </tr>
            @forelse ($this->permissions as $permissionModule)
                @forelse ($permissionModule as $permission)
                <tr class="form-group">
                    @if($loop->first)
                    <td rowspan="{{ $loop->count }}" align="center">{{ $permission['module'] }}</td>
                    @endif
                    <td align="center">
                        <input type="checkbox" class="form-control" wire:model='{{ 'state.'.$permission['name'] }}'>
                    </td>
                    <td align="center">{{ $permission['name'] }}</td>
                    <td align="center">{{ $permission['description'] }}</td>
                </tr>
                @empty
                @endforelse
            @empty
            @endforelse
        </table>
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
