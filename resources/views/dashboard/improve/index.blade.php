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

    <h2 class="section-title">Data Improve </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Daftar Improve</h4>
                </div>
                <div class="card-body">
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
                                    <th>Nama Merk</th>
                                    <td>:</td>
                                    <td class="d_nama_merk">Adidas 123</td>
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
                                        <span class="badge badge-danger d_status"></span>
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
@endsection

@push('scripts')
    <script>
        $('.d_gambar').on('click', function() {
            $('.gambar-preview').fadeIn();
            const gambar = $(this).attr('src');

            $('.gambar-preview .d_gambar_priview').attr('src', gambar);

            $('.close-button').on('click', function() {
                $('.gambar-preview').fadeOut();
            })

        })

        // imrove action
        $(document).on('click', '.improveButton', function(e) {
            const id = e.target.dataset.id;

            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data Akan di Improve?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Imporve Data!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: `{{ url('improve') }}/${id}`,
                        data: {
                            'id': id
                        },
                        success: function(response) {
                            console.log(response);

                            Swal.fire({
                                title: "Success!",
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
        // modalDetail
        $(document).on('click', '.detailTombol', function() {
            $('.modal-backdrop').hide();

            const id = $(this).data('id')

            $.ajax({
                type: "get",
                url: "{{ url('getIssue') }}/" + id,

                success: function(response) {
                    console.log(response)


                    $('.d_nama_merk').text(response.sepatu.nama_merk)
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



        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: "{{ url('getDataImprove') }}",
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
    </script>
@endpush
