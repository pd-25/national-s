@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
        <h1>Add Events</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Manage Events</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="card border-0">
            <div class="card-body pt-4">
                <div class="text-end mb-4">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Create Events
                    </button>
                </div>
                <table class="small w-100 table table-striped" id="DataTables">
                    <thead>
                        <tr>
                            <th>
                                <b>SL NO.</b>
                            </th>
                            <th>Images</th>
                            <th>
                                <b>Events Title</b>
                            </th>
                            <th>
                                <b>Events Description</b>
                            </th>
                            <th>Events Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        @include('admin.websiteSettings.events.add')
        <script>
            var table = $('#DataTables').DataTable({
                "ajax": {
                    "url": "{{ route('events.show') }}",
                    "type": "GET",
                    "datatype": "data.json",
                    "data": function(d) {}
                },
                "columns": [{
                        "data": "id",
                        "name": "id",
                        "autowidth": true,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "event_image",
                        "name": "event_image",
                        "autowidth": true,
                        render: function(data, type, row, meta) {
                            return '<img src="' + data + '" style="height:80px" />';
                        }
                    },
                    {
                        "data": "event_name",
                        "name": "event_name",
                        "autowidth": true
                    },
                    {
                        "data": "event_desc",
                        "name": "event_desc",
                        "autowidth": true,
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        "data": "event_date",
                        "name": "event_date",
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
                            var rowData = JSON.stringify(row);
                            return '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteEvents(' +
                                '`' + data + '`' + ')"><i class="bi bi-trash"></i></a>';
                        }
                        // <a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="viewNews(' + '`' + encodeURIComponent(rowData) + '`' + ')"><i class="bi bi-pencil-square"></i> </a>
                    }
                ],
                'columnDefs': [{
                        "targets": 2,
                        "width": 10
                    },
                    {
                        "targets": 2,
                        "className": "text-center"
                    },
                    {
                        "targets": 3,
                        "className": "text-center"
                    },
                ],
                "order": [
                    [0, "desc"]
                ]
            });


            function deleteEvents(data) {
                Notiflix.Confirm.show(
                    "Delete Confirmation",
                    "Do you want to delete?",
                    "Delete",
                    "Cancel",
                    function() {
                        $.ajax({
                            url: "{{ route('events.destroy') }}",
                            method: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": data
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.warning) {
                                    Notiflix.Notify.warning(response.warning);
                                    table.ajax.reload(null, false);
                                }
                            },
                            error: function(xhr, status, error) {
                                table.ajax.reload(null, false);
                                Notiflix.Notify.failure(response.error);
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
