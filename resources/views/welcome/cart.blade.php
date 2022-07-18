@extends('layouts.front.core')
@section('title')
Cart
@endsection
@section('content')
<div class="container py-5">
<h3> <b> Cart Belanja </b> </h3>
<hr class="my-4">
@if (empty($result))
<b>Cart Belanja Kosong Kosong</b>
@elseif (empty($data2))
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
    <tr>
      <td style="text-align:center" colspan="6"> <h3>Cart Belanja Kosong</h3></td>
    </tr>
</tbody>
</table>
  @else
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
    @foreach ($data1 as $d)
<tr>
    <td class="text-center">{{$loop->iteration}}</td>
    <td>{{$d->produk->nama_barang}}</td>
    <td>{{$d->produk->kategori->nama_kategori}}</td>
    <td>
        {{$d->jumlah_produk}} x Rp. {{number_format($d->produk->harga, 0, ',', '.') }},-</span>
    </td>
    <td>Rp. {{number_format($d->produk->harga * $d->jumlah_produk, 0, ',', '.') }},-</td>
    <td><button class="btn btn-sm btn-danger">Hapus</i></button></td>
</tr>
@endforeach
</tbody>
</table>
@endif

<form method="get" action="{{route('pembayaran1' , ['id' => Auth()->user()->id])}}" novalidate>
@csrf
<div class="row align-items-start">
@auth
<div class="py-5 col">
<h4 class="mb-3">Data Pembeli</h4>
    <div class="row g-3">
            <div class="col-sm-12">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value=" {{ Auth::user()->name }}" required>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="you@example.com" value=" {{ Auth::user()->email }}" required>
            </div>

            <div class="col-12">
              <label for="telepon" class="form-label">telepon</label>
              <input type="text" class="form-control" name="telepon" placeholder="Nomor HP" value=" {{ Auth::user()->telepon }}" required>
            </div>

            <div class="col-12">
              <label for="alamat" class="form-label">alamat</label>
              <input type="text" class="form-control" name="alamat" placeholder="Alamat Tempat tinggal" value=" {{ Auth::user()->alamat }}" required>
            </div>
@endauth
          </div>
    </div>


<div class="py-5 col">
<h4 class="mb-3">Metode Pembayaran</h4>
<div class="my-3">
  <div class="form-check">
    <input id="credit" name="paymentMethod" type="radio" value="Credit Card" class="form-check-input" checked required>
    <label class="form-check-label" for="credit">Credit card</label>
  </div>
  <div class="form-check">
    <input id="dana" name="paymentMethod" type="radio" value="Dana" class="form-check-input" required>
    <label class="form-check-label" for="Dana">Dana</label>
  </div>
  <div class="form-check">
    <input id="ovo" name="paymentMethod" type="radio" value="Ovo" class="form-check-input" required>
    <label class="form-check-label" for="Ovo">Ovo</label>
  </div>
</div>
</div>

<hr class="my-4">
<button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
</div>
</form>
@endsection

