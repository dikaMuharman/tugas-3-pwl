@extends('layout.app')

@section('content')
    <h1 class="mt-3">Anggota perpustakaan</h1>
    <a href="{{ route('anggota.index') }}" class="btn btn-primary">Tambah data</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Foto</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$data->nama}}</td>
                <td>{{$data->email}}</td>
                <td><img src="{{asset('images/'.$data->foto)}}" alt="{{$data->nama}}" class="img-fluid" height="100" width="100"></td>
                <form action="{{route('anggota.destroy',$data)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <td>
                        <a href="{{route('anggota.show',$data)}}" type="button" class="btn btn-success">Detail</a>
                        <a href="{{route('anggota.edit',$data)}}" class="btn btn-warning ">Edit</a>
                        <button type="submit" type="button" class="btn btn-danger">Hapus</button>            
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection