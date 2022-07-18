@extends('layouts.back.core')
@section('tittle') Supplier @endsection
@section('head')
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection
@section('content')

<div class="content-wrapper" style="min-height: 1203.6px;">
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Supplier</a></li>
              <li class="breadcrumb-item"><a href="#">Edit Supplier</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                 <a style="float: right; margin-right: 5px;" class="btn btn-sm btn-danger text-white">Kembali</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">



            <form method="POST" action="{{route('editsupplier',['id', $data->id])}}">
            {{method_field('PUT')}}
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$data->nama}}" placeholder="Masukkan Nama Produk" value="{{old('nama')}}">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{$data->telepon}}" placeholder="Masukkan Nomor Telepon" value="{{old('telepon')}}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data->alamat}}" placeholder="Masukkan Alamat" value="{{old('alamat')}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
</section>
</div>
@endsection
@section('script')
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
@endsection
