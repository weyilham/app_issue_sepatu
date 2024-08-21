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
                    <label for="nama_artikel">Nama Artikel</label>
                    <select class="form-control nama-artikel" name="artikel_id" id="nama_artikel">
                        <option selected disabled>Pilih Artikel</option>
                        @foreach ($artikel as $item)
                            <option value={{ $item->id }} data-idSepatu={{ $item->sepatu_id }}>{{ $item->nama_artikel }}
                            </option>
                        @endforeach
                    </select>
                    @error('artikel_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sepatu_id">Merk Sepatu</label>
                    <input type="text" class="form-control" name="sepatu_id" id="sepatu_id" readonly>
                    @error('sepatu_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" name="gambar" id="gambar">
                    @error('gambar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gambar">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" cols="50">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const nama_artikel = $('.nama-artikel');
            const nama_sepatu = $('#sepatu_id');

            nama_artikel.on('change', function(e) {
                const selectedOption = $(this).find('option:selected');
                const id_sepatu = selectedOption.data('idsepatu');
                // console.log(id_sepatu)
                $.ajax({
                    type: "GET",
                    url: `{{ url('getShoes') }}/${id_sepatu}`,
                    success: function(response) {
                        console.log(response)
                        nama_sepatu.val(response.nama_merk)
                    }
                })

            })

        })
    </script>
@endpush
