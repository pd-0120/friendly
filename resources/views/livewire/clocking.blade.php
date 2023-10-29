<div>
    <button @class(['btn btn-success btn-square', 'd-none' => $isClockedIn]) wire:click='clockIn'>
        Clock-In
    </button>
    <button @class(['btn btn-danger btn-square', 'd-none' => !$isClockedIn]) wire:click='clockOut'>
        {{ $inTime }} Hours
    </button>
</div>
