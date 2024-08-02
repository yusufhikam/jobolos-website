@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Albums')
@section('content')

    {{-- <div class="loader"></div> --}}
    <div class="content-wrapper ">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Album Foto {{ $album->title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageGallery">Kelola Galeri Foto</a>
                        </li>
                        <li class="breadcrumb-item active">Detail Galeri Foto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid pb-4">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    {{-- <div class="col-lg-3 mb-2">
                        <a href="/admin_panel/admin-add-album">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Album Folder</button>
                        </a>
                    </div> --}}
                    {{-- <div class="col-lg-3 mb-2">
                        <a href="/admin_panel/adminManagePhoto">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Photos Management</button>
                        </a>
                    </div> --}}

                    <hr class="w-50">
                    <div class="container-fluid mt-4">
                        <div class="my-3">
                            <a href="/admin_panel/adminManageGallery" class="btn btn-warning"><i
                                    class="fa-solid fa-circle-left "></i> Kembali</a>
                        </div>
                        <div class="row row-cols-2 row-cols-md-2 g-1 img-row">
                            @if ($album->photos->isEmpty())
                                <div class="col-10 d-flex mx-auto">
                                    <div class=" alert alert-danger text-center " role="alert">
                                        <h2>Oops!</h2>
                                        <p>Untuk saat ini album <b>'{{ $album->title }}'</b> belum ada fotonya. <br>Mohon
                                            Tambahkan
                                            terlebih dahulu.</p>
                                    </div>
                                </div>
                            @else
                                @foreach ($album->photos as $foto)
                                    <div class="img-column">
                                        <img src="{{ asset('storage/admin_assets/gallery/' . $album->title . '/' . $foto->name) }}"
                                            class=" shadow  img-gallery" alt="foto_client">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('sweetalert::alert')
    <script>
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
