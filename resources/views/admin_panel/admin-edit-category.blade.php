@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Edit Kategori')
@section('content')

    <div class="content-wrapper ">

        {{-- breadcrumb --}}

        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6">
                    <h1 class="m-2">Edit Kategori</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageCategory">Kategori List</a></li>
                        <li class="breadcrumb-item active">Edit Kategori</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container-fluid mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-center bg-primary">Form Edit Kategori</div>
                        <div class="card-body">
                            <p><span style="color: red">*</span> Silahkan isi form dibawah ini untuk Mengedit Kategori</p>
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
                            <form action="/admin_panel/adminManageCategory/{{ $kategori->id }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama Kategori</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $kategori->name }}" required autocomplete="off">
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
        @include('sweetalert::alert')
    </div>
@endsection
