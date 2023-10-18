<div>
    <form wire:submit='saveData'>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="">Name</label>
                <input type="text" wire:model='state.name' class="form-control">
                <x-error-component :name="'state.name'"/>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Phone</label>
                <input type="text" wire:model='state.phone' class="form-control" id="phone_number">
                <x-error-component :name="'state.phone'"/>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Emergency Phone</label>
                <input type="text" wire:model='state.emergency_phone' class="form-control" id="emergency_phone">
                <x-error-component :name="'state.emergency_phone'"/>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Street</label>
                <input type="text" wire:model='state.street' class="form-control">
                <x-error-component :name="'state.street'"/>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Suburb</label>
                <input type="text" wire:model='state.suburb' class="form-control">
                <x-error-component :name="'state.suburb'"/>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Pincode</label>
                <input type="number" wire:model='state.pincode' class="form-control">
                <x-error-component :name="'state.pincode'"/>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Allowed IPs <sub>(Use comma for multiple ips)</sub></label>
                <input type="text" wire:model='state.allowed_ips' class="form-control">
                <x-error-component :name="'state.allowed_ips'" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary" >Submit</button>
            </div>
        </div>
    </form>
</div>

@push('js')
<script>
    $(function() {
        const element = document.getElementById('phone_number');
        const maskOptions = {
            mask: '{\\0}0000 000 000'
        };
        const mask = window.IMask(element, maskOptions);

        const element1 = document.getElementById('emergency_phone');

        const mask1 = window.IMask(element1, maskOptions);
    })
</script>
@endpush
