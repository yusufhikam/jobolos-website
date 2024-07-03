@extends('layouts.frontend.frontendLayouts')
@section('title', 'Album ' . $albums->title)
@section('content')

    <div class="content-container mb-4" style="margin-top:7rem;">

        <div class="text-center " style="margin-bottom: 5rem;">
            <h5>Stories {{ $albums->category->name }} of</h5>
            <h1>{{ strtoupper($albums->title) }}</h1>
            <hr class="w-25 border-2 m-auto mt-3">
        </div>

        <section class="content">

            <div class="container d-flex" id="album-container">
                <div class="row gy-5 album-img-container justify-content-center mx-auto">
                    @foreach ($albums->photos as $photo)
                        {{-- <div class="col-lg-12 "> --}}
                        <img src="{{ asset('/storage/admin_assets/gallery/' . $albums->title . '/' . $photo->name) }}"
                            class="img-fluid" alt="">
                        {{-- </div> --}}
                    @endforeach
                </div>
            </div>
        </section>
        <hr class="w-25 border-2 m-auto my-5">

    </div>
@endsection

{{-- @section('scripts')
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

@endsection --}}
