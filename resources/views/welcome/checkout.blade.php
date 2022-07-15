@extends('layouts.front.core')

@section('title')
Detail Produk
@endsection

@section('content')
<div class="container">
  <main>
    <div class="py-5 row g-7">
      <div class="col-md-5 col-lg-6 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Checkout Produk</span>
          <span class="badge bg-primary rounded-pill">{{$count->count()}}</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">{{$data->nama_barang}}</h6>
              <small class="text-muted">{{$data->kategori->nama_kategori}}</small>
            </div>
            <form method="POST" action="{{route('cart' , ['id' => $data->id])}}">
            @csrf
            <span class="text-muted"> <input type="number" style="width: 46px;" name="jumlah_produk" value="{{$result->jumlah_produk}}"> <button class="btn btn-sm btn-primary">+</button> x Rp. {{number_format($data->harga, 0, ',', '.') }},-</span>
            </form>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total</span>
            <strong>Rp. {{number_format($data->harga * $result->jumlah_produk, 0, ',', '.') }},-</strong>
          </li>
        </ul>
    </div>



    @auth
      <div class="col-md-5 col-lg-6">
        <h4 class="mb-3">Data Pembeli</h4>
        <form method="POST" action="" novalidate>
        @csrf

          <div class="row g-3">
            <div class="col-sm-12">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" value=" {{ Auth::user()->name }}" required>
              <input type="text" hidden name="produk_id" id="produk_id" value="{{$data->id}}">
              <input type="text" hidden name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com" value=" {{ Auth::user()->email }}">
            </div>

            <div class="col-12">
              <label for="telepon" class="form-label">telepon</label>
              <input type="number" class="form-control" id="telepon" placeholder="Nomor HP" value=" {{ Auth::user()->telepon }}" required>
            </div>

            <div class="col-12">
              <label for="alamat" class="form-label">alamat</label>
              <input type="text" class="form-control" id="alamat" placeholder="Alamat Tempat tinggal" value=" {{ Auth::user()->alamat }}" required>
            </div>
    @endauth

          <hr class="my-4">



          <h4 class="mb-3">Metode Pembayaran</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" value="card" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="dana" name="paymentMethod" type="radio" value="dana" class="form-check-input" required>
              <label class="form-check-label" for="dana">Dana</label>
            </div>
            <div class="form-check">
              <input id="ovo" name="paymentMethod" type="radio" value="ovo" class="form-check-input" required>
              <label class="form-check-label" for="ovo">Ovo</label>
            </div>
          </div>
          <hr class="my-4">

    <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
</form>
</div>
</div>
</main>
</div>
@endsection
