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
                        data-target="#addModal" data-id="{{ $sepatu->id }}"> <i class="fas fa-edit"></i> </Button>
                    <Button type="button" class="btn btn-danger btn-sm hapusData" data-id="{{ $sepatu->id }}">
                        <i class="fas fa-trash"></i> </Button>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
