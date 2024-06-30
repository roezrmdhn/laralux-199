@extends('layouts.index')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Daftar Membership</h4>
                            </div>
                            <div class="header-action">
                                <button class="btn btn-sm btn-primary" onclick="showCreateForm()">Add Membership</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-1" class="table data-table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="membership-table">
                                        @foreach ($membership as $item)
                                            <tr id="membership-{{ $item->id }}">
                                                <td>{{ $item->users->name }}</td>
                                                {{-- <td>{{ $item->users_id }}</td> --}}
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="editMembership({{ $item->id }})">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deleteMembership({{ $item->id }})">
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
        <div class="modal fade" id="membershipModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add Membership</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="membershipForm">
                        <div class="modal-body">
                            <input type="hidden" id="membership_id">
                            <div class="form-group">
                                <label for="users_id">User </label>
                                <select class="form-control" id="users_id" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status </label>
                                <select class="form-control" id="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Active">Active</option>
                                    <option value="Non Active">Non Active</option>
                                </select>
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
            $('#membershipForm')[0].reset();
            $('#membership_id').val('');
            $('#modalTitle').text('Add Membership');
            $('#membershipModal').modal('show');
        }

        $('#membershipForm').submit(function(e) {
            e.preventDefault();
            var id = $('#membership_id').val();
            var url = id ? '/membership/' + id : '/membership'; // if edit, will using id
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
                            status: $('#status').val(),
                            users_id: $('#users_id').val(),
                            // transaction_id: $('#transaction_id').val(),
                        },
                        success: function(response) {
                            $('#membershipModal').modal('hide');
                            location.reload();
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                // Handle validation errors
                                Swal.fire({
                                    title: 'Gagal menyimpan data',
                                    text: 'User ini telah terdaftar sebagai member',
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                })
                            } else {
                                // Handle other errors
                                alert('An error occurred.');
                            }
                        }
                    });
                }
            })
        });

        function editMembership(id) {
            $.get('/membership/' + id, function(membership) {
                $('#membership_id').val(membership.id);
                $('#status').val(membership.status);
                $('#users_id').val(membership.users_id);
                // $('#transaction_id').val(membership.transaction_id);
                $('#modalTitle').text('Edit Membership');
                $('#membershipModal').modal('show');
            });
        }

        function deleteMembership(id) {
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
                        url: '/membership/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            $('#membership-' + id).remove();
                        }
                    });
                }
            })
        }
    </script>
@endsection
