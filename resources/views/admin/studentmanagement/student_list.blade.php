@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>All Student</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.StudentRegister') }}">Student Register</a></li>
            <li class="breadcrumb-item active">All Student</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label for="" class="form-label">Select Session </label>
                        <select name="session_id" id="session_id" class="form-select">
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label">Select Class </label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">Select Class</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Select Section </label>
                        <select name="section_id" id="section_id" class="form-select">
                            <option value="">Select Section</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="admission_number" class="form-label">Admission Number</label>
                        <input type="text" id="admission_number" class="form-control" name="admission_number">
                    </div>
                    <div class="col-4">
                        <label for="student_name" class="form-label">Student Name</label>
                        <input type="text" id="student_name" class="form-control" name="student_name">
                    </div>
                    <div class="col-4">
                        <label for="mobile_no" class="form-label">Mobile No</label>
                        <input type="text" id="mobile_no" maxlength="10" class="form-control" name="mobile_no">
                    </div>
                    <div class="col-4 mb-4">
                        <label for="email_address" class="form-label">Student E-Mail</label>
                        <input type="text" id="email_address" class="form-control" name="email">
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <a onclick="filterStudentDetails()" class="btn btn-primary btn-sm" style="margin-right: 10px;" ><i class="bi bi-filter-left"></i> Filter</a>
                        <a href="javascript:void(0)" onclick="reload()" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-repeat"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="table-responsive">
                <table class="table table-striped" id="DataTables">
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
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    var table;
    function filterStudentDetails(){
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var admission_number = $('#admission_number').val();
        var student_name = $('#student_name').val();
        var mobile_no = $('#mobile_no').val();
        var email_address = $('#email_address').val();

        $.ajax({
            url: "{{ route('student.getStudentData') }}",
            type: "POST",
            dataType: "json",
            data: {
                session_id: session_id,
                class_id: class_id,
                section_id: section_id,
                admission_number: admission_number,
                student_name: student_name,
                mobile_no: mobile_no,
                email_address: email_address,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                table = $('#DataTables').DataTable();
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
                        student.student_details.mobile_no,
                        new Date(student.created_at).toLocaleDateString('en-UK', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }),
                        '<a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="EditStudent(\'' + student.student_details.id + '\')"><i class="bi bi-pencil-square"></i> </a><a class="btn btn-success btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="ViewStudent(\'' + student.student_details.id + '\')"><i class="bi bi-eye-fill"></i></a>' +
                        '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteStudent(\'' + student.student_details.id + '\')"><i class="bi bi-trash"></i></a>'
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

    $(document).ready(function() {
        $('#DataTables').DataTable();
    });

    function ViewStudent(id){
        window.location.href ="students-view/"+id;
    }

    function EditStudent(id) {
        window.location.href ="students-edit/"+id;
    }

    function deleteStudent(id){
        Notiflix.Confirm.Show(
            "Delete Confirmation",
            "Do you want to delete?",
            "Delete",
            "Cancel",
            function() {
                $.ajax({
                url: "{{ route('student.destroy')}}",
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