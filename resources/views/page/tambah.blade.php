@extends('layout.app')

@section('content')
    <h1>Tambah aggota</h1>
    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <x-input name="nama" type="text" placeholder="john doe"/>
      <x-input name="email" type="email" placeholder="johndoe@email.com"/>
      <x-input name="hp" type="text" placeholder="08123456789"/>
      <x-input name="foto" type="file" placeholder="Photo"/>
      <input type="submit" value="Tambah" class="btn btn-success">
    </form>
@endsection