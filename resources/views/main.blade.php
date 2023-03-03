@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            </div>
        @endif
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="col-md-12">
            <h3>Daftar Barang</h3>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputBarangModal">Input Barang Baru</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="table table-responsive">
                    <table id="table" name="table" class="table table-responsive table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($barang as $b)
                            <tr>
                                <td>{{$b->id}}</td>
                                <td><img src="{{asset('upload/barang/'.$b->foto_barang)}}" alt="" class="img-fluid mx-auto d-block" width="200px"></td>
                                <td>{{$b->nama_barang}}</td>
                                <td>{{$b->harga_beli}}</td>
                                <td>{{$b->harga_jual}}</td>
                                <td>{{$b->stok}}</td>
                                <td>
                                    <div class="btn-toolbar justify-content-center align-items-center">
                                        <div class="btn-group me-2">
                                            <button type="button" id="data_edit" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#updateBarangModal"
                                                    data-db-namaBarang="{{$b->nama_barang}}"
                                                    data-db-hargaBeli="{{$b->harga_beli}}"
                                                    data-db-hargaJual="{{$b->harga_jual}}"
                                                    data-db-stok="{{$b->stok}}"
                                                    data-db-idBarang="{{$b->id}}" >Update Informasi Barang</button>
                                        </div>
                                        <div class="btn-group me-2">
                                            <form action="{{route('barang.destroy', $b->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="version1" name="source" id="source"/>
                                                <button name="delete" type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin untuk menghapus data?')">Hapus Barang</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                {{ $barang->links()}}
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="inputBarangModal" tabindex="-1" aria-labelledby="inputBarangModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="inputBarangModel">Input Barang Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formInputBarang" method="POST" action="{{route('barang.store')}}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="version1" name="source" id="source"/>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{old('nama_barang')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{old('harga_beli')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{old('harga_jual')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" value="{{old('stok')}}" required>
                        </div>
                        <div class="mb-4">
                            <label for="foto_barang" class="form-label">Foto Barang</label>
                            <input type="file" class="form-control" id="foto_barang" name="foto_barang">
                        </div>
                        <div class="mt-3 d-flex flex-row-reverse">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <button type="submit" name="submit" class="btn btn-primary" id="submit">Input Barang Baru</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

<div class="modal fade" id="updateBarangModal" name="updateBarangModal" tabindex="-1" aria-labelledby="updateBarangModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateBarangModal">Form Ubah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUpdateBarang" method="POST" action="{{route('barang.updatebarang')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="version1" name="source" id="source"/>
                    <input type="hidden" value="" id="id_barang" name="id_barang">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="" required>

                    </div>
                    <div class="mb-3">
                        <label for="foto_barang" class="form-label">Foto Barang</label>
                        <input type="file" class="form-control" id="foto_barang" name="foto_barang">
                    </div>
                    <div class="mt-3 d-flex flex-row-reverse">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <button type="submit" name="submit" class="btn btn-primary" id="submit">Update Informasi Barang Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script>

        let modal_update = document.getElementById('updateBarangModal');
        modal_update.addEventListener('show.bs.modal' , event => {
            let button = event.relatedTarget;

            let nama_barang = button.getAttribute('data-db-namaBarang');
            let harga_beli = button.getAttribute('data-db-hargaBeli');
            let harga_jual = button.getAttribute('data-db-hargaJual')
            let stok = button.getAttribute('data-db-stok');
            let id_barang = button.getAttribute('data-db-idBarang');

            let inputNamaBarang = modal_update.querySelector('.modal-body input[name="nama_barang"]');
            let inputHargaBeli = modal_update.querySelector('.modal-body input[name="harga_beli"]');
            let inputHargaJual = modal_update.querySelector('.modal-body input[name="harga_jual"]');
            let inputStok = modal_update.querySelector('.modal-body input[name="stok"]');
            let inputId_barang = modal_update.querySelector('.modal-body input[name="id_barang"]');

            inputNamaBarang.value = nama_barang;
            inputHargaBeli.value = harga_beli;
            inputHargaJual.value = harga_jual;
            inputStok.value = stok;
            inputId_barang.value = id_barang;

        });
    </script>
@endsection
