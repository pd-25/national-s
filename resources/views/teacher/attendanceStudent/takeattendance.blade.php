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
            @php
                $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
                // $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->teacherClass->class_name;
                // $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->teacherSection->section_name;
            @endphp
            <h5 class="mb-4 d-flex justify-content-between"> <div class="fw-bold">Students in </div><select style="width: 250px" name="" id="GetSelectedClass" onchange="fetchStudents(this)" class="form-select">@if (!@empty($teacher_details->teacherclassmapping))
                @foreach ($teacher_details->teacherclassmapping as $item)
                    <option value="{{$item->class_id}}" data-section="{{$item->section_id}}">{{@$item->teacherClass->class_name}} ( {{@$item->teacherSection->section_name}} )</option>
                @endforeach
            @endif</select></h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th>No.</th>
                            <th>Student</th>
                            <th class="text-center">Present</th>
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
        fetchStudents();
    });

    function fetchStudents(selectElement) {
        let class_id;
        let section_id;
        let session_id;
        if(selectElement){
            class_id = selectElement.value;
            section_id = selectElement.options[selectElement.selectedIndex].getAttribute('data-section');
            var sessionId = @json(GetSession('active_session'));
            session_id = sessionId[0].id;
        }
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
                        // <td>${item.student_details.admission_number}</td>
                        // <td>${item.student_session.sessions_name}</td>
                        //         <td>${item.student_class.class_name}</td>
                        //         <td>${item.student_section.section_name}</td>
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                
                                <td>${item.student_details.student_name} <br> <b> ${item.student_details.admission_number} </b> </td>
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
                    tableBody.append('<tr><td colspan="8" class="text-center">No students found.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#results').append('<p>An error occurred while fetching students.</p>');
            }
        });
    }

    function checkAttendance() {
        let class_id;
        let section_id;
        let session_id;
        var selectElement =  $("#GetSelectedClass option:selected");
        class_id = selectElement.val();
        section_id = selectElement.data('section');
        var sessionId = @json(GetSession('active_session'));
        session_id = sessionId[0].id;
        var today = new Date();
        var formattedDate = today.getFullYear() + '-' +
        String(today.getMonth() + 1).padStart(2, '0') + '-' +
        String(today.getDate()).padStart(2, '0');
        var dateAttendance = formattedDate;
        $.ajax({
            url: "{{ route('attendance.create') }}",
            type: "GEt",
            data: {
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
        // var classDetails = {!! json_encode($teacher_details->teacherclassmapping[0]) !!};
        // class_id = classDetails.class_id
        // section_id = classDetails.section_id
        let class_id;
        let section_id;
        let session_id;
        var selectElement =  $("#GetSelectedClass option:selected");
        class_id = selectElement.val();
        section_id = selectElement.data('section');
        var sessionId = @json(GetSession('active_session'));
        session_id = sessionId[0].id;

        $.ajax({
        url: "{{ route('attendance.store') }}",
        type: "POST",
        dataType: "json",
        data: {
            user_id: student.student_details.id,
            status: status,
            late:late,
            class_id:class_id,
            section_id:section_id,
            dateAttendance:null,
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