@extends('layout.app')

@section('content')
    <h1 class="mt-3">Detail Anggota</h1>
    <div class="row">
      <div class="col-md-3">
        <img src="{{asset('images/'.$data->foto)}}" class="img-thumbnail">
      </div>
      <div class="col-md-9">
        <x-input name="nama" type="text" value="{{$data->nama}}" readonly/>
        <x-input name="email" type="text" value="{{$data->email}}" readonly/>
        <x-input name="hp" type="text" value="{{$data->hp}}" readonly/>
        <div class="d-flex justify-content-end align-items-center">
          <a href="{{route('anggota.edit',$data)}}" class="btn btn-warning me-2">Edit</a>
          <form action="{{route('anggota.destroy',$data)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
@endsection