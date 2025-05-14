@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Take Attendance (Today's Date : {{date('d-m-Y')}} )</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Take Attendance</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="row my-3">
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                    <select name="session_id" id="session_id" class="form-select" required>
                        @if (!@empty(GetSession('active_session')))
                            @foreach (GetSession('active_session') as $index=>$item)
                                <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select class<span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @if (!@empty(GetClasses()))
                            @foreach (GetClasses() as $index=>$item)
                                <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('class_id'))
                        <span class="text-danger">{{ $errors->first('class_id') }}</span>
                    @endif
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-select" required>
                        <option value="">Select Section</option>
                    </select>
                    @if ($errors->has('section_id'))
                        <span class="text-danger">{{ $errors->first('section_id') }}</span>
                    @endif
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Date <span class="text-danger">*</span></label>
                    <input class="form-control" required type="date" id="dateAttendance" value="{{date('Y-m-d')}}" name="dateAttendance">
                </div>
                <div class="col-12 text-end">
                    <button onclick="fetchStudents()" type="submit" class="btn btn-primary me-2">Take Attendance</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            {{-- @php
                $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
                $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->teacherClass->class_name;
                $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->teacherSection->section_name;
            @endphp --}}
            {{-- <h4 class="mb-4">  All Student in ({{@$teacher_class_assigned}} - {{@$teacher_section_assigned}}) Class</h4> --}}
            <hr>
            <div class="table-responsive">
                <table class="w-100 table table-bordered table-striped" id="DataTables">
                    <thead>
                        <tr class="table-primary text-center">
                            <th>SL NO</th>
                            <th>Admission Number</th>
                            <th>Session Class Section</th>
                            <th>Student</th>
                            <th class="text-center">Check</th>
                            <th class="text-center">Absent</th>
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
    });

    function fetchStudents() {
        var session_id =$("#session_id").val();
        var class_id =$("#class_id").val();
        var section_id =$("#section_id").val();
        var dateAttendance =$("#dateAttendance").val();
        if(session_id && class_id && section_id && dateAttendance){
            $.ajax({
                url: "{{ route('student.studentsInClass') }}",
                type: "POST",
                dataType: "json",
                data: {
                    session_id: session_id,
                    class_id:class_id,
                    section_id:section_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var tableBody = $('#studentTableBody');
                    tableBody.empty(); 
                    if (response.data && response.data.length > 0) {
                        $.each(response.data, function(index, item) {
                            tableBody.append(`
                               <tr class="text-center">
                                    <td>${index + 1}</td>
                                    <td>${item.student_details.admission_number}</td>
                                    <td class="text-center">${item.student_session.sessions_name} <br> ${item.student_class.class_name} <br> ${item.student_section.section_name}</td>
                                    <td>${item.student_details.student_name}</td>
                                    <td class="text-center">
                                        <input id="${item.student_details.id}_onTime" class="form-check-input larger-checkbox" 
                                            type="checkbox" 
                                            onclick='getAttendance(${JSON.stringify(item).replace(/'/g, "\\'")}, 1, 0)' 
                                            name="attendance[]" 
                                            value="${item.student_details.id}">
                                    </td>
                                    <td class="text-center">
                                        <input id="${item.student_details.id}_Absent" class="larger-checkbox danger-checkbox" 
                                            type="checkbox" 
                                            onclick='getAttendance(${JSON.stringify(item).replace(/'/g, "\\'")}, 0, 0)' 
                                            name="attendance[]" 
                                            value="${item.student_details.id}">
                                    </td>
                                    <td class="text-center">
                                        <input id="${item.student_details.id}_late" class="larger-checkbox warning-checkbox" 
                                            type="checkbox" 
                                            onclick='getAttendance(${JSON.stringify(item).replace(/'/g, "\\'")}, 1, 1)' 
                                            name="attendance[]" 
                                            value="${item.student_details.id}">
                                    </td>
                                </tr>
                            `);
                        });
                    
                        checkAttendance();
                    
                    } else {
                        tableBody.append('<tr><td colspan="7" class="text-center">No students found.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#results').append('<p>An error occurred while fetching students.</p>');
                }
            });
        }else{
            Notiflix.Notify.Failure("Please select all field");
        }
    }

    function checkAttendance() {
        var session_id =$("#session_id").val();
        var class_id =$("#class_id").val();
        var section_id =$("#section_id").val();
        var dateAttendance =$("#dateAttendance").val();
        $.ajax({
            url: "{{ route('attendance.create') }}",
            type: "GET",
            data:{
                session_id:session_id,
                class_id:class_id,
                section_id:section_id,
                dateAttendance:dateAttendance,
            },
            dataType: "json",
            success: function(response) {
                $.each(response, function(index, item) {
                    if(item.status== 1 && item.late == 0){
                        $("#"+item.user_id+'_onTime').attr("Checked", true);
                    }else if(item.status== 0 && item.late == 0){
                        $("#"+item.user_id+'_Absent').attr("Checked", true);
                    }else if(item.status== 1 && item.late == 1){
                        $("#"+item.user_id+'_late').attr("Checked", true);
                    }
                    $("#"+item.user_id+'_onTime').attr("Disabled", true);
                    $("#"+item.user_id+'_Absent').attr("Disabled", true);
                    $("#"+item.user_id+'_late').attr("Disabled", true);
                });
            }
        });

    }

    function getAttendance(student, status, late) {
        var session_id =$("#session_id").val();
        var class_id =$("#class_id").val();
        var section_id =$("#section_id").val();
        var dateAttendance =$("#dateAttendance").val();
        $.ajax({
        url: "{{ route('attendance.store') }}",
        type: "POST",
        dataType: "json",
        data: {
            user_id: student.student_details.id,
            status: status,
            late:late,
            session_id:session_id,
            class_id:class_id,
            section_id:section_id,
            dateAttendance:dateAttendance,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if(response.success){
                Notiflix.Notify.Success(response.success);
            }else if(response.error){
                Notiflix.Notify.Failure(response.error);
            }else if(response.warning){
                Notiflix.Notify.Warning(response.warning);
            }
            checkAttendance();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            $('#results').append('<p>An error occurred while searching for students.</p>');
        }
    });

    }

</script>
@endsection