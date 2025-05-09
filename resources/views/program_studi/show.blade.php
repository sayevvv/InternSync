@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Program Studi</h3>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <td>{{ $prodi->id }}</td>
        </tr>
        <tr>
            <th>Kode</th>
            <td>{{ $prodi->kode }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $prodi->nama }}</td>
        </tr>
        <tr>
            <th>Dibuat Pada</th>
            <td>{{ $prodi->created_at->format('d M Y H:i') }}</td>
        </tr>
    </table>
    <a href="{{ route('program-studi.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
