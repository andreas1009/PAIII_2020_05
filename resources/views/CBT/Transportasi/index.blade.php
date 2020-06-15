@extends('layouts.CBT.master')
​
@section('title')
    <title>Manajemen Transportasi</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Transportasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manajemen Transportasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        @component('components.card')
                            @slot('header')
                                <b>Tambah</b>
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​                            @slot('body')   
                            <form role="form" action="{{ route('Transportasi.store') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_transportasi">Nama Transportasi</label>
                                    <input type="text" name="nama_transportasi" class="form-control {{ $errors->has('nama_transportasi') ? 'is-invalid':'' }}" id="nama_transportasi" required>
                                </div>
                                <div class="form-group">
                                    <label for="kabupaten_id">Kabupaten</label>
                                    <input type="text" name="kabupaten_id" class="form-control {{ $errors->has('kabupaten_id') ? 'is-invalid':'' }}" id="kabupaten_id" value="{{$kabupaten->nama_kabupaten}}" readonly>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="jenis_transportasi">Jenis Transportasi</label>
                                    <select class="form-control" name="jenis_transportasi">
                                            <option value="Mobil">Mobil</option>
                                            <option value="Sepeda Motor">Sepeda Motor</option>
                                            <option value="Kapal">Kapal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="5" rows="5" class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control {{ $errors->has('foto') ? 'is-invalid':'' }}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="ckeditor"  name="deskripsi" id="ckedtor" cols="5" rows="5" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" required=""></textarea>
                                </div>
                            @endslot    
                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @endslot
                        @endcomponent
                    </div>
                    <div class="col-md-8">
                    @component('components.card')
                                @slot('header')
                                <b>List Transportasi</b>
                            @endslot
                            
                            @slot('body')
                            @if (session('success'))
                                @component('components.alert')
                                    @slot('message')
                                        {!! session('success') !!}
                                    @endslot
                                @endcomponent
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                      <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Nama Transportasi</td>
                                            <td>Kabupaten</td>
                                            <td>Alamat</td>
                                            <td>Jenis Transportasi</td>
                                            <td>Deskripsi</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                   <tbody>
                                        @php $no=1; @endphp
                                        @foreach($transportasis as $transportasi)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{$transportasi->nama_transportasi}}</td>
                                                <td>{{$transportasi->kabupaten->nama_kabupaten}}</td>
                                                <td>{{ $transportasi->alamat }}</td>
                                                <td>{{ $transportasi->jenis_transportasi }}</td>
                                                <td>{{$transportasi->deskripsi}}</td>
                                                
                                                <td><form action="{{ route('Transportasi.destroy', $transportasi->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('Transportasi.edit', $transportasi->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $transportasis->links() }}
                            </div>
                            @endslot
                            @slot('footer')
​                               <i>List Transportasi</i>
                            @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </section>

    
    </div>
@endsection