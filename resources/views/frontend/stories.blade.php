@extends('layouts.frontend.frontendLayouts')
@section('title', 'Stories')
@section('content')

    <div class="content-container mb-4" style="margin-top:7rem;">
        <div class="text-center" style="margin-bottom: 5rem;">
            <h5>Our Latest</h5>
            <h1>STORIES</h1>
            <hr class="w-25 border-2 m-auto mt-5">

        </div>
        <section class="content">
            <div class="container" id="album-container">
                <div class="row gy-4 container-stories">
                    @include('frontend.partials.albums', ['albums' => $albums])
                </div>

                @if ($albums->hasMorePages())
                    <div class="text-center mt-5 " id="load-more-container">
                        <button id="load-more" class="btn btn-outline-secondary shadow d-inline-block"
                            data-next-page-url="{{ $albums->nextPageUrl() }}">Load More</button>
                    </div>
                @endif
            </div>
        </section>
        <hr class="w-25 border-2 m-auto mt-5">

    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('load-more').addEventListener('click', function() {
            var button = this;
            var nextPageUrl = button.getAttribute('data-next-page-url');

            if (!nextPageUrl) return;

            fetch(nextPageUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.albums) {
                        document.querySelector('#album-container .row').insertAdjacentHTML('beforeend', data
                            .albums);

                        if (data.next_page_url) {
                            button.setAttribute('data-next-page-url', data.next_page_url);
                        } else {
                            document.getElementById('load-more-container').remove();
                        }
                    }
                }).catch(error => console.error('Error Loading More Albums : ', error));
        });
    </script>

@endsection
