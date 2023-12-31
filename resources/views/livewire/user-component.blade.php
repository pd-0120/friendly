<div>
    <form wire:submit="saveData">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Name</label>
                <input type="text" wire:model='name' class="form-control">
                <x-error-component :name="'name'"/>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Email</label>
                <input type="email" wire:model='email' class="form-control">
                <x-error-component :name="'email'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Phone</label>
                <input type="text" wire:model='detail_state.phone' class="form-control" id="phone_number">
                <x-error-component :name="'detail_state.phone'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Date of Birth</label>
                <input type="date" wire:model='detail_state.dob' class="form-control">
                <x-error-component :name="'detail_state.dob'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Emergency Phone</label>
                <input type="text" wire:model='detail_state.emergency_phone' class="form-control" id="emergency_phone">
                <x-error-component :name="'detail_state.emergency_phone'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Street</label>
                <input type="text" wire:model='detail_state.street' class="form-control">
                <x-error-component :name="'detail_state.street'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Suburb</label>
                <input type="text" wire:model='detail_state.suburb' class="form-control">
                <x-error-component :name="'detail_state.suburb'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Pincode</label>
                <input type="number" wire:model='detail_state.pincode' class="form-control">
                <x-error-component :name="'detail_state.pincode'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Pay rate</label>
                <input type="number" wire:model='detail_state.payrate' class="form-control">
                <x-error-component :name="'detail_state.payrate'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Role</label>
                <select class="form-control" wire:model='role'>
                <option value="">Select</option>
                    @forelse ($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                    @empty
                    @endforelse
                </select>
                <x-error-component :name="'role'" />
            </div>
            <div class="col-md-4 form-group" wire:ignore>
                <label for="">Stores</label>
                <select class="form-control select2bs4" wire:model='store' multiple id="store">
                    @forelse ($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @empty
                    @endforelse
                </select>
                <x-error-component :name="'store'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Joining Date</label>
                <input type="date" wire:model='detail_state.joining_date' class="form-control">
                <x-error-component :name="'detail_state.joining_date'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Leaving Date</label>
                <input type="date" wire:model='detail_state.leaving_date' class="form-control">
                <x-error-component :name="'detail_state.leaving_date'" />
            </div>
            <div class="col-md-4 form-group mt-4">
                <label for="">Status</label>
                <input type="checkbox" checked wire:model='detail_state.status'>
                <x-error-component :name="'detail_state.status'" />
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
        const element = document.getElementById('phone_number');
        const maskOptions = {
            mask: '{\\0}0000 000 000'
        };
        const mask = window.IMask(element, maskOptions);

        const element1 = document.getElementById('emergency_phone');

        const mask1 = window.IMask(element1, maskOptions);


        $('#store').change(function(){
            @this.set('store', $(this).val())
            console.log()
        })
    })
	document.addEventListener('livewire:initialized', function() {
        if(@this.get('store')) {
            $('#store').val(@this.get('store')).trigger('change');
        }
    })
</script>
@endpush
