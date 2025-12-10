@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
        <h1>Add News</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Manage News</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="card border-0">
            <div class="card-body pt-4">
                <div class="text-end mb-4">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Create News
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
                                <b>News Title</b>
                            </th>
                            <th>
                                <b>News Description</b>
                            </th>
                            <th>News Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        @include('admin.websiteSettings.news.add')
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script>
            var table = $('#DataTables').DataTable({
                "ajax": {
                    "url": "{{ route('news.show') }}",
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
                        "data": "news_image",
                        "name": "news_image",
                        "autowidth": true,
                        render: function(data, type, row, meta) {
                            return '<img src="/storage/news_images/' + data + '" style="height:80px" />';
                        }
                    },
                    {
                        "data": "news_title",
                        "name": "news_title",
                        "autowidth": true
                    },
                    {
                        "data": "news_desc",
                        "name": "news_desc",
                        "autowidth": true,
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        "data": "news_date",
                        "name": "news_date",
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
                            return '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteNews(' +
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

            function viewNews(data) {
                var news = JSON.parse(decodeURIComponent(data));
                var formattedDate = formatDate(news.news_date);
                $('#news_date').val(formattedDate);
                $('#title').val(news.news_title);
                $('#slug').val(news.news_slug);

                console.log(JSON.stringify(news.news_desc))
                CKEDITOR.replace('editor');
                // CKEDITOR.instances['editor'].setData(news.news_desc);
                CKEDITOR.on('instanceReady', function(event) {
                    event.editor.setData(JSON.stringify(news.news_desc));
                });

                $('#staticBackdrop').modal('show');
            }

            function deleteNews(data) {
                Notiflix.Confirm.show(
                    "Delete Confirmation",
                    "Do you want to delete?",
                    "Delete",
                    "Cancel",
                    function() {
                        $.ajax({
                            url: "{{ route('news.destroy') }}",
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
