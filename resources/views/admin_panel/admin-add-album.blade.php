@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Tambah Album Folder')
@section('content')

    <div class="content-wrapper ">

        {{-- breadcrumb --}}

        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6">
                    <h1 class="m-2">Tambah Album Folder</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageGallery">Album Gallery Management</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Album Folder</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container-fluid">
                <div class="mt-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header text-center bg-primary">Form Tambah Album Folder</div>
                            <div class="card-body">
                                <p><span style="color: red">*</span> Silahkan isi form dibawah ini untuk menambahkan Folder
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
                                <form action="/admin_panel/adminManageGallery" method="POST">
                                    @csrf
                                    <div class="col-auto">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama Folder</label>
                                            <input type="text" class="form-control" name="title" id="name"
                                                value="{{ old('name') }}" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="kategori">Kategori</label>
                                            <select class="form-select" name="kategori_id" id="kategori" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($category as $ctg)
                                                    <option value="{{ $ctg->id }}">{{ ucwords($ctg->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <p><span style="color: red">*</span> Penamaan Folder Maksimal menggunakan 30 karakter.
                                    </p>
                                    <p><span style="color: red">*</span> Penamaan Folder untuk Foto Couple berdasarkan nama
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
        </section>
    </div>
@endsection
