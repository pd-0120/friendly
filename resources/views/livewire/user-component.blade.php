<div>
    <form wire:submit="save">
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
                <input type="text" wire:model='detail_state.phone' class="form-control">
                <x-error-component :name="'detail_state.phone'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Date of Birth</label>
                <input type="date" wire:model='detail_state.dob' class="form-control">
                <x-error-component :name="'detail_state.dob'" />
            </div>
            <div class="col-md-4 form-group">
                <label for="">Emergency Phone</label>
                <input type="text" wire:model='detail_state.emergency_phone' class="form-control">
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
