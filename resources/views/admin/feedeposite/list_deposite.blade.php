@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>All Fee Deposite</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Fee Deposite</li>
        </ol>
    </nav>
</div>
<section>
    <div class="card border-0">
        <div class="card-body pt-4">
            <form action="" method="post">
                @csrf
                <div class="row my-3">
                    <div class="col-8 mb-2">
                        <label for="" class="form-label">Payment Number </label>
                        <input type="text" class="form-control" name="payment_number" id="payment_number" placeholder="Search by payment number">
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Session</label>
                        <select name="session_id" id="session_id" class="form-select">
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select class</label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">--Select Class--</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Section </label>
                        <select name="section_id" id="section_id" class="form-select" onchange="getStudent()">
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Student</label>
                        <select name="user_id" id="student_id_bind" class="form-select">
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Month</label>
                        <select name="month" id="month" class="form-select">
                            <option value="">--Select Month--</option>
                            @if (!@empty(GetallMonths()))
                                @foreach (GetallMonths() as $item)
                                    <option value="{{@$item}}" {{$item == date('F') ? "selected": ""}}>{{@$item}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-4">
                        <label for="" class="form-label">Select Year</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">--Select Year--</option>
                            @if (!@empty(LastFiveYear()))
                                @foreach (LastFiveYear() as $item)
                                    <option value="{{@$item}}" {{$item == date('Y') ? "selected": ""}}>{{@$item}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-end">
                        <a onclick="filterDepositeDetails()" class="btn btn-primary btn-sm" style="margin-right: 10px;" ><i class="bi bi-filter-left"></i> Filter</a>
                        <a href="javascript:void(0)" onclick="reload()" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-repeat"></i> Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <section class="section">
        <div class="card border-0">
            <div class="card-body pt-4">
                <div class="table-responsive">
                    <table class="table table-striped" id="DataTables">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Payment NO</th>
                                <th>Admission No</th>
                                <th>Name</th>
                                <th>Session</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
        
</section>
<script>
    var table;
    $(document).ready(function() {
        $('#DataTables').DataTable();
    });
    function filterDepositeDetails(){
        var payment_number = $('#payment_number').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        
        var user_id = $('#student_id_bind').val();
        var month = $('#month').val();
        var year = $('#year').val();

        $.ajax({
            url: "{{ route('deposite.show') }}",
            type: "POST",
            dataType: "json",
            data: {
                payment_number:payment_number,
                session_id: session_id,
                class_id: class_id,
                section_id: section_id,
                user_id: user_id,
                month: month,
                year: year,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                table = $('#DataTables').DataTable();
                table.clear().draw();
                $.each(response, function(index, deposite) {
                    table.row.add([
                        index + 1,
                        deposite.student_details.admission_number,
                        deposite.payment_number,
                        deposite.student_name,
                        deposite.student_session.sessions_name,
                        deposite.student_class.class_name,
                        deposite.student_section.section_name,
                        deposite.month,
                        deposite.year,
                        deposite.total,
                        new Date(deposite.created_at).toLocaleDateString('en-UK', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }),
                        '<a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="EditDeposite(\'' + deposite.payment_number + '\')"><i class="bi bi-pencil-square"></i> </a> <a class="btn btn-success btn-sm rounded-pill" href="javascript:void(0)" onclick="ViewDeposite(\'' + deposite.payment_number + '\')"><i class="bi bi-eye-fill"></i></a>' + 
                        '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteDeposite(\'' + deposite.id + '\')"><i class="bi bi-trash"></i></a>'
                    ]).draw(false);
                });

                table.destroy();
                $('#DataTables').DataTable({
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    "ordering": true,
                    "paging": true,
                    "searching": true,
                    "destroy": true
                });

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#results').append('<p>An error occurred while searching for students.</p>');
            }
        });
    }

    function ViewDeposite(deposite_payment_number)
    {
        window.location.href ="view-download-deposite/"+deposite_payment_number;
    }
    function EditDeposite(deposite_payment_number){
        window.location.href ="edit-deposite/"+deposite_payment_number;
    }

    function deleteDeposite(id){
        Notiflix.Confirm.Show(
            "Delete Confirmation",
            "Do you want to delete?",
            "Delete",
            "Cancel",
            function() {
                $.ajax({
                url: "{{ route('deposite.destroy')}}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'JSON',
                success:function(response)
                {
                    if(response.warning){
                        Notiflix.Notify.Warning(response.warning);
                        table.ajax.reload(null, false);
                        table.ajax.reload();
                    }
                },
                error: function(xhr, status, error) {
                    table.ajax.reload(null, false);
                    Notiflix.Notify.Failure(response.warning);
                }
            });
        });
    }
</script>
@endsection