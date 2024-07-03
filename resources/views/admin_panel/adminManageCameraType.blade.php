@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Manage Camera Types')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Tipe Kamera List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageCamera">Kamera List</a></li>
                        <li class="breadcrumb-item active">Tipe Kamera List</li>
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
                            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahModal"
                                class="btn btn-success "><i class="fa-regular fa-plus"></i>
                                Tambah Tipe Kamera</button>
                        </div>
                    </div>
                </div>

                {{-- Modal tambah tipe kamera --}}
                <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Tipe Kamera</h1>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin_panel/adminManageCameraType/Add-Camera-Types" method="POST">
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
                </div>

                {{-- TABLE CAMERA LIST --}}

                <div class="container-fluid">
                    <div class="table-responsive">
                        @if ($camera_types->isEmpty())
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
                                        <th>Brands</th>
                                        <th>Tipe Kamera</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($camera_types as $camera)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $camera->brands->name }}</td>
                                            <td>{{ $camera->name }}</td>
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
                                                        <form
                                                            action="/admin_panel/adminManageCameraType/destroy-camera-type{{ $camera->id }}"
                                                            method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a class="d-grid "
                                                                href="/admin_panel/adminManageCameraType/destroy-camera-type{{ $camera->id }}"><button
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
                                                                action="/admin_panel/adminManageCameraType/Edit-Camera-Type/{{ $camera->id }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="col-auto">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="camera_type">Tipe
                                                                            Kamera</label>
                                                                        <select class="form-select" name="brand_id"
                                                                            id="camera_type" required>
                                                                            <option value="">-- Pilih Brands Kamera--
                                                                            </option>
                                                                            @foreach ($brands as $brand)
                                                                                <option value="{{ $brand->id }}"
                                                                                    @if ($brand->id == $camera->brand_id) selected @endif>
                                                                                    {{ $brand->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="name">Tipe
                                                                            Kamera</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" id="name"
                                                                            value="{{ $camera->name }}" required
                                                                            autocomplete="off">
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
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        {{-- PAGINATION --}}

                        <div class="mt-2">
                            {{ $camera_types->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')

@endsection

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
        .create(document.querySelector('#deskripsi-tambah'))
        .catch(error => {
            console.error(error);
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
