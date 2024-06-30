@extends('layouts.index')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Daftar Hotel</h4>
                            </div>
                            <div class="header-action">
                                <button class="btn btn-sm btn-primary" onclick="showCreateForm()">Add Hotel</button>
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
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Hotel Tipe</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hotel-table">
                                        @foreach ($hotel as $item)
                                            <tr id="hotel-{{ $item->id }}">
                                                {{-- <td>{{ $item->id }}</td> --}}
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->hotel_type->name }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="editHotel({{ $item->id }})">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deleteHotel({{ $item->id }})">
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
        <div class="modal fade" id="hotelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add Hotel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="hotelForm">
                        <div class="modal-body">
                            <input type="hidden" id="hotel_id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" id="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Hotel Type</label>
                                <select class="form-control" name="hotels_type" id="hotels_type" required>
                                    <option value="">-- Pilih Hotel Type --</option>
                                    @foreach ($hotelType as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
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
            $('#hotel_id').val('');
            $('#modalTitle').text('Add Hotel');
            $('#hotelModal').modal('show');
        }

        $('#hotelForm').submit(function(e) {
            e.preventDefault();
            var id = $('#hotel_id').val();
            var url = id ? '/hotels/' + id : '/hotels'; // if edit, will using id
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
                            address: $('#address').val(),
                            phone: $('#phone').val(),
                            email: $('#email').val(),
                            hotels_type: $('#hotels_type').val()
                        },
                        success: function(response) {
                            $('#hotelModal').modal('hide');
                            location.reload();
                        }
                    });
                }
            })

        });

        function editHotel(id) {
            $.get('/hotels/' + id, function(hotel) {
                $('#hotel_id').val(hotel.id);
                $('#name').val(hotel.name);
                $('#address').val(hotel.address);
                $('#phone').val(hotel.phone);
                $('#email').val(hotel.email);
                $('#hotels_type').val(hotel.hotels_type_id);
                $('#modalTitle').text('Edit Hotel');
                $('#hotelModal').modal('show');
            });
        }

        function deleteHotel(id) {
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
                        url: '/hotels/' + id,
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
