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
                $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->teacherClass->class_name;
                $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->teacherSection->section_name;
            @endphp
            <h4 class="mb-4">  All Student in ({{@$teacher_class_assigned}} - {{@$teacher_section_assigned}}) Class</h4>
            <hr>
            <div class="table-responsive">
                <table class="w-100 table table-striped" id="DataTables">
                    <thead>
                        <tr>
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
    // student.studentsInClass
    $.ajax({
        url: "{{ route('student.studentsInClass') }}",
        type: "POST",
        dataType: "json",
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            var table = $('#DataTables').DataTable();
            table.clear().draw();

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

    $(document).ready(function() {
        $('#DataTables').DataTable();
    });
</script>
@endsection