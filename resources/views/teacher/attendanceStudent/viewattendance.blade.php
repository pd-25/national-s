@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    @php
        $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
        // $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->teacherClass->class_name;
        // $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->teacherSection->section_name;
    @endphp
    <h1>View Class Attendance </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">View Class Attendance</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <h4 class="mb-4 d-flex justify-content-between"> <div class="fw-bold">Select Class and Section </div><select style="width: 250px" name="" id="getClassAndSectionId" class="form-select">@if (!@empty($teacher_details->teacherclassmapping))
                @foreach ($teacher_details->teacherclassmapping as $item)
                    <option value="{{$item->class_id}}" data-section="{{$item->section_id}}">{{@$item->teacherClass->class_name}} ( {{@$item->teacherSection->section_name}} )</option>
                @endforeach
            @endif</select></h4>
            <div class="row my-3">
                <div class="col-md-4 col-sm-12 mb-2">
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
                    <label for="" class="form-label">Type<span class="text-danger">*</span></label>
                    <select name="type" id="type" onchange="getType()" class="form-select">
                        <option value="">--Select--</option>
                        <option value="1">By Single Date</option>
                        <option value="2">By Date Range</option>
                    </select>
                </div>
                <div class="col-4 mb-2" id="showSelectDate">
                    <label for="" class="form-label">Select Date <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="dateAttendance" value="{{date('Y-m-d')}}" name="dateAttendance">
                </div>
                <div class="col-4 mb-2 showFromToDate">
                    <label for="" class="form-label">from Date</label>
                    <input class="form-control" type="date" id="from_date" name="from_date">
                </div>
                <div class="col-4 mb-2 showFromToDate">
                    <label for="" class="form-label">To Date</label>
                    <input class="form-control" type="date" id="to_date" name="to_date">
                </div>
                <div class="col-md-12 col-sm-12 text-end mt-2">
                    <button onclick="viewAttendance()" type="submit" class="btn btn-primary me-2">View Attendance</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="mb-0 fw-bold text-uppercase">Class Attendance</h5>
                <button id="exportExcel" class="btn btn-secondary btn-sm"><i class="bi bi-file-excel"></i> Export to Excel</button>
            </div>
            <div class="table-responsive">
                <table class="w-100 table table-bordered table-striped overflow-sc" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th>No.</th>
                            <th>Teacher</th>
                            <th>Student</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">P/A/L</th>
                            <th class="text-center">Action</th>
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
       if(typeData==1){
           $("#showSelectDate").show();
           $(".showFromToDate").hide();
           $('#from_date').val(null);
           $('#to_date').val(null);
        }else if(typeData==2){
            $("#showSelectDate").hide();
            $(".showFromToDate").show();
            $('#dateAttendance').val(null);
        }else{
            $("#showSelectDate").hide();
            $(".showFromToDate").hide();
        }
    }
    function viewAttendance(){
        var dateAttendance = $('#dateAttendance').val();
        var session_id = $('#session_id').val();

        // var classDetails = {!! json_encode($teacher_details->teacherclassmapping[0]) !!};
        // class_id = classDetails.class_id;
        // section_id = classDetails.section_id;

        let class_id;
        let section_id;
        class_id = $("#getClassAndSectionId").val();
        var element = $("#getClassAndSectionId").find('option:selected'); 
        section_id =  element.attr('data-section');
        // console.log(class_id)
        // console.log(section_id)
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        $.ajax({
            url: "{{ route('attendance.getTodayAttendanceData') }}",
            type: "POST",
            dataType: "json",
            data: {
                session_id: session_id,
                class_id:class_id,
                section_id:section_id,
                dateAttendance:dateAttendance,
                from_date : from_date,
                to_date : to_date,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                table = $('#DataTables').DataTable({
                    destroy: true,
                    data: response.today || [], 
                    iDisplayLength: 50,
                    columns: [
                        { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
                        { data: 'teacher_details.name' },
                        { data: 'student_details.student_name' },
                        { data: 'date_taken', className: 'text-center' },
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
                        { 
                            data: null,
                            render: function(data) {
                                if (data.date_taken == "{{ date('Y-m-d') }}") {
                                    return '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteStudentAttendance(' + data.id + ')"><i class="bi bi-trash"></i></a>';
                                }
                                return '';
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
        XLSX.writeFile(wb, 'Attendance_Data.xlsx');
    });

    function deleteStudentAttendance(attendanceId){
        Notiflix.Confirm.Show(
                "Delete Confirmation",
                "Do you want to delete?",
                "Delete",
                "Cancel",
                function() {
                    $.ajax({
                    url: "{{ route('attendance.destroy')}}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": attendanceId
                    },
                    dataType: 'JSON',
                    success:function(response)
                    {
                        if(response.warning){
                            Notiflix.Notify.Warning(response.warning);
                        }
                        viewAttendance()
                    },
                    error: function(xhr, status, error) {
                        Notiflix.Notify.Failure(response.error);
                    }
                });
            });
    }
</script>
@endsection