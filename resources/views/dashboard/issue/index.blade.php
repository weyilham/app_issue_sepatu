@extends('Layouts.main')

@push('styles')
    <style>
        .d_gambar:hover {
            cursor: pointer;
            transform: scale(1.1);
            transition: 0.5s;
            filter: grayscale(70%);
        }

        .gambar-preview {
            position: absolute;
            top: 0;
            left: 0;
            width: 80vw;
            height: 80vh;
            background-color: rgba(0, 0, 0);
            z-index: 9999;
            border: 1px solid rgb(33, 83, 200);
            border-radius: 14px;
            display: none;

        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            font-weight: 500;
            color: rgb(215, 0, 0);
            border-radius: 50%;
            cursor: pointer;
        }

        .close-button:hover {
            transition: 0.5s;
            scale: 1.1;
            color: rgb(255, 42, 42)
        }

        .d_gambar_priview {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
@endpush

@section('content')
    <div class="gambar-preview">
        <div class="close-button">X</div>
        <img src="" alt="gambar-priview" class="d_gambar_priview">
    </div>

    <h2 class="section-title">Data Issue </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Daftar Issue</h4>
                </div>
                <div class="card-body">
                    <a href="/issue/create" class="btn btn-primary mb-3">Tambah Data</a>
                    <div class="action-session" data-session="{{ session('success') }}"></div>

                    <table class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal Issue</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>






    <!-- Modal Detail -->
    <div class="modal fade" id="formDetail" tabindex="-1" aria-labelledby="formDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditLabel">Detail Issue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Nama Artikel</th>
                                    <td>:</td>
                                    <td class="d_nama_artikel">Adidas 123</td>
                                </tr>

                                <tr>
                                    <th>Tanggal Issue</th>
                                    <td>:</td>
                                    <td class="d_tgl_issue">19 Mei 2028</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>:</td>
                                    <td class="d_deskripsi">Deskripsi</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        <span class="badge d_status">Proses</span>
                                    </td>
                                </tr>

                            </table>
                        </div>


                        <div class="col-md-6">
                            <table class="table  ">

                                <tr>
                                    <th>Gambar : </th>

                                </tr>

                                <tr>
                                <tr>
                                    <td class="">
                                        <img src="https://via.placeholder.com/150"
                                            class="img-thumbnail object-fit-cover d_gambar" width="150" height="150"
                                            alt="Gambar">
                                    </td>

                                </tr>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger tombolClose" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="formEdit" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditLabel">Edit Data Issue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="artikel_id">Nama Artikel</label>
                        <select class="form-control nama-artikel" name="artikel_id" id="artikel_id">
                            <option selected disabled>Pilih Artikel</option>
                            @foreach ($artikel as $item)
                                <option value={{ $item->id }} data-idSepatu={{ $item->sepatu_id }}>
                                    {{ $item->nama_artikel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_sepatu">Merk Sepatu</label>
                        <input type="text" class="form-control" name="nama_sepatu" id="nama_sepatu" readonly>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <div class="mb-3">
                            <img src="https://via.placeholder.com/150" class="img-thumbnail gambar-issue" width="150"
                                height="150" alt="">
                        </div>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>

                    <div class="form-group">
                        <label for="gambar">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="50"></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger tombolClose" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary updateData">Update Data</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const success = $('.action-session').data('session');

            // alert(success);
            if (success) {
                Swal.fire({

                    icon: 'success',
                    title: 'Success',
                    text: "Data Berhasil di Tambahkan",
                    timer: 1500
                })
            }


            $('.d_gambar').on('click', function() {
                $('.gambar-preview').fadeIn();
                const gambar = $(this).attr('src');

                $('.gambar-preview .d_gambar_priview').attr('src', gambar);

                $('.close-button').on('click', function() {
                    $('.gambar-preview').fadeOut();
                })

            })

            // modalDetail
            $(document).on('click', '.detailTombol', function() {
                $('.modal-backdrop').hide();

                const id = $(this).data('id')

                console.log(id)

                $.ajax({
                    type: "get",
                    url: "{{ url('issue') }}/" + id,
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response)
                        const status = $('.d_status')

                        if (response.data.status == 'Proses') {
                            status.addClass('badge-warning')
                        } else if (response.data.status == 'Selesai') {
                            status.addClass('badge-success')
                        } else {
                            status.addClass('badge-danger')
                        }

                        $('.d_nama_artikel').text(response.artikel.nama_artikel)
                        $('.d_deskripsi').text(response.data.deskripsi)
                        $('.d_tgl_issue').text(response.data.tgl_issue)
                        $('.d_status').text(response.data.status)
                        $('.d_gambar').attr('src', "{{ url('storage') }}" + '/' +
                            response.data
                            .gambar)
                        // $('#formEdit').modal('show')
                    }
                })

            })

            // modalEdit
            $(document).on('click', '.editData', function() {
                $('.modal-backdrop').hide();

                const nama_artikel = $('.nama-artikel');
                const nama_sepatu = $('#nama_sepatu');

                nama_artikel.on('change', function(e) {
                    const selectedOption = $(this).find('option:selected');
                    const id_sepatu = selectedOption.data('idsepatu');
                    // console.log(id_sepatu)
                    $.ajax({
                        type: "GET",
                        url: `{{ url('sepatu') }}/${id_sepatu}`,
                        success: function(response) {
                            // console.log(response)
                            nama_sepatu.val(response.data.nama_merk)
                        }
                    })

                })

                const id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ url('issue') }}/" + id,
                    success: function(response) {
                        // console.log(response);
                        $('#artikel_id').val(response.data.artikel_id);
                        $('.gambar-issue').attr('src', "{{ url('storage') }}" +
                            '/' + response
                            .data.gambar);
                        $('#nama_sepatu').val(response.sepatu.nama_merk);
                        $('#deskripsi').val(response.data.deskripsi);

                        // Menghapus event handler sebelumnya agar tidak menambahkan banyak event handler setiap kali modal dibuka
                        $('.updateData').off('click').on('click', function() {
                            let formData = new FormData();
                            formData.append('artikel_id', $('#artikel_id')
                                .val());
                            formData.append('deskripsi', $('#deskripsi')
                                .val());

                            if ($('#gambar')[0].files.length > 0) {
                                formData.append('gambar', $('#gambar')[0]
                                    .files[0]);
                            }

                            formData.append('_method',
                                'PUT'); // Metode spoofing untuk Laravel
                            formData.append('id', id);

                            $.ajax({
                                type: "POST", // Metode POST dengan spoofing _method
                                url: "{{ url('issue') }}/" + id,
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    $('#formEdit').modal(
                                        'hide');

                                    Swal.fire({
                                        title: "Updated!",
                                        text: response
                                            .success,
                                        icon: "success"
                                    });
                                    $('#myTable').DataTable()
                                        .ajax.reload();

                                },
                                error: function(response) {
                                    console.error(response);
                                    alert(
                                        'Terjadi kesalahan. Silakan coba lagi.'
                                    );
                                }
                            });
                        });
                    },
                    error: function(response) {
                        console.error(response);
                        alert('Terjadi kesalahan. Data tidak dapat diambil.');
                    }
                });
            });

            //delete data
            $(document).on('click', '.hapusData', function() {

                const id = $(this).data('id')
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
                            url: `{{ url('issue') }}/${id}`,
                            data: {
                                'id': id
                            },
                            success: function(response) {

                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.success,
                                    icon: "success"
                                });

                                $('#myTable').DataTable().ajax.reload();




                            }
                        })
                    }
                });
            })


            // Data Table
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: "{{ url('ajaxIssue') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tgl_issue',
                        name: 'Tanggal'
                    },
                    {
                        data: 'gambar',
                        name: 'Gambar'
                    },
                    {
                        data: 'deskripsi',
                        name: 'Deskripsi'
                    },
                    {
                        data: 'status',
                        name: 'Status'
                    }, {
                        data: 'action',
                        name: "Action"
                    }

                ],

            });

        });
    </script>
@endpush
