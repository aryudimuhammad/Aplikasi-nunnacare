@extends('layouts.front.core')
@section('title')
List Pembayaran
@endsection
@section('content')
    <div class="wrap py-5">
        <div class="container-lg">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Notransaksi</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Estimasi</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td>{{$d->notransaksi}}</td>
            <td>{{$d->metode_pembayaran}}</td>
            @if ($d->estimasi == null)
            <td>-</td>
            @else
            <td>{{$d->estimasi}}</td>
            @endif

            @if ($d->status == 1)
            <td><a class="btn btn-sm btn-secondary">Menunggu Verifikasi</a></td>
            @elseif ($d->status == 2)
            <td><a href="{{route('pembayaran', ['id' => Auth()->user()->id , 'idn' => $d->notransaksi])}}" class="btn btn-sm btn-primary">Pembayaran</a></td>
            @elseif ($d->status == 3)
            <td><a class="btn btn-sm btn-outline-secondary">Proses Pengiriman</a></td>
            @elseif ($d->status == 4)
            <td><a class="btn btn-sm btn-outline-warning">Proses Pengiriman</a></td>
            @endif

            @if ($d->status == 1)
            <td><button class="btn btn-sm btn-danger">Cancel</i></button></td>
            @elseif ($d->status == 2)
            <td><button class="btn btn-sm btn-danger">Cancel</i></button></td>
            @elseif ($d->status == 3)
            <td><a class="btn btn-sm btn-outline-primary" href="{{route('pembayaran',['id' => Auth()->user()->id ,'idn' => $d->notransaksi])}}">Lihat</i></button></td>
            @elseif ($d->status == 4)
            <form action="{{route('diterima',['id' => Auth()->user()->id , 'idn' => $d->notransaksi])}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="text" hidden id="notransaksi" name="notransaksi" value="{{$d->notransaksi}}">
                    <td><button type="submit" class="btn btn-sm btn-primary">Diterima</i></button></td>
            </form>
            @endif
        </tr>
        @endforeach
        </tbody>
        </table>
        </div>
    </div>
@endsection















