@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Students Enrollment</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Enrollment New Session</li>
        </ol>
    </nav>
</div>
<section>
    @php
        $session_session_id = 0;
        $session_class_id = 0;
        $session_section_id = 0;
        if (Session::has('session_session_id')) {
            $session_session_id = Session::get('session_session_id');
        }
        if (Session::has('session_class_id')) {
            $session_class_id = Session::get('session_class_id');
        }
        if (Session::has('session_section_id')) {
            $session_section_id = Session::get('session_section_id');
        }
    @endphp
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="row my-3">
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Previous Session<span class="text-danger">*</span></label>
                    <select name="session_id" id="session_id" class="form-select">
                        @if (!@empty(GetSession('deactive_session')))
                            @foreach (GetSession('deactive_session') as $index=>$item)
                                <option value="{{@$item->id}}" {{@$session_session_id == $item->id ? 'selected' : '' }}>{{@$item->sessions_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Previous class<span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-select">
                        <option value="">--Select Class--</option>
                        @if (!@empty(GetClasses()))
                            @foreach (GetClasses() as $index=>$item)
                                <option value="{{@$item->id}}" {{@$session_class_id == $item->id ? 'selected' : '' }}>{{@$item->class_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Previous Section <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-select" onchange="getAllStudent()">
                        <option value="">--Select Section--</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <h5 class="card-text fw-bold mb-3">Promoted students for the new session.</h5>
            <hr>
            <div class="table-responsive">
                <table class="w-100 table table-striped table-sm overflow-sc" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th>SL NO </th>
                            <th>Student Name</th>
                            <th>Admission Number</th>
                            <th class="text-center">Select Student for Promotion</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <tr class="table-secondary text-center" id="ShowHideNoStudent">
                            <td colspan="4" >No Student's Found</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Promoted Next Session</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="fw-bold mb-0">Privious Session Details</h6>
                        <hr>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label">Previous Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="modal_previous_session_id" class="form-select" disabled>
                            @if (!@empty(GetSession('deactive_session')))
                                @foreach (GetSession('deactive_session') as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label">Previous class<span class="text-danger">*</span></label>
                        <select name="class_id" id="modal_previous_class_id" class="form-select" disabled>
                            <option value="">--Select Class--</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label">Previous Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="modal_previous_section_id" class="form-select section_id" disabled>
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-0">Current Session Details</h6>
                        <hr>
                    </div>
                    <div class="col-12"></div>
                    <div class="col-4">
                        <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id_modal" class="form-select">
                            @if (!@empty(GetSession('active_session')))
                                @foreach (GetSession('active_session') as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
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
                    <div class="col-4">
                        <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="section_id_modal" class="form-select">
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    
                    <div class="col-12 mt-3">
                        <button type="reset" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <a href="javascript:void(0)" onclick="enrolledStudent()" class="btn btn-success btn-sm">Promoted</a>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

   </section>


<script>
    $(document).ready(function(){
        $('#ShowHideNoStudent').show();
        $('#class_id').trigger('change');
    });

    $(window).on('load', function() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        if (class_id) {
            setTimeout(function() {
                $('#section_id').val("{{ session('session_section_id') }}");
                var section_id = $('#section_id').val();
                $('#modal_previous_session_id').val(session_id);
                $('#modal_previous_class_id').val(class_id);
                $('#modal_previous_class_id').trigger('change');
                setTimeout(function() {
                    $('#modal_previous_section_id').val(section_id);
                }, 1500);
                getAllStudent();
            }, 1500);
        }
    });

    function getAllStudent() {
        $('#ShowHideNoStudent').hide();
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
                                            <input class="form-check-input" type="radio" id="${item.student_details.id}_enroled" 
                                                data-student='${JSON.stringify(item.student_details).replace(/'/g, "&apos;").replace(/"/g, "&quot;")}' 
                                                onclick="openModalEnrollStudent(this)">
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

    // var userIds =[];
    function openModalEnrollStudent(radioElement){
        var studentDetailsString = radioElement.getAttribute('data-student');
        var studentDetails = JSON.parse(studentDetailsString);
        console.log(studentDetails)

        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        if (class_id) {
            $('#modal_previous_session_id').val(session_id);
            $('#modal_previous_class_id').val(class_id);
            $('#modal_previous_class_id').trigger('change');
            setTimeout(function() {
                $('#modal_previous_section_id').val(section_id);
            }, 1500);
        }

        

        $('#staticBackdrop').modal('show');

        // if(event.checked){
        //     if (!userIds.includes(user_id.id)) {
        //         userIds.push(user_id.id);
        //     }
        // }else{
        //     userIds = userIds.filter(function(id) {
        //         return id !== user_id.id;
        //     });
        // }
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