<div>
    <form wire:submit="saveData">
        <div class="row">

            <div class="col-md-3 form-group" wire:ignore>
                <label for="">Users</label>
                <select class="form-control select2bs4" wire:model='state.user_id' id="user">
                    @forelse ($users as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @empty
                    @endforelse
                </select>
                <x-error-component :name="'state.user_id'" />
            </div>
            <div class="col-md-3 form-group">
                <label for="">Date</label>
                <input type="date" class="form-control" id="date" wire:model='state.date'>
                <x-error-component :name="'state.date'" />
            </div>
            <div class="col-md-3 form-group">
                <label for="">Start Time</label>
                <input type="time" class="form-control" id="in_time" wire:model='state.in_time'>
                <x-error-component :name="'state.in_time'" />
            </div>
            <div class="col-md-3 form-group">
                <label for="">End Time</label>
                <input type="time" class="form-control" id="out_time" wire:model='state.out_time'>
                <x-error-component :name="'state.out_time'" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@push('js')
<script>
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#user').change(function(){
            @this.set('state.user_id', $(this).val())
            console.log()
        })
    })
	document.addEventListener('livewire:initialized', function() {
        if(@this.get('state.user_id')) {
            $('#user').val(@this.get('state.user_id')).trigger('change');
        }
    })
</script>
@endpush
