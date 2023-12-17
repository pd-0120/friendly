<div>
    <form wire:submit="saveData">
        <div class="row form-group">
            <div class="col-md-4">
                <label for="user_name" class="">User Name</label>

                @if(isset($this->state['user']))
                <input type="hidden" wire:model="state.user_id">
                <input type="text" class="form-control" value="{{ $this->state['user'] }}" disabled>
                @else
                @endif
            </div>
            <div class="col-md-4">
                <label for="">Starting Date</label>
                <input type="text" class="form-control" value="{{ $state['start_date'] }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="">Ending Date</label>
                <input type="text" class="form-control" value="{{ $state['end_date'] }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="">Pay Rate</label>
                <input type="text" class="form-control" value="{{ $state['rate'] }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="">Total Working hours</label>
                <input type="text" class="form-control" value="{{ $state['total_working_hours'] }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="">Total Pay</label>
                <input type="text" class="form-control" wire:model='state.net_pay'>
                <x-error-component :name="'state.net_pay'" />
            </div>
            <div class="col-md-4">
                <label for="">Note</label>
                <input type="text" class="form-control" wire:model='state.note'>
                <x-error-component :name="'state.note'" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
