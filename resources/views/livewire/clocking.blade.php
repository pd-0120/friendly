<div>
    @if($isClockedIn == false)
    <button class="btn btn-success btn-square" wire:click='clockIn'>
        Clock-In
    </button>
    @else
    <button class="btn btn-danger btn-square" wire:click='clockOut'>
        {{ $inTime }} Hours
    </button>
    @endif
</div>
