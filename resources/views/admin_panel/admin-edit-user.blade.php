@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Edit User')
@section('content')

    <div class="content-wrapper ">

        {{-- breadcrumb --}}

        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6">
                    <h1 class="m-2">Edit User</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageUser">User List</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container-fluid pb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-center bg-primary">Form Edit User</div>
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
                            <form action="/admin_panel/adminManageUser/{{ $user->id }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name" required
                                            autocomplete="off" value="{{ $user->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="telp">No WhatsApp</label>
                                        <input type="text" class="form-control" name="no_telp" id="telp" required
                                            autocomplete="off" value="{{ $user->no_telp }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" required
                                            autocomplete="off" value="{{ $user->email }}">
                                        {{-- @if ($user->email)
                                            <p>Email sudah ada dan tidak boleh sama</p>
                                        @endif --}}
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            autocomplete="off">
                                        <small>Biarkan kosong jika tidak akan diganti</small>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="role">Role</label>
                                        <select class="form-select" name="role_id" id="role" required>
                                            <option value="{{ $user->role_id }}" selected>
                                                {{ ucwords($user->nama_role->name) }}</option>
                                            @foreach ($role as $roles)
                                                <option value="{{ $roles->id }}">{{ ucwords($roles->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10">{{ $user->alamat }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Foto Saat ini</label>
                                        <div class="my-3">
                                            @if ($user->image != null)
                                                <img class="img-fluid rounded"
                                                    src="{{ asset('storage/admin_assets/images_users/' . $user->image) }}"
                                                    alt="foto_user" width="200px">
                                            @else
                                                <img class="img-fluid rounded mb-2"
                                                    src="{{ asset('storage/users/images/pp.png') }}" alt="foto_user"
                                                    width="200px">
                                                <p><span style=" color: red">*</span> Tidak Ada Foto Profil</p>
                                            @endif
                                        </div>

                                        <label class="form-label" for="foto">Upload Foto</label>
                                        <input type="file" class="form-control" name="foto" id="foto">
                                    </div>
                                </div>
                                <div class="float-end mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
