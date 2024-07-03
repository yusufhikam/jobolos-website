@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Tambah User')
@section('content')

    <div class="content-wrapper ">

        {{-- breadcrumb --}}

        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6">
                    <h1 class="m-2">Tambah User</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageUser">User List</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="m-4">
                <a href="/admin_panel/adminManageUser" class="btn btn-warning"><i class="fa-solid fa-circle-left"></i>
                    Kembali</a>
            </div>
            <div class="container-fluid p-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-center bg-primary">Form Tambah User</div>
                        <div class="card-body">
                            <p><span style="color: red">*</span> Silahkan isi form dibawah ini untuk menambahkan User</p>
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
                            <form action="/admin_panel/adminManageUser" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="telp">No WhatsApp</label>
                                        <input type="text" class="form-control" name="no_telp" id="telp"
                                            value="{{ old('no_telp') }}" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            value="{{ old('email') }}" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="text" class="form-control" name="password" id="password" required
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="role">Role</label>
                                        <select class="form-select" name="role_id" id="role" required>
                                            <option value="">-- Pilih Role --</option>
                                            @foreach ($role as $roles)
                                                <option value="{{ $roles->id }}">{{ ucwords($roles->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10">{{ old('alamat') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="foto">Upload Foto</label>
                                        <input type="file" class="form-control" name="foto" id="foto">
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
        </section>
    </div>

@endsection
