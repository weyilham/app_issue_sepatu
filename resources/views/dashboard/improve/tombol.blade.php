<div class="align-self-center">

    <Button type="button" class="btn btn-warning btn-sm detailTombol" data-id="{{ $data->id }}" data-toggle="modal"
        data-target="#formDetail"><i class="fas fa-eye"></i> </Button>

    @if ($data->status == 'Selesai')
    @else
        {{-- <Button type="button" data-toggle="modal" data-target="#formEdit" class="btn btn-success btn-sm improveButton"
            data-id="{{ $data->id }}"> Imporve
        </Button> --}}
        <div class="btn-group">
            <button type="button" class="btn btn-danger btn-sm">Status</button>
            <button type="button" class="btn btn-danger  btn-sm dropdown-toggle dropdown-toggle-split"
                data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" id="diproses" data-id="{{ $data->id }}" href="#">Diproses</a>
                <a class="dropdown-item" id="diterima" data-id="{{ $data->id }}" href="#">Diterima</a>
                <a class="dropdown-item" id="diperbaiki" data-id="{{ $data->id }}" href="#">Diperbaiki</a>
                <a class="dropdown-item" id="selesai" data-id="{{ $data->id }}" href="#">Selesai</a>
            </div>
        </div>
    @endif



</div>
