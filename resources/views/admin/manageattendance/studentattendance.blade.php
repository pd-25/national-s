@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Class Attendance</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Class Attendance</li>
        </ol>
    </nav>
</div>
<section>
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="row my-3">
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                    <select name="session_id" id="session_id" class="form-select">
                        @if (!@empty(GetSession('all_session')))
                            @foreach (GetSession('all_session') as $index=>$item)
                                <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select class<span class="text-danger">*</span></label>
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
                    <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-select" onchange="getStudent()">
                        <option value="">--Select Section--</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="" class="form-label">Select Student<span class="text-danger">*</span></label>
                    <select name="student_id" id="student_id_bind" class="form-select">
                        <option value="">--Select Student--</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="" class="form-label">Type<span class="text-danger">*</span></label>
                    <select name="type" id="type" onchange="getType()" class="form-select">
                        <option value="">--Select--</option>
                        <option value="1">All</option>
                        <option value="2">By Single Date</option>
                        <option value="3">By Date Range</option>
                    </select>
                </div>
                <div class="col-6 mb-2" id="showSelectDate">
                    <label for="" class="form-label">Select Date</label>
                    <input class="form-control" type="date" id="select_date" name="select_date">
                </div>
                <div class="col-6 mb-2 showFromToDate">
                    <label for="" class="form-label">from Date</label>
                    <input class="form-control" type="date" id="from_date" name="from_date">
                </div>
                <div class="col-6 mb-2 showFromToDate">
                    <label for="" class="form-label">To Date</label>
                    <input class="form-control" type="date" id="to_date" name="to_date">
                </div>
                <div class="col-12 text-end">
                    <button onclick="viewStudentAttendance()" type="submit" class="btn btn-primary me-2">View Attendance</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-2">
            <div class="table-responsive">
                <table class="w-100 table  table-striped overflow-sc" id="DataTables">
                    <thead>
                        <tr>
                            <th>SL NO </th>
                            <th>Student Name</th>
                            <th>Admission Number</th>
                            <th>Attenadnce Date</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">Check</th>
                            <th class="text-center">Late</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $("#showSelectDate").hide();
        $(".showFromToDate").hide();
        $('#DataTables').DataTable();
    });

    function getType(){
       var typeData =  $("#type").val();
       if(typeData==2){
           $("#showSelectDate").show();
           $(".showFromToDate").hide();
        }else if(typeData==3){
            $("#showSelectDate").hide();
            $(".showFromToDate").show();
        }else{
            $("#showSelectDate").hide();
            $(".showFromToDate").hide();
        }
    }

    function viewStudentAttendance(){
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var student_id = $("#student_id_bind").val();
        var typeData =  $("#type").val();
        var single_date =  $("#select_date").val();
        var from_date =  $("#from_date").val();
        var to_date =  $("#to_date").val();
        if(typeData == 1){
            single_date = null;
            from_date= null;
            to_date= null;
        }else if(typeData == 2){
            from_date= null;
            to_date= null;
        }else{
            single_date = null;
        }
        if(session_id && class_id && section_id && student_id && typeData){
            $.ajax({
            url: "{{ route('attendance.viewStudentList') }}",
            type: "POST",
            dataType: "json",
            data: {
                session_id:session_id,
                student_id:student_id,
                class_id:class_id,
                section_id:section_id,
                typeData:typeData,
                single_date:single_date,
                from_date:from_date,
                to_date:to_date,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                var table = $('#DataTables').DataTable({
                    destroy: true,
                    data: response || [], 
                    columns: [
                        { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
                        { data: 'student_details.student_name' },
                        { data: 'student_details.admission_number' },
                        {
                            data: null,
                            render: function(data, type, row) {
                                const date = new Date(data.date_taken);
                                const options = {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                };
                                return date.toLocaleDateString('en-Uk', options);
                            }
                        },
                        { data: 'time_taken', className: 'text-center' },
                        { 
                            data: null,
                            render: function(data) {
                                if (data.status == 1 && data.late == 0) {
                                    return '<i class="bi bi-check-lg text-success fs-5"></i>';
                                } else if (data.status == 0 && data.late == 0) {
                                    return '<i class="bi bi-x text-danger fs-4"></i>';
                                } else {
                                    return '<i class="bi bi-reception-0 text-secondary fs-5"></i>';
                                }
                            },
                            className: 'text-center'
                        },
                        { 
                            data: null,
                            render: function(data) {
                                if (data.status == 1 && data.late == 1) {
                                    return '<i class="bi bi-exclamation-diamond text-warning fs-5"></i>';
                                } else {
                                    return '<i class="bi bi-reception-0 text-secondary fs-5"></i>';
                                }
                            },
                            className: 'text-center'
                        }
                    ]
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#results').append('<p>An error occurred while searching for students.</p>');
            }
        });
        }
    }
</script>
@endsection