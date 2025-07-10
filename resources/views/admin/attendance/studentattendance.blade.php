@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Student Attendance</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Student Attendance</li>
        </ol>
    </nav>
</div>
<section>
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="row my-3">
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                    <select name="session_id" id="session_id" class="form-select" required>
                        @if (!@empty(GetSession('all_session')))
                            @foreach (GetSession('all_session') as $index=>$item)
                                <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select class<span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-select" required>
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
                    <select name="section_id" id="section_id" class="form-select" onchange="getStudent()" required>
                        <option value="">--Select Section--</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="" class="form-label">Select Student<span class="text-danger">*</span></label>
                    <select name="student_id" id="student_id_bind" class="form-select" required>
                        <option value="">--Select Student--</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="" class="form-label">Type<span class="text-danger">*</span></label>
                    <select name="type" id="type" onchange="getType()" class="form-select" required>
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
                <div class="col-12 mt-3 text-end">
                    <button onclick="viewStudentAttendance()" type="submit" class="btn btn-primary me-2">View Attendance</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body pt-4">
            <div class="d-flex justify-content-between">
                <h5 class="mb-0 fw-bold text-uppercase">Student Attendance</h5>
                <button id="exportExcel" class="btn btn-secondary btn-sm"><i class="bi bi-file-excel"></i> Export to Excel</button>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="w-100 table  table-bordered table-striped overflow-sc" id="DataTables">
                    <thead>
                        <tr class="table-primary text-center">
                            <th>SL NO </th>
                            <th>Teacher</th>
                            <th>Student</th>
                            <th>Admission Number</th>
                            <th>Date</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">P/A/L</th>
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
    var table;
    $(document).ready(function() {
        $("#showSelectDate").hide();
        $(".showFromToDate").hide();
        $('#DataTables').DataTable({
            bLengthChange: true,
            "lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
            "iDisplayLength": 50,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false
        });
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
                table = $('#DataTables').DataTable({
                    destroy: true,
                    data: response || [],
                    iDisplayLength: 50, 
                    columns: [
                        { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
                        { data: 'teacher_details.name' },
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
                                    return '<span class="text-success">P</span>';
                                } else if (data.status == 0 && data.late == 0) {
                                    return '<span class="text-danger">A</span>';
                                } else if (data.status == 1 && data.late == 1) {
                                    return '<span class="text-warning">L</span>';
                                }
                            },
                            className: 'text-center'
                        },
                    ]
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#results').append('<p>An error occurred while searching for students.</p>');
            }
        });
        }else{
            Notiflix.Notify.Failure("Please Select Class, Section, Student and Type");
        }
    }

        // Excel export functionality
    $('#exportExcel').on('click', function() {
        var data = table.rows().data().toArray();
        var ws = XLSX.utils.json_to_sheet(data.map(row => ({
            'Teacher Name': row.teacher_details.name,
            'Admission Number': row.student_details.admission_number,
            'Student Name': row.student_details.student_name,
            'Date Taken': row.date_taken,
            'Time Taken': row.time_taken,
            'Status': row.status == 1 ? (row.late == 0 ? 'Present' : 'Late') : 'Absent'
        })));

        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Attendance Data');
        XLSX.writeFile(wb, 'Student_Attendance_Data.xlsx');
    });

</script>
@endsection