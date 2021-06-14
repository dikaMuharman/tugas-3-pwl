@extends('layout.app')

@section('content')
    <h1 class="mt-3">Edit Anggota</h1>
    <div class="row">
      <div class="col-md-3">
        <img src="{{asset('images/'.$data->foto)}}" class="img-thumbnail">
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('anggota.update',$data->id)}}" class="col-md-9">
        @csrf
        @method('PUT')
        <x-input name="nama" type="text" value="{{$data->nama}}"/>
        <x-input name="email" type="text" value="{{$data->email}}"/>
        <x-input name="hp" type="text" value="{{$data->hp}}"/>
        <x-input name="foto" type="file" placeholder="Photo" />
        <div class="d-flex justify-content-end align-items-center">
          <button type="submit" class="btn btn-success me-2">Simpan</button>
          <form action="{{route('anggota.destroy',$data)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Hapus</button>
          </form>
        </div>
      </form>
    </div>
@endsection