@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Tambah Data Issue </h2>

    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Form Data </h4>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('issue.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_sepatu">Nama Sepatu</label>
                    <select class="form-control" name="sepatu_id">
                        <option selected disabled>Pilih Sepatu</option>
                        @foreach ($sepatu as $item)
                            <option value={{ $item->id }}>{{ $item->nama_merk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" name="gambar" id="gambar">
                </div>

                <div class="form-group">
                    <label for="gambar">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" cols="50"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
