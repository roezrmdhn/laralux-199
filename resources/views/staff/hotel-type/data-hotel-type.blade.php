@extends('layouts.index')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Daftar Hotel Type</h4>
                            </div>
                            <div class="header-action">
                                <button class="btn btn-sm btn-primary" onclick="showCreateForm()">Add Hotel Type</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Images in Bootstrap are made responsive to the image so that it scales
                                with the parent element.</p>
                            <div class="table-responsive">
                                <table id="datatable-1" class="table data-table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hotel-type-table">
                                        @foreach ($hotelType as $item)
                                            <tr id="hotel-{{ $item->id }}">
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="editHotelType({{ $item->id }})">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deleteHotelType({{ $item->id }})">
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
        <div class="modal fade" id="hotelTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add Hotel Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="hotelForm">
                        <div class="modal-body">
                            <input type="hidden" id="hotel_type_id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" required>
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
            $('#hotelForm')[0].reset();
            $('#hotel_type_id').val('');
            $('#modalTitle').text('Add Hotel Type');
            $('#hotelTypeModal').modal('show');
        }

        $('#hotelForm').submit(function(e) {
            e.preventDefault();
            var id = $('#hotel_type_id').val();
            var url = id ? '/hotel-type/' + id : '/hotel-type'; // if edit, will using id
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
                        },
                        success: function(response) {
                            $('#hotelTypeModal').modal('hide');
                            location.reload();
                        }
                    });
                }
            })
        });

        function editHotelType(id) {
            $.get('/hotel-type/' + id, function(hotel) {
                $('#hotel_type_id').val(hotel.id);
                $('#name').val(hotel.name);
                $('#modalTitle').text('Edit Hotel Type');
                $('#hotelTypeModal').modal('show');
            });
        }

        function deleteHotelType(id) {
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
                        url: '/hotel-type/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            $('#hotel-' + id).remove();
                        }
                    });
                }
            })
        }
    </script>
@endsection
