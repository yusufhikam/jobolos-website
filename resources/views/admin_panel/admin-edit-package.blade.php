@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Edit Paket Photoshoot')
@section('content')

    <div class="content-wrapper ">

        {{-- breadcrumb --}}

        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6">
                    <h1 class="m-2">Edit Paket Photoshoot</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManagePackage">Photoshoot Packages List</a>
                        </li>
                        <li class="breadcrumb-item "><a href="/admin_panel/admin-add-package">Tambah Paket Photoshoot</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Paket Photoshoot</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="m-4">
                <a href="/admin_panel/adminManagePackage" class="btn btn-warning"><i class="fa-solid fa-circle-left"></i>
                    Kembali</a>
            </div>
            <div class="container-fluid p-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-center bg-primary">Form Edit Paket Photoshoot</div>
                        <div class="card-body">
                            <p><span style="color: red">*</span> Silahkan isi form dibawah ini untuk menambahkan Paket
                                Photoshoot</p>
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
                            <form action="/admin_panel/adminManagePackage/{{ $package->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama Paket Photoshoot</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $package->name }}" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="harga">Harga Paket</label>
                                        <input type="number" class="form-control" name="harga" id="harga"
                                            value="{{ $package->harga }}" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="deskripsi-textarea">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi-textarea" cols="30" rows="10">{!! htmlspecialchars_decode($package->deskripsi) !!}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Foto Saat ini</label>
                                        <div class="my-3">
                                            @if ($package->image != null)
                                                <img class="img-fluid rounded"
                                                    src="{{ asset('storage/admin_assets/package/' . $package->image) }}"
                                                    alt="foto_user" width="200px">
                                            @else
                                                <img class="img-fluid rounded mb-2"
                                                    src="{{ asset('storage/admin_assets/package/package.png') }}"
                                                    alt="foto_user" width="200px">
                                                <p><span style=" color: red">*</span> Tidak Ada Foto Profil</p>
                                            @endif
                                        </div>

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

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi-textarea'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
