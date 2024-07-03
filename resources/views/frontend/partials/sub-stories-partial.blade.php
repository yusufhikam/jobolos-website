@foreach ($albums as $album)
    <div class="col-lg-6 stories-img">
        <a href="/jobolos/album/{{ $album->id }}/{{ $album->title }}" class="stories-img-container" aria-hidden="true">
            {{-- <div class="loader"></div> --}}
            <img src="/storage/admin_assets/gallery/00-thumbnails/{{ $album->title }}/{{ $album->thumbnail }}"
                alt="" class="img-fluid" />
            <div class="overlay-latest-img"></div>
            <div class="caption-overlay">
                <h4 aria-hidden="true" class="placeholder-glow">
                    {{ $album->title }}</h4>
                <p aria-hidden="true" class="placeholder-glow">

                    {{ $album->category->name }}</p>
            </div>
        </a>
    </div>
@endforeach
