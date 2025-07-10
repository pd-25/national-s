@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    @php
        $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
        $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->teacherClass->class_name;
        $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->teacherSection->section_name;
    @endphp
    <h1>View Student Attendance </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">View ({{@$teacher_class_assigned}} - {{@$teacher_section_assigned}}) Student Attendance</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            
            <div class="row mb-4">
                <div class="col-6 mb-3">
                    <label for="" class="form-label">Select Student<span class="text-danger">*</span></label>
                    <select name="student_id" id="student_id" class="form-select">
                        <option value="">--Select Student--</option>
                        @if (!@empty($studentList))
                            @foreach ($studentList as $index=>$item)
                                <option value="{{@$item->studentDetails->id}}">{{@$item->studentDetails->student_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="" class="form-label">Type<span class="text-danger">*</span></label>
                    <select name="type" id="type" onchange="getType()" class="form-select">
                        <option value="">--Select--</option>
                        <option value="1">All</option>
                        <option value="2">By Single Date</option>
                        <option value="3">By Date Range</option>
                    </select>
                </div>
                <div class="col-6 mb-3" id="showSelectDate">
                    <label for="">Select Date</label>
                    <input class="form-control" type="date" id="select_date" name="select_date">
                </div>
                <div class="col-6 mb-3 showFromToDate">
                    <label for="">from Date</label>
                    <input class="form-control" type="date" id="from_date" name="from_date">
                </div>
                <div class="col-6 mb-3 showFromToDate">
                    <label for="">To Date</label>
                    <input class="form-control" type="date" id="to_date" name="to_date">
                </div>
                <div class="col-12 text-end mt-3">
                    <button onclick="viewStudentAttendance()" type="submit" class="btn btn-primary me-2">View Attendance</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="mb-0 fw-bold text-uppercase">Student Attendance</h5>
                <button id="exportExcel" class="btn btn-secondary btn-sm"><i class="bi bi-file-excel"></i> Export to Excel</button>
            </div>
            <div class="table-responsive">
                <table class="w-100 table table-bordered table-striped overflow-sc" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th>No. </th>
                            <th>Teacher</th>
                            <th>Student Name</th>
                            <th>Attenadnce Date</th>
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
        var student_id = $("#student_id").val();
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

        var classDetails = {!! json_encode($teacher_details->teacherclassmapping[0]) !!};
        class_id = classDetails.class_id
        section_id = classDetails.section_id
        if(student_id && typeData){
            $.ajax({
            url: "{{ route('attendance.viewStudentList') }}",
            type: "POST",
            dataType: "json",
            data: {
                session_id:0,
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