@extends('layouts.master')

@section('content')

@if(count($data_buku))
        <div class="container">
        <div class="alert alert-success">Ditemukan <strong>{{count($data_buku)}}</strong> data dengan kata: <strong>{{ $cari }}</strong></div> 
        @if(Session::has('pesan'))
          <div class="alert alert-success">{{ Session::get('pesan') }}</div>
        @endif             
            <div class="area">
              <div class="kiri"><h4>Data Buku</h4></div>
              <div class="kanan"><a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a></div>
            </div>
            <form action="{{ route('buku.search') }}" method="get">@csrf
            <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
            </form>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Buku</th>
                  <th>Penulis</th>
                  <th>Harga</th>
                  <th>Tgl. Terbit</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_buku as $buku)
                <tr>
                  <td>{{ ++$no }}</td>
                  <td>{{ $buku->judul }}</td>
                  <td>{{ $buku->penulis }}</td>
                  <td>{{ number_format($buku->harga, 0, ',', '.') }}</td>
                  <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                  <td><form action="{{ route('buku.destroy', $buku->id) }}" method="post">@csrf
                  <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-info">Edit</a>
                  <button type="submit" class="btn btn-danger" onClick="return confirm('Yakin mau dihapus?')">Hapus</button></td>
                  </form>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="area">
              <div class="kanan">{{ $data_buku->links() }}</div>
            </div>
            @else
                <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan</h4>
                <a href="/buku" class="btn btn-warning">Kembali</a></div> 
            @endif
        </div>
@endsection
