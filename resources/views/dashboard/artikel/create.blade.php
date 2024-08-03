@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Tambah Data Artikel </h2>

    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Form Data Artikel </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">


                    <form method="post" action="{{ route('artikel.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="sepatu_id">Nama Sepatu</label>
                            <select class="form-control @error('sepatu_id') is-invalid @enderror" id="sepatu_id"
                                name="sepatu_id">
                                <option selected disabled>Pilih Nama Sepatu</option>
                                @foreach ($sepatu as $s)
                                    <option value="{{ $s->id }}" {{ old('sepatu_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->nama_merk }}</option>
                                @endforeach
                            </select>
                            @error('sepatu_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_artikel">Nama Artikel</label>
                            <input type="text" class="form-control @error('nama_artikel') is-invalid @enderror"
                                name="nama_artikel" id="nama_artikel" value="{{ old('nama_artikel') }}">
                            @error('nama_artikel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
