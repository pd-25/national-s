@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle" id="UserFormRegister">
        <h1>Role & Permission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Role & Permission</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="card border-0">
            <div class="card-body pt-4">
                <table class="small w-100 table table-bordered table-striped border-danger">
                    <thead>
                        <tr class="table-primary">
                            <th>NO</th>
                            <th>Name/Email <br> User-Type</th>
                            <th>Role & Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty(GetAdmins()))
                            @foreach (GetAdmins() as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        {{ $item->name }} <br>
                                        {{ $item->email }} <br>

                                        @if ($item->usertype == 1)
                                            <span class="fw-bold">ADMIN</span>
                                        @elseif ($item->usertype == 2)
                                            <span class="fw-bold">STAFF</span>
                                        @endif
                                    </td>

                                    <td>
                                        @php
                                            $permissions = is_array($item->role_permission)
                                                ? $item->role_permission
                                                : (array) json_decode($item->role_permission, true);
                                        @endphp

                                        <form action="{{ route('admin.register.post') }}" method="POST"
                                            class="autoSubmitForm">
                                            @csrf

                                            <input type="hidden" name="user_id" value="{{ $item->id }}">
                                            <input type="hidden" name="usertype" value="{{ $item->usertype }}">
                                            <input type="hidden" name="status" value="{{ $item->status }}">

                                            <div class="row">
                                                @foreach (MenuAccessList() as $key2 => $value)
                                                    <div class="col-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="role_item"
                                                                    name="role_permission[]" value="{{ $key2 }}"
                                                                    @if (in_array($key2, $permissions)) checked @endif>
                                                                {{ $value }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </form>

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

        $(document).on("change", ".role_item", function() {
            $(this).closest("form").submit();
        });
    </script>
@endsection
