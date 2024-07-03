@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Manage Lenses')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Lenses List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active">Lenses List</li>
                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->

        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-end">

                    <div class="col-lg-6 col-sm-12 mb-4 float-end">
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
                <div class="row">
                    {{-- FORM TAMBAH DATA brand --}}
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header text-center bg-primary">Form Tambah Lensa</div>
                            <div class="card-body">
                                <p><span style="color: red">*</span> Silahkan isi form dibawah ini untuk menambahkan Data
                                    Lensa
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
                                <form action="/admin_panel/adminManageLens" method="POST">
                                    @csrf
                                    <div class="col-auto">
                                        <div class="mb-3">
                                            <label class="form-label" for="camera">Tipe Kamera</label>
                                            <select class="form-select" name="camera_type_id" id="camera" required>
                                                <option value="">-- Pilih Tipe Kamera--</option>
                                                @foreach ($tipeKamera as $camera)
                                                    <option value="{{ $camera->id }}">
                                                        {{ ucwords($camera->name) }} - {{ $camera->brands->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Tipe Lensa</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name') }}" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="code">Kode Lens</label>
                                            <input type="text" class="form-control" name="code" id="code"
                                                value="{{ old('code') }}" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="harga">Harga Sewa per Hari</label>
                                            <input type="number" class="form-control" name="harga_per_hari" id="harga"
                                                value="{{ old('harga_per_hari') }}" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="float-end mt-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- TABLE brand LIST --}}
                    <div class="col-lg-9">
                        {{-- <div class="row mb-2 ms-2 me-2 justify-content-end "> --}}

                        {{-- </div> --}}
                        <div class="table-responsive">
                            @if ($lenses->isEmpty())
                                <div class=" alert alert-danger text-center " role="alert">
                                    <h2>Oops!</h2>
                                    <p>Untuk saat ini data Lensa tidak ada
                                    </p>
                                </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary text-center">
                                            <th>No</th>
                                            <th>Tipe Lensa</th>
                                            <th>Kode Lensa</th>
                                            <th>Tipe Kamera / Brands</th>
                                            <th>Harga Sewa per Hari</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lenses as $lens)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $lens->name }}</td>
                                                <td>{{ $lens->code }}</td>
                                                <td>{{ $lens->camera_types->name }} /
                                                    {{ $lens->camera_types->brands->name }}</td>
                                                <td>Rp {{ number_format($lens->harga_per_hari, 0, ',', '.') }}</td>
                                                <td>
                                                    <div class="row g-2 justify-content-center">

                                                        <div class="col-auto">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $lens->id }}"
                                                                class="btn btn-warning"><i class="fa-regular fa-edit"></i>
                                                                Edit</button>

                                                        </div>
                                                        <div class="col-auto">
                                                            <form action="/admin_panel/adminManageLens/{{ $lens->id }}"
                                                                method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')

                                                                <a href="/admin_panel/adminManageLens/{{ $lens->id }}"><button
                                                                        type="submit"
                                                                        class="btn btn-danger delete-button"><i
                                                                            class="fa-solid fa-trash"></i>
                                                                        Delete</button></a>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    {{-- Modal Edit --}}
                                                    <div class="modal fade" id="editModal{{ $lens->id }}"
                                                        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="editModalLabel">Edit
                                                                        Data Lensa</h1>
                                                                    <button class="btn-close" type="button"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="/admin_panel/adminManageLens/{{ $lens->id }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="col-auto">
                                                                            <div class="mb-3">
                                                                                <label class="form-label"
                                                                                    for="camera">Tipe Kamera</label>
                                                                                <select class="form-select"
                                                                                    name="camera_type_id" id="camera"
                                                                                    required>
                                                                                    <option value="">-- Pilih Tipe
                                                                                        Kamera--</option>
                                                                                    @foreach ($tipeKamera as $camera)
                                                                                        <option
                                                                                            value="{{ $camera->id }}"
                                                                                            @if ($camera->id == $lens->camera_type_id) selected @endif>
                                                                                            {{ ucwords($camera->name) }} -
                                                                                            {{ $camera->brands->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label"
                                                                                    for="name">Tipe
                                                                                    Lens</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="name" id="name"
                                                                                    value="{{ $lens->name }}" required
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label"
                                                                                    for="code">Kode Lens</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="code" id="name"
                                                                                    value="{{ $lens->code }}" required
                                                                                    autocomplete="off">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label"
                                                                                    for="harga">Harga Sewa per
                                                                                    Hari</label>
                                                                                <input type="number" class="form-control"
                                                                                    name="harga_per_hari" id="harga"
                                                                                    value="{{ $lens->harga_per_hari }}"
                                                                                    required autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="float-end mt-3">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                            {{-- PAGINATION --}}

                            {{-- <div class="mt-2">
                        {{ $user->withQueryString()->links() }}
                    </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')
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
