@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Students Enrollment</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Students Enrollment</li>
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
            {{-- <div class="row">
                <div class="col-12 text-end">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="all">
                        <label class="form-check-label" for="inlineRadio1">Enrolled all</label>
                    </div>
                </div>
            </div> --}}
            <div class="table-responsive">
                <table class="w-100 table table-striped overflow-sc" id="DataTables">
                    <thead>
                        <tr>
                            <th>SL NO </th>
                            <th>Student Name</th>
                            <th>Admission Number</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Promoted to Next session</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Promoted Next Session</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-12 mb-2">
                        <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id_modal" class="form-select">
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="" class="form-label">Select class<span class="text-danger">*</span></label>
                        <select name="class_id" id="class_id_modal" class="form-select">
                            <option value="">--Select Class--</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12 mb-4">
                        <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="section_id_modal" class="form-select">
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <button type="reset" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <a href="javascript:void(0)" onclick="enrolledStudent()" class="btn btn-primary btn-sm">Enrolled</a>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

   </section>
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
                    history:0,
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
                                            <input class="form-check-input" type="checkbox" value="1" id="${item.student_details.id}_enroled" onclick="openModalEnrollStudent(${item.student_details.id}, this)">
                                        </td>
                                    </tr>
                                `);
                            });
                    }else{
                        tableBody.append('<tr><td colspan="4" class="text-center">No students found.</td></tr>');
                    }
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    };

    var userIds =[];
    function openModalEnrollStudent(user_id, event){
        if(event.checked){
            if (!userIds.includes(user_id)) {
                userIds.push(user_id);
            }
        }else{
            userIds = userIds.filter(function(id) {
                return id !== user_id;
            });
        }
    }

    function enrolledStudent(){
        var session_id = $('#session_id_modal').val();
        var class_id = $('#class_id_modal').val();
        var section_id = $('#section_id_modal').val();
        var userAllIds = JSON.stringify(userIds);
        if(userIds.length > 0 && session_id && class_id && section_id)
        {
            $.ajax({
                url: "{{route('student.studentsEntrollmentStore')}}",
                type: 'Post',
                data:{
                    session_id:session_id,
                    class_id:class_id,
                    section_id:section_id,
                    userIds: userAllIds,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#staticBackdrop").modal("hide");
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }
                    window.location.reload()
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }else{
            if(!session_id){
                Notiflix.Notify.Failure("Please select session.");
            }else if(!class_id){
                Notiflix.Notify.Failure("Please select class.");

            }else if(!section_id){
                Notiflix.Notify.Failure("Please select section.");

            }else{
                Notiflix.Notify.Failure("Please select students");
            }
        }
    }

</script>
@endsection