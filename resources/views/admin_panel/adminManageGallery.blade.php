@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Gallery Management')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Kelola Galeri Foto</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item active">Kelola Galeri Foto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container-fluid">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    {{-- <div class="col-lg-3 mb-2">
                    <a href="/admin_panel/admin-add-album">
                        <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Album Folder</button>
                    </a>
                        </div> --}}
                    <div class="col-lg-6">
                        <div class="d-flex mb-2">
                            <a>
                                <button type="button" class="btn btn-primary col-12 col-sm-12" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i>
                                    Photos</button>
                            </a>
                            <a href="/admin_panel/adminManageCategory">
                                <button class="btn btn-primary col-12 col-sm-12 ms-2"><i class="fa-solid fa-plus"></i>
                                    Category</button>
                            </a>
                        </div>
                    </div>

                    {{-- form pencarian data --}}
                    <div class="col-lg-6 col-sm-12 mb-2">
                        <form class="d-flex" action="" method="get" role="search">
                            <input type="search" class="form-control me-2" name="keyword" placeholder="Search Data"
                                value="{{ request()->input('keyword') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>

                {{-- Filtering data berdasarkan Kategori --}}
                <div class="d-inline-flex ms-4 border bg-info bg-opacity-10 border-info rounded ">
                    <div class="btn-group dropend ">
                        <button type="button" class="btn dropdown-toggle btn-filtering " data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa-solid fa-filter " style="color: #ffd500;"></i> Filter
                        </button>

                        <ul class="dropdown-menu">
                            @foreach ($categories as $ctg)
                                <li>
                                    <a class="dropdown-item {{ $categoryFiltering == $ctg->id ? 'active' : '' }}"
                                        aria-current="true"
                                        href="/admin_panel/adminManageGallery?category={{ $ctg->id }}/{{ $ctg->name }}">{{ $ctg->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="/admin_panel/adminManageGallery" class="btn btn-filtering"><i class="fa-solid fa-ban"
                                style="color: #ff0000;"></i> No Filtering</a>
                    </div>
                </div>

                <div class="container-fluid mt-4 px-4">
                    <div class="row ">
                        @if ($albums->isEmpty())
                            {{-- menampilkan alert jika filter kategori tidak ada data --}}
                            <div class="alert alert-danger text-center" role="alert">
                                <h2>Oops!</h2>
                                <p>Untuk saat ini Data dengan Kategori tersebut tidak ada. Mohon
                                    Tambahkan
                                    terlebih dahulu.</p>
                            </div>
                        @else
                            @foreach ($albums as $album)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100">

                                        {{-- link untuk menuju folder foto tiap album --}}
                                        <a href="/admin_panel/albums/{{ $album->id }}/{{ $album->title }}"
                                            class="row m-2 mt-3">
                                            <div class="col-2 align-content-center p-2">
                                                <i style="color: #f1c500;"
                                                    class="fa-solid fa-folder fa-2xl float-start"></i>
                                            </div>
                                            <div class="col-10">
                                                <p class="m-auto">{{ ucwords($album->title) }}</p>
                                            </div>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-end mx-2">
                                            <div class="category-info d-flex align-items-center col-7">
                                                <p class="mb-0 me-2">Category : </p>
                                                <p class="badge text-bg-primary mb-0 text-wrap">{{ $album->category->name }}
                                                </p>
                                            </div>
                                            <div class="col-5 justify-content-end m-0 d-flex">
                                                <form
                                                    action="/admin_panel/admin-destroy-album/{{ $album->id }}/{{ $album->title }}"
                                                    method="POST" id="delete-form-{{ $album->id }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    {{-- <a
                                            href="/admin_panel/admin-destroy-album/{{ $album->id }}/{{ $album->title }}"><button
                                                type="submit" data-confirm-delete="true" class="btn btn-sm btn-danger "><i
                                                    class="fa-solid fa-trash"
                                                    onclick="confirmDelete{{ $album->id }}"></i>
                                                Delete</button></a> --}}

                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete({{ $album->id }})"><i
                                                            class="fa-solid fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </div>
                                            {{-- <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Delete</button> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-2">
                        {{ $albums->withQueryString()->links() }}
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Foto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin_panel/adminManageGallery" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <label class="form-label" for="photo">Upload Foto (Banyak Foto)</label>
                                        <input type="file" class="form-control" name="name[]" id="photo" multiple
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama Album</label>
                                        <input type="text" class="form-control" name="title" id="name"
                                            value="{{ old('name') }}" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="thumbnail">Upload Thumbnail Album</label>
                                        <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="kategori">Kategori</label>
                                        <select class="form-select" name="kategori_id" id="kategori" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($categories as $ctg)
                                                <option value="{{ $ctg->id }}">{{ ucwords($ctg->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <p><span style="color: red">*</span> Penamaan Album Maksimal menggunakan 30
                                    karakter.
                                </p>
                                <p><span style="color: red">*</span> Penamaan Album untuk Foto Couple berdasarkan
                                    nama
                                    pasangan.
                                <p style="color: red"><span>*</span> contoh : Raffi & Gigi.

                                <div class="float-end mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     document.querySelectorAll('.album-delete-button').forEach(function(button) {
        //         button.addEventListener('click', function(event) {
        //             event.preventDefault();
        //             const form = this.closest('form');
        //             Swal.fire({
        //                 title: "Apakah Anda yakin ingin Menghapus Data Album ini?",
        //                 text: "Anda Tidak Dapat Mengembalikan Data yang sudah dihapus",
        //                 icon: "warning",
        //                 showCancelButton: true,
        //                 confirmButtonColor: "#3085d6",
        //                 cancelButtonColor: "#d33",
        //                 confirmButtonText: "Delete!"
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     form.submit();
        //                 }
        //             });
        //         });
        //     });
        // });

        function confirmDelete(albumId) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin Menghapus Data Album ini?',
                text: "Anda Tidak Dapat Mengembalikan Data yang sudah dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + albumId).submit();
                }
            })
        }
    </script>

@endsection
