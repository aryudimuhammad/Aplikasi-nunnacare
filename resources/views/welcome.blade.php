@extends('layouts.front.core')

@section('title')
Home
@endsection

@section('content')
<section class="py-5 text-center container">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">

            @foreach($carousel as $d)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }} data-bs-interval="
                    10000">
                    <img src="{{ $d->gambar }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $d->nama_barang }}</h5>
                        <p>{{ $d->keterangan }}</p>
                    </div>
                </div>
            @endforeach

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
</section>

<!---- batas ----->

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($produk as $d)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{$d->gambar}}" alt="gambar">
                        <div class="card-body">
                            <h1>{{ $d->nama_barang }}</h1>
                            <p class="card-text">{{$d->keterangan}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Rp. {{number_format($d->harga, 0, ',', '.') }},-</small>
                                <div class="btn-group">
                                    @if(Route::has('login'))
                                    @auth
                                    <form method="POST" action="{{route('cart' , ['id' => Auth()->user()->id])}}">
                                        @csrf
                                        <input type="text" hidden name="produk_id" value="{{$d->id}}">
                                        <input type="text" hidden name="user_id" value="{{ Auth()->user()->id}}">
                                        <a type="button" href="{{route('detail' , ['id' => $d->id])}}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Tambahkan Cart</button>
                                    </form>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Tambahkan Cart</button>
                                    <a type="button" href="{{route('detail' , ['id' => $d->id])}}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                    @endauth
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <br><br>
        <div class="d-flex justify-content-center">
            {{ $produk->links() }}
        </div>
    </div>
</div>
@endsection
