<div wire:ignore x-data="videoPlayer('{{ $videoUrl }}', '{{ $currentWatchedDuration }}')" x-init="init()">

    <video x-ref="video" controls preload="auto" class="video-js" width="1024" height="700">
        <source src="{{ $videoUrl }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <span x-text="$currentWatchedDuration"> </span>

    <div class="flex items-center space-x-3" x-show ="currentWatchedDuration">
        <div>
            <span>Continue from previusly stopped: </span>
        </div>
        <button class="p-2 my-4 font-bold rounded-md bg-primary-300" @click="continueFromWatchedDuration">Play</button>

    </div>

    <script>
        function videoPlayer(videoUrl, currentWatchedDuration) {
            return {
                videoUrl: videoUrl,
                videoId: 0,
                watchedDuration: 0,
                currentWatchedDuration: currentWatchedDuration,
                continue: false,
                init() {
                    const player = videojs(this.$refs.video);
                    var initdone = false;

                    player.on('pause', () => {
                        this.watchedDuration = Math.floor(player.currentTime());
                        Livewire.dispatch('updateWatchedDuration', {
                            duration: this.watchedDuration
                        });
                    });

                    this.continueFromWatchedDuration = () => {

                        player.currentTime(this.currentWatchedDuration);
                        player.play(); // Optionally, start playing after setting the time
                    };
                }
            };
        }
    </script>


</div>
