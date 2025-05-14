@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Add Notice</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Notice</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="text-end mb-4">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Create Notice
                  </button>
            </div>
            <table class="small w-100 table table-striped" id="DataTables">
                <thead>
                    <tr>
                        <th>
                            <b>SL NO.</b>
                        </th>
                        <th>
                           Image
                        </th>
                        <th>
                            <b>Notice Name</b>
                        </th>
                        <th>Notice Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('admin.websiteSettings.notice.add')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        var table = $('#DataTables').DataTable({
            "ajax": {
                "url": "{{route('notice.show')}}",
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
                    data: 'image',
                    name: 'image',
                    autowidth: true,
                    render: function(data, type, row) {
                        if (data) {
                            return '<img src="' + data + '" alt="Image" style="width: 100px; height: auto;"/>'; 
                        } else {
                            return '<span>No Image</span>';
                        }
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "notice_name",
                    "name": "notice_name",
                    "autowidth": true
                },
                {
                    "data": "notice_date",
                    "name": "notice_date",
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
                        return '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteNews(' + '`' + data + '`' + ')"><i class="bi bi-trash"></i></a>';
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
                    "className": "text-center",
                    "width":100
                },
            ],
            "order": [[0, "desc"]]
        });

        function deleteNews(data){
            Notiflix.Confirm.Show(
                "Delete Confirmation",
                "Do you want to delete?",
                "Delete",
                "Cancel",
                function() {
                    $.ajax({
                    url: "{{ route('notice.destroy')}}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": data
                    },
                    dataType: 'JSON',
                    success:function(response)
                    {
                        console.log(response)
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