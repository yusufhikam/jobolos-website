@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Photo Management')
@section('content')

    <div class="content-wrapper ">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Photo Management</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageGallery">Album Gallery Management</a>
                        </li>
                        <li class="breadcrumb-item active">Photo Management</li>
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
                    {{-- <div class="col-lg-3 mb-2">
                        <a href="/admin_panel/adminManagePhoto">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Photos Management</button>
                        </a>
                    </div> --}}
                    <div>
                        <a href="/admin_panel/adminManageGallery" class="btn btn-warning"><i
                                class="fa-solid fa-circle-left"></i> Kembali</a>
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header text-center bg-primary">Form Tambah Foto</div>
                                <div class="card-body">
                                    <p><span style="color: red">*</span> Silahkan isi form dibawah ini untuk menambahkan
                                        User
                                    </p>

                                    {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                                    <hr>
                                    <form action="/admin_panel/adminManageGallery" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-auto">
                                            <div class="mb-3">
                                                <label class="form-label" for="photo">Upload Foto (Banyak Foto)</label>
                                                <input type="file" class="form-control" name="name[]" id="photo"
                                                    multiple required>
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
                </div>
            </div>
        </section>
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
    </div>
@endsection
