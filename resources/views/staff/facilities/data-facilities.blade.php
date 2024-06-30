@extends('layouts.index')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Daftar fasilitas</h4>
                            </div>
                            <div class="header-action">
                                <button class="btn btn-sm btn-primary" onclick="showCreateForm()">Add fasilitas</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-1" class="table data-table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fasilitas-table">
                                        @foreach ($facilities as $item)
                                            <tr id="fasilitas-{{ $item->id }}">
                                                {{-- <td>{{ $item->id }}</td> --}}
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="editFasilitas({{ $item->id }})">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deleteFasilitas({{ $item->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create/Edit Modal -->
        <div class="modal fade" id="fasilitasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add fasilitas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="fasilitasForm">
                        <div class="modal-body">
                            <input type="hidden" id="fasilitas_id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" id="description" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" aria-label="Close"
                                class="btn btn-secondary btn-sm">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm ">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showCreateForm() {
            $('#fasilitasForm')[0].reset();
            $('#fasilitas_id').val('');
            $('#modalTitle').text('Add fasilitas');
            $('#fasilitasModal').modal('show');
        }

        $('#fasilitasForm').submit(function(e) {
            e.preventDefault();
            var id = $('#fasilitas_id').val();
            var url = id ? '/fasilitas/' + id : '/fasilitas'; // if edit, will using id
            var type = id ? 'PUT' : 'POST'; // if edit, use put
            Swal.fire({
                title: 'Simpan Data?',
                text: 'Pastikan data yang Anda masukkan benar',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: type,
                        data: {
                            name: $('#name').val(),
                            description: $('#description').val(),
                        },
                        success: function(response) {
                            $('#fasilitasModal').modal('hide');
                            location.reload();
                        }
                    });
                }
            })
        });

        function editFasilitas(id) {
            $.get('/fasilitas/' + id, function(fasilitas) {
                $('#fasilitas_id').val(fasilitas.id);
                $('#name').val(fasilitas.name);
                $('#description').val(fasilitas.description);
                $('#modalTitle').text('Edit Hotel');
                $('#fasilitasModal').modal('show');
            });
        }

        function deleteFasilitas(id) {
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Data yang anda pilih akan dihapus secara permanen',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/fasilitas/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            $('#fasilitas-' + id).remove();
                        }
                    });
                }
            })
        }
    </script>
@endsection
