@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Manage Camera')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Kamera List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active">Kamera List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                {{-- FORM TAMBAH DATA CAMERA --}}
                <div class="row">
                    <div class="col-lg-6 gap-2 d-flex float-start">
                        <div class="d-grid mb-4">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahKameraModal"
                                class="btn btn-success "><i class="fa-regular fa-plus"></i>
                                Tambah Kamera</button>
                        </div>
                        <div class="d-grid mb-4">
                            <button class="btn btn-success "><a href="/admin_panel/adminManageCameraType"
                                    style="color: #fff;"><i class="fa-regular fa-plus"></i>
                                    Tambah Tipe Kamera</a></button>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="col-lg-12 col-sm-12 mb-4 float-end">
                            <form class="d-flex" action="" method="get" role="search">
                                <input type="search" class="form-control me-2" name="keyword" placeholder="Search Data"
                                    value="{{ request()->input('keyword') }}">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        @if (Session::has('status'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                {{-- Modal tambah kamera --}}
                <div class="modal fade" id="tambahKameraModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Kamera</h1>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <p><span style="color: red">*</span> Silahkan isi form dibawah ini untuk menambahkan
                                        Data
                                        Kamera
                                    </p>
                                    <form action="/admin_panel/adminManageCamera" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-auto">
                                            <div class="mb-3">
                                                <label class="form-label" for="camera_type">Tipe Kamera</label>
                                                <select class="form-select" name="camera_type_id" id="camera_type" required>
                                                    <option value="">-- Pilih Tipe Kamera--</option>
                                                    @foreach ($cameraTypes as $tipe)
                                                        <option value="{{ $tipe->id }}">{{ $tipe->brands->name }}
                                                            [{{ ucwords($tipe->name) }}]
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Nama Kamera</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    value="{{ old('name') }}" required autocomplete="off">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="code">Code Kamera</label>
                                                <input type="text" class="form-control" name="code" id="code"
                                                    value="{{ old('code') }}" required autocomplete="off">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="harga_per_hari">Harga Rental per Hari</label>
                                                <input type="number" class="form-control" name="harga_per_hari"
                                                    id="harga_per_hari" value="{{ old('harga_per_hari') }}" required
                                                    autocomplete="off">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="thumbnail">Upload Foto Thumbnail
                                                    Kamera</label>
                                                <input type="file" class="form-control" name="thumbnail"
                                                    id="thumbnail" required>
                                                {{-- @if ($errors->has('brand_id'))
                                                        <p class="text-danger mt-1 error-input">{{ $errors->first('brand_id') }}</p>
                                                    @endif --}}
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="foto">Upload Foto Kamera</label>
                                                <input type="file" class="form-control" name="image[]" id="foto"
                                                    multiple required>
                                                {{-- @if ($errors->has('brand_id'))
                                                        <p class="text-danger mt-1 error-input">{{ $errors->first('brand_id') }}</p>
                                                    @endif --}}
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="deskripsi-tambah">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" id="editor" cols="30" rows="10">{{ old('deskripsi') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="float-end mt-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal tambah tipe kamera --}}
                {{-- <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Tipe Kamera</h1>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin_panel/adminManageCamera/Add-Camera-Types" method="POST">
                                    @csrf
                                    <div class="col-auto">
                                        <div class="mb-3">
                                            <label class="form-label" for="merk">Brands Kamera</label>
                                            <select class="form-select" name="brand_id" id="merk" required>
                                                <option value="">-- Pilih Brand Kamera--</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ ucwords($brand->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('brand_id'))
                                                <p class="text-danger mt-1 error-input">
                                                    {{ $errors->first('brand_id') }}</p>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="camera_type">Nama Tipe Kamera</label>
                                            <input type="text" class="form-control" name="name" id="camera_type"
                                                value="{{ old('name') }}" required autocomplete="off">
                                            @if ($errors->has('name'))
                                                <p class="text-danger mt-1 error-input">
                                                    {{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="float-end mt-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- TABLE CAMERA LIST --}}

                {{-- FILTERING DATA --}}
                <div class="col-lg-3 col-sm-6 d-inline-flex mb-3 border bg-info bg-opacity-10 border-info rounded ">
                    <div class="btn-group dropend ">
                        <button type="button" class="btn dropdown-toggle btn-filtering" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-filter" style="color: #ffd500;"></i> Filtering By
                        </button>
                        <ul class="dropdown-menu dropdown-menu-filtering">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Brand</a>
                                <ul class="dropdown-menu">
                                    @foreach ($brands as $brand)
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin_panel.adminManageCamera', ['brand' => $brand->id]) }}">{{ $brand->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Tipe Kamera</a>
                                <ul class="dropdown-menu">
                                    @foreach ($cameraTypes as $cameraType)
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin_panel.adminManageCamera', ['camera_type' => $cameraType->id]) }}">{{ $cameraType->name }}
                                                - {{ $cameraType->brands->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="/admin_panel/adminManageCamera" class="btn btn-filtering"><i class="fa-solid fa-ban"
                                style="color: #ff0000;"></i> No Filtering</a>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="table-responsive">
                        @if ($cameras->isEmpty())
                            <div class=" alert alert-danger text-center " role="alert">
                                <h2>Oops!</h2>
                                <p>Untuk saat ini data Camera Tidak Ada
                                </p>
                            </div>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary text-center">
                                        <th>No</th>
                                        <th>Merk</th>
                                        <th>Tipe Kamera</th>
                                        <th>Nama Kamera</th>
                                        <th>Code Kamera</th>
                                        <th>Harga Rental Per Hari</th>
                                        <th>Detail Kamera</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cameras as $camera)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $camera->camera_types->brands->name }}</td>
                                            <td>{{ $camera->camera_types->name }}</td>
                                            <td>{{ $camera->name }}</td>
                                            <td>
                                                {{ $camera->code }}
                                            </td>
                                            <td>
                                                <p>Rp {{ number_format($camera->harga_per_hari, 0, ',', '.') }}</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $camera->id }}"
                                                        class="btn btn-success "><i class="fa-regular fa-eye"></i>
                                                        Detail</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row g-2  justify-content-center">

                                                    <div class="col-sm-6">
                                                        <div class="d-grid">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#editKameraModal{{ $camera->id }}"
                                                                class="btn btn-warning"><i class="fa-regular fa-edit"></i>
                                                                Edit</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        {{-- <a href="/admin_panel/admin-destroy-user/{{ $pengguna->id }}"
                                                class="btn btn-danger" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a> --}}


                                                        <form
                                                            action="/admin_panel/adminManageCamera/destroy-camera{{ $camera->id }}"
                                                            method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a class="d-grid "
                                                                href="/admin_panel/adminManageCamera/destroy-camera{{ $camera->id }}"><button
                                                                    type="submit" class="btn btn-danger delete-button"><i
                                                                        class="fa-solid fa-trash"></i>
                                                                    Delete</button></a>
                                                        </form>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal edit kamera --}}
                                        <div class="modal fade" id="editKameraModal{{ $camera->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data
                                                            Kamera</h1>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <p><span style="color: red">*</span> Silahkan edit dan isi form
                                                                dibawah
                                                                ini untuk mengedit
                                                                Data
                                                                Kamera
                                                            </p>
                                                            <form
                                                                action="/admin_panel/adminManageCamera/Edit-Camera-{{ $camera->id }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-auto">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="camera_type">Tipe
                                                                            Kamera</label>
                                                                        <select class="form-select" name="camera_type_id"
                                                                            id="camera_type" required>
                                                                            <option value="">-- Pilih Tipe Kamera--
                                                                            </option>
                                                                            @foreach ($cameraTypes as $tipe)
                                                                                <option value="{{ $tipe->id }}"
                                                                                    @if ($camera->camera_type_id == $tipe->id) selected @endif>
                                                                                    {{ $tipe->brands->name }}
                                                                                    [{{ ucwords($tipe->name) }}]
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="name">Nama
                                                                            Kamera</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" id="name"
                                                                            value="{{ $camera->name }}" required
                                                                            autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="code">Code
                                                                            Kamera</label>
                                                                        <input type="text" class="form-control"
                                                                            name="code" id="code"
                                                                            value="{{ $camera->code }}" required
                                                                            autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="harga_per_hari">Harga Rental per
                                                                            Hari</label>
                                                                        <input type="number" class="form-control"
                                                                            name="harga_per_hari" id="harga_per_hari"
                                                                            value="{{ $camera->harga_per_hari }}" required
                                                                            autocomplete="off">
                                                                    </div>
                                                                    <div class="mb-3">

                                                                        {{-- <div class="row g-1 d-flex "> --}}
                                                                        <label class="mt-2">Foto saat ini</label>

                                                                        @php
                                                                            $images = json_decode($camera->image);
                                                                        @endphp
                                                                        <div class="container-fluid">
                                                                            <div class="row row-cols-2 row-cols-lg-6 g-2">
                                                                                @foreach ($images as $image)
                                                                                    <div class="img-modal-camera col">
                                                                                        {{-- <div class="p-1"> --}}
                                                                                        <img src="/storage/admin_assets/rental-kamera/camera/{{ $camera->camera_types->brands->name }}/{{ $camera->name }}/{{ $image }}"
                                                                                            alt=""
                                                                                            class="img-fluid">
                                                                                        {{-- </div> --}}
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        {{-- </div> --}}

                                                                        <label class="form-label mt-2"
                                                                            for="foto">Upload
                                                                            Foto</label>
                                                                        <input type="file" class="form-control"
                                                                            name="image[]" id="foto" multiple>

                                                                        {{-- @if ($errors->has('brand_id'))
                                                    <p class="text-danger mt-1 error-input">{{ $errors->first('brand_id') }}</p>
                                                @endif --}}
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="mt-2">Foto Thumbnail saat
                                                                            ini</label>
                                                                        <div class="container-fluid">
                                                                            <div class="row row-cols-2 row-cols-lg-6 g-2">
                                                                                <div class="img-modal-camera col">
                                                                                    <img src="/storage/admin_assets/rental-kamera/camera/{{ $camera->camera_types->brands->name }}/{{ $camera->name }}/thumbnail/{{ $camera->thumbnail }}"
                                                                                        alt="" class="img-fluid">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <label class="form-label" for="thumbnail">Upload
                                                                            Foto Thumbnail
                                                                            Kamera</label>
                                                                        <input type="file" class="form-control"
                                                                            name="thumbnail" id="thumbnail">
                                                                        {{-- @if ($errors->has('brand_id'))
                                                                                <p class="text-danger mt-1 error-input">{{ $errors->first('brand_id') }}</p>
                                                                            @endif --}}
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="deskripsi-edit{{ $camera->id }}">Deskripsi</label>
                                                                        <textarea class="form-control" name="deskripsi" id="editor{{ $camera->id }}" cols="30" rows="10">{!! htmlspecialchars_decode($camera->deskripsi) !!}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="float-end mt-3">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal detail kamera --}}
                                        <div class="modal fade" id="detailModal{{ $camera->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h1 class="modal-title fs-5 " id="staticBackdropLabel">Detail
                                                            Data
                                                            Kamera <b
                                                                class="text-warning">{{ $camera->camera_types->brands->name }}
                                                                {{ $camera->name }} </b></h1>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            {{-- content modal --}}
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="container-fluid">
                                                                        <div class="row row-cols-2 g-2">
                                                                            <div class="col">
                                                                                <h5>Unit Kamera</h5>
                                                                                <hr>
                                                                                <p>
                                                                                    {{ $camera->camera_types->brands->name }}
                                                                                    {{ $camera->name }}</p>

                                                                            </div>
                                                                            <div class="col">
                                                                                <h5>Code Kamera</h5>
                                                                                <hr>
                                                                                <p>
                                                                                    {{ $camera->code }}</p>

                                                                            </div>
                                                                            <div class="col">
                                                                                <h5>Tipe Kamera</h5>
                                                                                <hr>
                                                                                <p>
                                                                                    {{ $camera->camera_types->name }}</p>

                                                                            </div>
                                                                            <div class="col">
                                                                                <h5>Harga sewa/hari</h5>
                                                                                <hr>
                                                                                <p class="badge text-bg-warning m-1"
                                                                                    style="font-size: 13pt;">
                                                                                    Rp
                                                                                    {{ number_format($camera->harga_per_hari, 0, ',', '.') }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="container-fluid mt-2">
                                                                        <h5>Deskripsi Kamera</h5>
                                                                        <hr>
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <p>{!! htmlspecialchars_decode($camera->deskripsi) !!}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $images = json_decode($camera->image);
                                                                    @endphp
                                                                    <div class="container-fluid">
                                                                        <h5>Foto Kamera</h5>
                                                                        <hr>
                                                                        <div class="row row-cols-2 row-cols-lg-4 g-2">
                                                                            @foreach ($images as $image)
                                                                                <div class="img-modal-camera col">
                                                                                    {{-- <div class="p-1"> --}}
                                                                                    <img src="/storage/admin_assets/rental-kamera/camera/{{ $camera->camera_types->brands->name }}/{{ $camera->name }}/{{ $image }}"
                                                                                        alt="" class="img-fluid">
                                                                                    {{-- </div> --}}
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        {{-- PAGINATION --}}

                        <div class="mt-2">
                            {{ $cameras->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani submenu pada dropdown filtering
            document.querySelectorAll('.dropdown-submenu a.dropdown-toggle').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    var submenu = element.nextElementSibling;

                    if (submenu.classList.contains('show')) {
                        submenu.classList.remove('show');
                    } else {
                        // Tutup semua submenu yang sedang terbuka
                        document.querySelectorAll('.dropdown-submenu .dropdown-menu-filtering.show')
                            .forEach(function(sub) {
                                sub.classList.remove('show');
                            });

                        submenu.classList.add('show');
                    }
                });
            });

            // Tutup submenu saat dropdown utama tertutup
            document.querySelectorAll('.btn-filtering').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.dropdown-submenu .dropdown-menu-filtering.show')
                        .forEach(function(sub) {
                            sub.classList.remove('show');
                        });
                });
            });
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|',
                        'heading',
                        '|',
                        'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|',
                        'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|',
                        'link', 'blockQuote', 'codeBlock',
                        '|',
                        'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                    ],
                    shouldNotGroupWhenFull: true
                }
            })
            .catch(error => {
                console.error(error);
            });
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($cameras as $camera)
                ClassicEditor
                    .create(document.querySelector('#editor{{ $camera->id }}'), {
                        toolbar: {
                            items: [
                                'undo', 'redo',
                                '|',
                                'heading',
                                '|',
                                'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                                '|',
                                'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                                '|',
                                'link', 'blockQuote', 'codeBlock',
                                '|',
                                'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                            ],
                            shouldNotGroupWhenFull: true
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            @endforeach
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: "Apakah Anda yakin ingin Menghapus Data User?",
                        text: "Anda Tidak Dapat Mengembalikan Data yang sudah dihapus",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Delete!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
