<div>
    <form wire:submit='saveData'>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="name">Name:</label>
                <input type="text" wire:model='name' class="form-control">
                <x-error-component :name="'name'" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
