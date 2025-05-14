@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Manage Student's</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.StudentRegister') }}">Admission</a></li>
            <li class="breadcrumb-item active">Manage Student's</li>
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
                                    <option value="{{@$item->id}}" {{$item->status == 1 ? 'selected': ''}}>{{@$item->sessions_name}}</option>
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
                        <input type="text" id="admission_number" placeholder="Search by admission number" class="form-control" name="admission_number">
                    </div>
                    <div class="col-4">
                        <label for="student_name" class="form-label">Student</label>
                        <input type="text" id="student_name" placeholder="Search by student name" class="form-control" name="student_name">
                    </div>
                    <div class="col-4">
                        <label for="mobile_no" class="form-label">Mobile No</label>
                        <input type="number" id="mobile_no" maxlength="10" placeholder="Search by mobile number" class="form-control" name="mobile_no">
                    </div>
                    <div class="col-4 mb-4">
                        <label for="email_address" class="form-label">Student E-Mail</label>
                        <input type="email" id="email_address" placeholder="Search by email" class="form-control" name="email">
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
                <table class="table table-bordered table-striped" id="DataTables" style="width: 100%;">
                    <thead>
                        <tr class="table-primary">
                            <th>NO.</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Image</th>
                            <th>Class Section</th>
                            <th>Admission Number</th>
                            <th>Gender</th>
                            <th>Admission Date</th>
                            <th>Guardian Email</th>
                            <th>Guardian Name</th>
                            <th>Guardian Mobile</th>
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
    $(document).ready(function() {
        table = $('#DataTables').DataTable({
            bLengthChange: true,
            "lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
            "iDisplayLength": 50,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false,
            columnDefs: [
                { width: '30px', targets: 0 },  // Index column
                { width: '150px', targets: 1 }, // Student Name
                { width: '100px', targets: 2 }, // DOB
                { width: '100px', targets: 3 }, // Image
                { width: '120px', targets: 4 }, // Class & Section
                { width: '100px', targets: 5 }, // Admission No
                { width: '80px', targets: 6 },  // Gender
                { width: '100px', targets: 7 }, // Created At
                { width: '150px', targets: 8 }, // Email
                { width: '120px', targets: 9 }, // Parent Name
                { width: '100px', targets: 10 }, // Mobile No
                { width: '250px', targets: 11 }, // Action buttons
            ],
            scrollX: true  
        });
    });

    function filterStudentDetails() {
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
                table.clear();
                $.each(response.data, function(index, student) {
                    table.row.add([
                        index + 1,
                        student.student_details.student_name,
                        new Date(student.student_details.date_of_birth).toLocaleDateString('en-UK', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }),
                        "<img src=" + student.student_details.image + " class='img_fluid' style='height:80px;' />",
                        student.student_class.class_name + '<br>' + student.student_section.section_name,
                        student.student_details.admission_number,
                        student.student_details.gender,
                        new Date(student.created_at).toLocaleDateString('en-UK', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }),
                        student.student_details.email,
                        student.student_details.parent_name,
                        student.student_details.mobile_no,
                        '<a class="btn btn-primary btn-sm rounded-pill" href="javascript:void(0)" onclick="EditStudent(\'' + student.student_details.id + '\')">Edit <i class="bi bi-pencil-square"></i> </a><a class="btn btn-success btn-sm rounded-pill" href="javascript:void(0)" onclick="ViewStudent(\'' + student.student_details.id + '\')">View <i class="bi bi-eye-fill"></i></a>' +

                        '<a class="btn btn-secondary btn-sm rounded-pill" href="javascript:void(0)" onclick="StudentPayment('+ student.student_session.id + ',' +  student.student_class.id + ',' + student.student_section.id + ',' + student.student_details.id + ')">Fees <i class="bi bi-currency-rupee"></i></a> '
                        +
                        '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteStudent(\'' + student.student_details.id + '\')">Delete <i class="bi bi-trash"></i></a>'
                    ]);
                });

                table.draw();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#results').append('<p>An error occurred while searching for students.</p>');
            }
        });
    }

    function ViewStudent(id){
        window.location.href ="students-view/"+id;
    }

    function EditStudent(id) {
        window.location.href ="students-edit/"+id;
    }

    function StudentPayment(session_id, class_id, section_id, student_id){
        window.location.href ="fees-payment?session_id="+session_id + '&class_id='+class_id+ '&section_id='+ section_id + '&student_id='+student_id;
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
                        filterStudentDetails();
                        Notiflix.Notify.Warning(response.warning);
                    }
                },
                error: function(xhr, status, error) {
                    filterStudentDetails();
                    Notiflix.Notify.Failure(response.error);
                }
            });
        });
    }
</script>
@endsection