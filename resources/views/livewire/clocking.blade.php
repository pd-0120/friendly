<div>
    <button @class(['btn btn-success btn-square clocking-btn', 'd-none' => $isClockedIn]) data-id="clock-in">
        Clock-In
    </button>
    <button @class(['btn btn-danger btn-square clocking-btn', 'd-none' => !$isClockedIn]) data-id="clock-out">
        <span id="clock-time"></span> Hours
    </button>
    @push('camModal')
        <div class="modal fade" id="webcamModel" tabindex="-1" role="dialog" aria-labelledby="webcamModelLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="webcamModelLabel">Save @if (!$isClockedIn)
                            Clock-in
                        @else
                            Clock-out
                        @endif Info</h5>
                        <button type="button" class="close cam-close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="my_camera"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cam-close">Close</button>
                        <button type="button" class="btn btn-primary" id="save-data">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
</div>

@push('js')
<script>
    document.addEventListener('livewire:initialized', () => {
        if(@this.isClockedIn) {
            updateTime()
        }
        Webcam.set({
            width: 750,
            height: 450,
            image_format: 'png',
            jpeg_quality: 120
        });

        @this.on('clocking-in', (event) => {
            updateTime()
        });

        @this.on('clocking-done', (event) => {
            clearInterval(@this.intervalId)
        });

        function updateTime() {
            let date = new Date(@this.clockedDateTime)
            let intervalId = setInterval(() => {

                date.setSeconds(date.getSeconds()+1);

                let hours = date.getHours();
                let minutes = date.getMinutes();
                let seconds = date.getSeconds();

                if(hours < 10) { hours=`0${hours}` }
                if(minutes < 10) { minutes=`0${minutes}` }
                if(seconds < 10) { seconds=`0${seconds}` }

                let foramtedTime = hours+":"+minutes+":"+seconds;

                $('#clock-time').text(foramtedTime)
            }, 1000);

            if(intervalId != 0) {
                @this.set('intervalId', intervalId);
            }
        }

        $(document).on('click', '.clocking-btn', function() {
            const id = $(this).data('id');
            $('#webcamModel').modal('show');

            Webcam.attach('#my_camera' );
        })

        $(document).on('click', '.cam-close', function() {
            Webcam.reset();
            $('#webcamModel').modal('hide');
        })

        $(document).on('click', '#save-data', function() {
            Webcam.snap( function(data_uri) {
                const image_content = data_uri
                const url = route('clocking.saveImageData');

                axios.put(url, {
                    image : image_content
                }).then((response) => {
                    if(response.data.success) {
                        @this.dispatch('image-saved', { refreshPosts: response.data.path });
                    } else {
                        alert("Something went wrong")
                    }
                });
                Webcam.reset();
                $('#webcamModel').modal('hide');
			} );
        })
    });

</script>
@endpush
