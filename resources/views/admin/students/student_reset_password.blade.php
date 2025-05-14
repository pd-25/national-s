@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Reset Password Student's</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.StudentRegister') }}">Admission</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentList') }}">Manage Student's</a></li>
            <li class="breadcrumb-item active">Reset Password Student's</li>
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
                            <th>Class Section</th>
                            <th>Admission Number</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="staticPasswordReset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Password Reset</h1>
      </div>
      <div class="modal-body">
        <form action="{{route('student.resetPassword')}}" method="post">
            @csrf
            <div class="row">
                <input type="hidden" name="student_id" id="student_id">
                <div class="col-md-12 mb-1">
                    <label for="student_name" class="form-label">Name of Pupil(In Capital Letters)<span class="text-danger">*</span></label>
                    <input type="text" disabled id="student_name" class="form-control text-uppercase" name="student_name" required value="{{old('student_name')}}">
                    @if ($errors->has('student_name'))
                        <span class="text-danger">{{ $errors->first('student_name') }}</span>
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <label for="email_address" class="form-label">E-Mail<span class="text-danger">*</span></label>
                    <input type="text" id="email_address" class="form-control text-lowercase" name="email"  value="{{old('email')}}" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <label for="password" class="form-label d-flex justify-content-between"><div>Password <span class="text-danger">*</span></div>
                        <div><i class="bi bi-magic fs-5 text-primary" onclick="generatePassword()"></i></div>
                    </label>
                    <input type="password" id="password" class="form-control showPassword" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                    <input type="password" id="password_confirmation" class="form-control showPassword" name="password_confirmation" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="col-12 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" onclick="myShowPassword()" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Show Password
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning text-white">Reset Password</button>
                    </div>
                </div>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>

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
                        student.student_class.class_name + '<br>' + student.student_section.section_name,
                        student.student_details.admission_number,
                        student.student_details.gender,
                        student.student_details.email,
                        '<a class="fw-bold text-link text-danger rounded-pill" href="javascript:void(0)" onclick=\'ResetStudentPassword(' + JSON.stringify(student.student_details) + ')\'>Reset Password</a>'
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

    function ResetStudentPassword(studentDetails){
        $('#student_id').val(studentDetails.id);
        $('#student_name').val(studentDetails.student_name);
        $('#email_address').val(studentDetails.email);
       $("#staticPasswordReset").modal("show");
    }

</script>

@endsection