<div class="col-md-3">
    <div class="notifications mx-auto">
        <p class="margin-left-20"> Notifications</p>
        @foreach (\App\Models\Notifications::where('user_id', Auth::id())->take(5)->orderBy('created_at', 'DESC')->get()
    as $noti)
            <a href="{{url($noti->route_name)}}">
                <div class="d-flex align-items-center margin-5 side">
                    <div class="iconsBackgroundBox">
                        <img src="{{ asset('assets/images/video.png') }}" alt="">
                    </div>
                    <span class=" ml-2  notifications-primary-text"> {{ $noti->message }}</span>
                    <span class="agoColor">{{ $noti->created_at->diffForHumans() }}</span>
                </div>
            </a>
            <hr>
        @endforeach

        <hr>

    </div>
</div>
