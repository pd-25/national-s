@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>All Student In Class</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Student In Class</li>
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
            <h4 class="mb-4 d-flex justify-content-between"> <div class="fw-bold">Students in </div><select style="width: 250px" name="" id="" onchange="studentInClass(this)" class="form-select">@if (!@empty($teacher_details->teacherclassmapping))
                @foreach ($teacher_details->teacherclassmapping as $item)
                    <option value="{{$item->class_id}}" data-section="{{$item->section_id}}">{{@$item->teacherClass->class_name}} ( {{@$item->teacherSection->section_name}} )</option>
                @endforeach
            @endif</select></h4>
            {{-- {{@$teacher_class_assigned}} - {{@$teacher_section_assigned}} --}}
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th>SL NO</th>
                            <th>Image</th>
                            <th>Admission Number</th>
                            <th>Student Name</th>
                            <th>Date of Birth</th>
                            <th>Session</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Mobile</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    var table;
    $(document).ready(function() {
        table = $('#DataTables').DataTable({
            bLengthChange: true,
            "lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
            "iDisplayLength": 50,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false
        });
        studentInClass();
    });
    // student.studentsInClass
    function studentInClass(selectElement){
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
                table.clear();
                $.each(response.data, function(index, student) {
                    table.row.add([
                        index + 1,
                        "<img src="+student.student_details.image+" class='img_fluid' style='height:80px;' />",
                        student.student_details.admission_number,
                        student.student_details.student_name,
                        new Date(student.student_details.date_of_birth).toLocaleDateString('en-UK', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }),
                        student.student_session.sessions_name,
                        student.student_class.class_name,
                        student.student_section.section_name,
                        student.student_details.gender,
                        student.student_details.email,
                        student.student_details.mobile_no
                    ])
                });
    
                table.draw();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#results').append('<p>An error occurred while searching for students.</p>');
            }
        });
    }
</script>
@endsection