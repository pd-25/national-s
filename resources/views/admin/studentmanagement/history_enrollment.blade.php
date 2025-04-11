@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Enrollment History</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentsEntrollment') }}">Enrolled New Session</a></li>
            <li class="breadcrumb-item active">Enrollment History</li>
        </ol>
    </nav>
</div>
<section>
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="row my-3">
                <div class="col-4 mb-2">
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
                    <label for="" class="form-label">Select class<span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-select">
                        <option value="">--Select Class--</option>
                        @if (!@empty(GetClasses()))
                            @foreach (GetClasses() as $index=>$item)
                                <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-select" onchange="getAllStudent()">
                        <option value="">--Select Section--</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <h5 class="card-text fw-bold mb-3">Promoted students History.</h5>
            <hr>
            <div class="table-responsive">
                <table class="w-100 table table-striped table-sm overflow-sc" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th>SL NO </th>
                            <th>Student Name</th>
                            <th>Admission Number</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script>
     function getAllStudent() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        if (session_id && class_id && section_id) {
            $.ajax({
                url: "{{route('attendance.studentsListUsingSessionClassSection')}}",
                type: 'Post',
                data:{
                    session_id:session_id,
                    class_id:class_id,
                    section_id:section_id,
                    history:1,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var tableBody = $('#studentTableBody');
                    tableBody.empty(); 
                    if(response.length > 0){
                        $.each(response, function(index, item) {
                            tableBody.append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.student_details.student_name}</td>
                                    <td>${item.student_details.admission_number}</td>
                                    <td class="text-center">
                                        ${item.status == 1 ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>'}
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" onclick="updateEnrollStudent(${item.id}, ${item.student_details.id})"> <i class="bi bi-arrow-repeat text-info"></i> </a>

                                        <a href="javascript:void(0)" onclick="deleteEnrollStudent(${item.id})"><i class="bi bi-trash3-fill text-danger"></i></a>
                                    </td>
                                </tr>
                            `);
                        });
                    }else{
                        tableBody.append('<tr><td colspan="5" class="text-center">No students found.</td></tr>');
                    }
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    };
    var userIds =[];

    function updateEnrollStudent(enroll_id, user_id){
        Notiflix.Confirm.Show(
            "Update Confirmation",
            "Do you want to Update?",
            "Update",
            "Cancel",
            function() {
                $.ajax({
                url: "{{ route('student.updateEntrollmentHistory')}}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": enroll_id,
                    "user_id":user_id,
                },
                dataType: 'JSON',
                success:function(response)
                {
                    if(response.info){
                        Notiflix.Notify.Info(response.info);
                    }
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    window.location.reload();
                }
            });
        });
    }

    function deleteEnrollStudent(enroll_id){
        Notiflix.Confirm.Show(
            "Delete Confirmation",
            "Do you want to delete?",
            "Delete",
            "Cancel",
            function() {
                $.ajax({
                url: "{{ route('student.deleteEnrollmentHistory')}}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": enroll_id
                },
                dataType: 'JSON',
                success:function(response)
                {
                    if(response.warning){
                        Notiflix.Notify.Warning(response.warning);
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    window.location.reload();
                    Notiflix.Notify.Failure(response.warning);
                }
            });
        });
    }

</script>
@endsection