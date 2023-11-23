<div>
    <button @class(['btn btn-success btn-square', 'd-none' => $isClockedIn]) wire:click='clockIn'>
        Clock-In
    </button>
    <button @class(['btn btn-danger btn-square', 'd-none' => !$isClockedIn]) wire:click='clockOut'>
        <span id="clock-time"></span> Hours
    </button>
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        if(@this.isClockedIn) {
            updateTime()
        }

        function updateTime() {
            let date = new Date(@this.clockedDateTime)
            setInterval(() => {
            date.setSeconds(date.getSeconds()+1);

            let hours = date.getHours();
            let minutes = date.getMinutes();
            let seconds = date.getSeconds();

            if(hours < 10) { hours=`0${hours}` }
            if(minutes < 10) { minutes=`0${minutes}` }
            if(seconds < 10) { seconds=`0${seconds}` }
            let foramtedTime=hours+":"+minutes+":"+seconds;
            $('#clock-time').text(foramtedTime) }, 1000);
        }
    });
</script>
@push('js')
@endpush
