@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Upload Profile Image's</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.StudentRegister') }}">Admission</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentList') }}">Manage Student's</a></li>
            <li class="breadcrumb-item active">Upload Profile Image's</li>
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
                    <div class="col-8 d-flex align-items-end justify-content-end">
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
                            <th>Image</th>
                            <th>Upload</th>
                            <th>Class Section</th>
                            <th>Admission Number</th>
                            <th>Gender</th>
                            <th>Email</th>
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
            responsive: true
        });
    });

    function filterStudentDetails() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var admission_number = $('#admission_number').val();
        var student_name = $('#student_name').val();
        var mobile_no = '';
        var email_address = '';
        // var mobile_no = $('#mobile_no').val();
        // var email_address = $('#email_address').val();

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
                        "<img src=" + student.student_details.image + " class='img_fluid' style='height:80px;' />",
                        "<input type='file' class='form-control' name='image' onchange='uploadStudentImage(this, " + student.student_details.id + ")'>",
                        student.student_class.class_name + '<br>' + student.student_section.section_name,
                        student.student_details.admission_number,
                        student.student_details.gender,
                        student.student_details.email
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

    function uploadStudentImage(input, studentId) {
        if (input.files && input.files[0]) {
            let formData = new FormData();
            formData.append('image', input.files[0]);
            formData.append('student_id', studentId);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('student.uploadImage') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response)
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }else{
                        Notiflix.Notify.Failure(response.error);
                    }
                    filterStudentDetails();
                },
                error: function(xhr) {
                    Notiflix.Notify.Failure('Image upload failed!');
                    console.error(xhr.responseText);
                }
            });
        }
    }


</script>

@endsection