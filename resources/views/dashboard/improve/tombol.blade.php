<div class="align-self-center">

    <Button type="button" class="btn btn-warning btn-sm detailTombol" data-id="{{ $data->id }}" data-toggle="modal"
        data-target="#formDetail"><i class="fas fa-eye"></i> </Button>

    @if ($data->status == 'Done')
    @else
        <Button type="button" data-toggle="modal" data-target="#formEdit" class="btn btn-success btn-sm improveButton"
            data-id="{{ $data->id }}"> Imporve
        </Button>
    @endif



</div>
