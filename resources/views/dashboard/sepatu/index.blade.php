@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Data sepatu </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Daftar Sepatu</h4>
                </div>
                <div class="card-body">
                    <button type="button" data-toggle="modal" data-target="#addModal"
                        class="btn btn-primary tambahData mb-3">Tambah Data
                        Sepatu</button>

                    <table class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Merk</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="Tbody">
                            @foreach ($sepatu as $sepatu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sepatu->nama_merk }}</td>
                                    <td>{{ $sepatu->slug }}</td>
                                    <td class="text-center">
                                        <Button type="button" class="btn btn-primary btn-sm editData" data-toggle="modal"
                                            data-target="#addModal" data-id="{{ $sepatu->id }}"> <i
                                                class="fas fa-edit"></i> </Button>
                                        <Button type="button" class="btn btn-danger btn-sm hapusData"
                                            data-id="{{ $sepatu->id }}">
                                            <i class="fas fa-trash"></i> </Button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Merk Sepatu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Merk</label>
                        <input type="text" class="form-control" name="nama_merk" id="nama_merk">
                    </div>

                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombolClose" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tombolAksi">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.tombolClose').click(function() {
                $('#nama_merk').val("");
                $('#slug').val("");

            })
            $(document).on('click', '.tambahData', function(e) {
                $('.modal-backdrop').hide();
                $('.tombolAksi').addClass('SimpanData');
                $('.modal-title').html('Tambah Data Merk Sepatu')
                $('.tombolAksi').html('Simpan Data')
            })

            // Simpan Data
            $(document).on('change', '#nama_merk', function(e) {
                const nama_merk = e.target.value;
                $('#slug').val(nama_merk.toLowerCase().replace(/ /g, "-"));
                $('.SimpanData').off('click').on('click', function() {
                    const nama_merk = $('#nama_merk').val();
                    const slug = $('#slug').val();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('sepatu.store') }}",
                        data: {
                            'nama_merk': nama_merk,
                            'slug': slug
                        },
                        success: function(response) {

                            $('#nama_merk').val("");
                            $('#slug').val("");
                            $('#addModal').modal('hide');
                            $('.tombolAksi').removeClass('SimpanData');

                            Swal.fire({
                                title: "Good job!",
                                text: response.success,
                                icon: "success"
                            });

                            $.ajax({
                                type: "get",
                                url: "{{ url('getTableSepatu') }}",
                                success: function(response) {
                                    $('#myTable').html(response);
                                }
                            })
                        },
                        error: function(response) {
                            console.log(response)
                            Swal.fire({
                                title: "Oops!",
                                text: 'Nama Sepatu Sudah Ada!',
                                icon: "error"
                            })
                        }
                    })

                })
            })

            // Update Data
            $(document).on('click', '.editData', function(e) {
                e.preventDefault();
                $('.modal-backdrop').hide();
                const id = this.dataset.id

                $('.modal-title').html('Edit Data Merk Sepatu')
                $('.tombolAksi').html('Update Data')
                $('.tombolAksi').addClass('UpdateData')


                $.ajax({
                    type: "GET",
                    url: `{{ url('sepatu') }}/${id}/edit`,
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        // $('#addModal').modal('show');
                        $('#nama_merk').val(response.data.nama_merk);
                        $('#slug').val(response.data.slug);
                        // console.log(response);
                        $(".UpdateData").off('click').on('click', function() {
                            const id = response.data.id
                            const nama_merk = $('#nama_merk').val();
                            const slug = $('#slug').val();

                            // console.log('ok')
                            $.ajax({
                                type: "PUT",
                                url: `{{ url('sepatu') }}/${id}`,
                                data: {
                                    'id': id,
                                    'nama_merk': nama_merk,
                                    'slug': slug
                                },
                                success: function(response) {
                                    $('#nama_merk').val("");
                                    $('#slug').val("");

                                    $('#addModal').modal('hide');
                                    $('.tombolAksi').removeClass(
                                        'UpdateData');

                                    Swal.fire({
                                        title: "Good job!",
                                        text: response.success,
                                        icon: "success"
                                    });

                                    $.ajax({
                                        type: "get",
                                        url: "{{ url('getTableSepatu') }}",
                                        success: function(
                                            response) {
                                            $('#myTable').html(
                                                response);

                                        }
                                    })

                                    console.log(response);
                                }
                            })
                        })
                    }
                })







            })

            // Hapus Data
            $(document).on('click', '.hapusData', function(e) {
                const id = $(this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: `{{ url('sepatu') }}/${id}`,
                            data: {
                                'id': id
                            },
                            success: function(response) {

                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.success,
                                    icon: "success"
                                });
                                $.ajax({
                                    type: "get",
                                    url: "{{ url('getTableSepatu') }}",
                                    success: function(response) {
                                        $('#myTable').html(response);
                                    }
                                })
                            }
                        })
                    }
                });



            })


        })
    </script>
@endpush
