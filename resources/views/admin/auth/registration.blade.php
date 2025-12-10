@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle" id="UserFormRegister">
        <h1>System User's</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Manage System User's</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="card border-0">
            <div class="card-body pt-4">
                <form id="UserForm" action="{{ route('admin.register.post') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="col-md-4 mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" id="name" required
                                autofocus>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="usertype" class="form-label">User Type</label>
                            <select name="usertype" class="form-select" id="usertype" required>
                                <option value="">--Select User Type --</option>
                                <option value="1">Admin</option>
                                <option value="2">Staff</option>
                            </select>
                            @if ($errors->has('usertype'))
                                <span class="text-danger">{{ $errors->first('usertype') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" id="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="col-12 mb-4">
                            <label for="" class="from-label fw-bold">Role & Permission
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="check_all" id="check_all"> All
                                    </label>
                                </div>
                            </label>
                            <div class="row">
                                @if (!@empty(MenuAccessList()))
                                    @foreach (MenuAccessList() as $key => $item)
                                        <div class="col-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="role_item" value="{{ $key }}"
                                                        name="role_permission[]">
                                                    {{ @$item }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="email_address" class="form-label">E-Mail
                                Address</label>
                            <input type="text" id="email_address" class="form-control" name="email" id="email"
                                required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control showPassword" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <div class="form-check">
                                <input class="form-check-input" onclick="myShowPassword()" type="checkbox" value=""
                                    id="defaultCheck1">
                                <small class="form-check-label" for="defaultCheck1">
                                    Show Password
                                </small>
                            </div>
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" id="SaveButton" class="btn btn-primary">
                                Register
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                Clear
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body pt-4">
                <table class="small w-100 table table-bordered table-striped">
                    <thead>
                        <tr class="table-primary">
                            <th>NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User-Type</th>
                            <th>Role & Permission</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $menu = MenuAccessList();
                        @endphp
                        @if (!@empty(GetAdmins()))
                            @foreach (GetAdmins() as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if (@$item->usertype == 1)
                                            <span class="fw-bold">ADMIN</span>
                                        @elseif(@$item->usertype == 2)
                                            <span class="fw-bold">STAFF</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($item->role_permission))
                                            @foreach ($item->role_permission as $key)
                                                @if (array_key_exists($key, $menu))
                                                    <span class="badge bg-primary me-1">{{ $menu[$key] }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if (@$item->status == 1)
                                            <i class="bi bi-check-lg fw-bold text-success"> Active </i>
                                        @else
                                            <i class="bi bi-x-lg fw-bold text-danger"> Deactive </i>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-primary btn-sm rounded-pill me-2" href="#UserFormRegister"
                                                onclick='edit(@json($item))'>
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            {{-- <form action="" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-pill show_confirm"><i
                                                        class="bi bi-trash"></i></button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(e) {
            $("#UpdateUser").hide();
            $("#check_all").on("change", function() {
                $(".role_item").prop("checked", $(this).prop("checked"));
            });

            $(".role_item").on("change", function() {
                if ($(".role_item:checked").length === $(".role_item").length) {
                    $("#check_all").prop("checked", true);
                } else {
                    $("#check_all").prop("checked", false);
                }

            });
        });

        function edit(item) {
            $('#password').val('');
            $("#user_id").val(item.id);
            $('#name').val(item.name);
            $('#email_address').val(item.email);
            $('#email_address').prop('disabled', true);
            $('#usertype').val(item.usertype);
            $('#status').val(item.status);
            $('.role_item').prop('checked', false);
            if (item.role_permission && item.role_permission.length > 0) {
                item.role_permission.forEach(function(role) {
                    $('input.role_item[value="' + role + '"]').prop('checked', true);
                });
            }
            if ($('.role_item:checked').length === $('.role_item').length) {
                $('#check_all').prop('checked', true);
            } else {
                $('#check_all').prop('checked', false);
            }
        }
    </script>
@endsection
