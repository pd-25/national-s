@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>All Contact</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Contact</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <table class="small w-100 table table-striped" id="DataTables">
                <thead>
                    <tr>
                        <th>
                            <b>SL.</b>
                        </th>
                        <th>
                            <b>Name</b>
                        </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        var table = $('#DataTables').DataTable({
            "ajax": {
                "url": "{{route('contact.show')}}",
                "type": "GET",
                "datatype": "data.json",
                "data": function(d) {
                }
            },
            "columns": [
                {
                    "data": "id",
                    "name": "id",
                    "autowidth": true,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.first_name + ' ' + row.last_name;
                    },
                    name: 'full_name',
                    autowidth: true
                },
                {
                    "data": "email",
                    "name": "email",
                    "autowidth": true
                },
                {
                    "data": "phone_no",
                    "name": "phone_no",
                    "autowidth": true
                },
                {
                    "data": "message",
                    "name": "message",
                    "autowidth": true
                },
                {
                    data: 'status', // Assuming 'status' is the field you want to check
                    render: function(data, type, row) {
                        let badgeHtml;

                        // Determine the badge HTML based on the status
                        if (data === 0) {
                            badgeHtml = '<span class="badge text-bg-danger p-2" onclick="ChangeStatus(' + row.id + ', ' + data + ')">Pending</span>';
                        } else if (data === 1) {
                            badgeHtml = '<span class="badge text-bg-success p-2" onclick="ChangeStatus(' + row.id + ', ' + data + ')">Completed</span>';
                        } else {
                            badgeHtml = '<span class="badge text-bg-secondary p-2">Unknown</span>'; // Optional: handle other statuses
                        }

                        return badgeHtml;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "created_at",
                    "name": "created_at",
                    "autowidth": true,
                    "render": function(data, type, row) {
                        const date = new Date(data);
                        const options = {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        };
                        return date.toLocaleDateString('en-Uk', options); // Format as MM/DD/YYYY
                    }
                },
                {
                    "data": "id",
                    "render": function(data, type, row) {
                        return '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteContact(' + '`' + data + '`' + ')"><i class="bi bi-trash"></i></a>';
                    }
                }
            ],
            'columnDefs': [
                {
                    "targets": 2,
                    "className": "text-center"
                },
                {
                    "targets": 3,
                    "className": "text-center"
                },
            ],
            "order": [[0, "desc"]]
        });

        function ChangeStatus(id, status){
            Notiflix.Confirm.Show(
                "Update Confirmation",
                "Do you want to Update?",
                "Update",
                "Cancel",
                function() {
                $.ajax({
                    url: "{{route('contact.update')}}",
                    method: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function(response) {
                        if(response.info){
                            Notiflix.Notify.Info(response.info);
                            table.ajax.reload(null, false);
                        }
                        table.ajax.reload(null, false);
                    
                    },
                    error: function(xhr) {
                        console.error("Error changing status:", xhr);
                        table.ajax.reload(null, false);
                    }
                });
            });
        }

        function deleteContact(data){
            Notiflix.Confirm.Show(
                "Delete Confirmation",
                "Do you want to delete?",
                "Delete",
                "Cancel",
                function() {
                    $.ajax({
                    url: "{{ route('contact.destroy')}}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": data
                    },
                    dataType: 'JSON',
                    success:function(response)
                    {
                        if(response.warning){
                            Notiflix.Notify.Warning(response.warning);
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr, status, error) {
                        table.ajax.reload(null, false);
                        Notiflix.Notify.Failure(response.error);
                    }
                });
            });
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const day = String(date.getDate()).padStart(2, '0');

            return `${year}-${month}-${day}`;
        }
    </script>
</section>
@endsection