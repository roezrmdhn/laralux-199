@extends('layouts.index')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Daftar Room</h4>
                            </div>
                            <div class="header-action">
                                <button class="btn btn-sm btn-primary" onclick="showCreateForm()">Add Room</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-1" class="table data-table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No Reff</th>
                                            <th>Nama Akun</th>
                                            <th>Nama Akun</th>
                                            <th>Tipe Room</th>
                                            <th class="text-right">Saldo</th>
                                            <th>Saldo Normal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="room-table">
                                        @foreach ($room as $item)
                                            <tr id="room-{{ $item->id }}">
                                                <th>
                                                    <img src="{{ asset('img/' . $item->image) }}" width="50px"
                                                        alt="">
                                                </th>
                                                <td> {{ $item->name }} </td>
                                                <td> {{ $item->facilities->name }} </td>
                                                <td> {{ $item->room_type->name }} </td>
                                                <td> {{ $item->hotels->name }} </td>
                                                <td> @currency($item->price) </td>
                                                <td> {{ $item->status }} </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="editRoom({{ $item->id }})">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deleteRoom({{ $item->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    @if ($item->status == 'Booked')
                                                        <button class="btn btn-sm btn-success"
                                                            onclick="updateStatusRoom({{ $item->id }})">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    @endif
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
        <div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="roomForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="room_id">
                            <div class="form-group">
                                <label>Nama Kamar</label>
                                <input class="form-control" id="name" name="name" type="text" required
                                    placeholder="Nama Kamar" aria-label="Name">
                            </div>
                            <div class="form-group">
                                <label>Fasilitas</label>
                                <select class="form-control" name="facilities" id="facilities_id">
                                    <option value="">-- Pilih Fasilitas --</option>
                                    @foreach ($facilities as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tipe Room</label>
                                <select class="form-control" name="room_type" id="room_type_id">
                                    <option value="">-- Pilih Tipe Room --</option>
                                    @foreach ($room_type as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hotel</label>
                                <select class="form-control" name="hotels" id="hotels_id">
                                    <option value="">-- Pilih Hotel --</option>
                                    @foreach ($hotel as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input class="form-control" id="price" name="price" required type="number"
                                    placeholder="Harga Kamar" aria-label="price">
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('img/no-profile.png') }}" id="setImages" width="150px" height="150px">
                                <input class="form-control" accept="image/*" id="image" type="file" name="image"
                                    >
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
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                setImages.src = URL.createObjectURL(file)
                console.log(setImages.src);
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showCreateForm() {
            $('#roomForm')[0].reset();
            $('#room_id').val('');
            $('#modalTitle').text('Add room');
            $('#roomModal').modal('show');
        }

        $('#roomForm').submit(function(e) {
            e.preventDefault();
            var id = $('#room_id').val();
            var url = id ? '/room/' + id : '/room'; // if edit, will using id
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
                            status: $('#status').val(),
                            facilities: $('#facilities_id').val(),
                            hotels: $('#hotels_id').val(),
                            room_type: $('#room_type_id').val(),
                            price: $('#price').val(),
                            image: $('#image').val()
                        },
                        success: function(response) {
                            $('#roomModal').modal('hide');
                            location.reload();
                        }
                    });
                }
            })
        });

        function editRoom(id) {
            $.get('/room/' + id, function(room) {
                // rom.[coloumn name by using findorfail in show function method]
                $('#room_id').val(room.id);
                $('#name').val(room.name);
                $('#facilities_id').val(room.facilities_id);
                $('#hotels_id').val(room.hotels_id);
                $('#room_type_id').val(room.room_type_id);
                $('#status').val(room.status);
                $('#price').val(room.price);
                // $('#image').val(room.image);
                $('#setImages').attr('src', room.image ? '/img/' + room.image :
                    '{{ asset('img/no-profile.png') }}');
                // End of the Selection
                $('#modalTitle').text('Edit Room');
                $('#roomModal').modal('show');
            });
        }


        function deleteRoom(id) {
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
                        url: '/room/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            $('#room-' + id).remove();
                        }
                    });
                }
            })
        }
        function updateStatusRoom(id) {
            Swal.fire({
                title: 'Confirm Room?',
                text: 'This room status will change to available',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/update-room/' + id,
                        method: 'POST',
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            })
        }
    </script>
@endsection
