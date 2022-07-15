@extends('layouts.front.core')
@section('title')
Cart
@endsection
@section('content')
<div class="container py-5">
<h3> <b> Cart Belanja </b> </h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Kategori</th>
      <th scope="col">Jumlah Produk</th>
      <th scope="col">Harga Total</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <form method="POST" action="{{route('indexcheckout')}}">
    @if (empty($result))
    <b>Data Tidak Ada</b>
    @else
    @foreach ($data1 as $d)
    <tr>
    <td class="text-center">{{$loop->iteration}}</td>
    <td>{{$d->produk->nama_barang}}</td>
    <td>{{$d->produk->kategori->nama_kategori}}</td>
    <td>
        {{$d->jumlah_produk}} x Rp. {{number_format($d->produk->harga, 0, ',', '.') }},-</span>
    </td>
    <td>Rp. {{number_format($d->produk->harga * $d->jumlah_produk, 0, ',', '.') }},-</td>
    <td><button class="btn btn-danger btn-sm">x</button></td>
    @endforeach
</tr>
    @endif
  </tbody>
</table>

<button type="submit" style="float: right;" name="submit" class='btn btn-success' aria-label='Left Align' onclick="confirm('Apakah Anda Yakin ?')"> <span class='glyphicon glyphicon-check' aria-hidden='true'></span> Selesaikan Belanja</button>
</form>
</div>
@endsection
