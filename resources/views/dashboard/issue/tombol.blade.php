<div>
    <Button type="button" class="btn btn-warning btn-sm detailTombol" data-id="{{ $data->id }}" data-toggle="modal"
        data-target="#formDetail">
        <i class="fas fa-eye"></i> </Button>
    @if ($data->status == 'Issue')
        <Button type="button" data-toggle="modal" data-target="#formEdit" class="btn btn-primary btn-sm editData"
            data-id="{{ $data->id }}"> <i class="fas fa-edit"></i>
        </Button>
        <Button type="button" class="btn btn-danger btn-sm hapusData" data-id="{{ $data->id }}">
            <i class="fas fa-trash"></i> </Button>
    @endif
</div>
