@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Enrollment</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.entrollmentHistory') }}">Enrollment History</a></li>
            <li class="breadcrumb-item active">Enrolled New Session</li>
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
            @if (!@empty(GetSession('deactive_session')))
                <p class="text-danger">To enroll a student in a new session, you need to create a new session first. 
                    <a href="{{route('ams.manageSessionTerm')}}">Manage Session</a>
                </p>
            @else
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
            @endif
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
                <form action="{{route('student.studentsEntrollmentStore')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="fw-bold mb-0">Privious Session Details</h6>
                            <hr>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Previous Session<span class="text-danger">*</span></label>
                            <select name="" id="modal_previous_session_id" class="form-select form-select-sm" disabled>
                                @if (!@empty(GetSession('deactive_session')))
                                    @foreach (GetSession('deactive_session') as $index=>$item)
                                        <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Previous class<span class="text-danger">*</span></label>
                            <select name="" id="modal_previous_class_id" class="form-select form-select-sm" disabled>
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
                            <select name="" id="modal_previous_section_id" class="form-select form-select-sm section_id" disabled>
                                <option value="">--Select Section--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="fw-bold mb-0">Current Session Details</h6>
                            <hr>
                        </div>
                        <div class="col-12 studentDatabind "></div>
                        <div class="col-3">
                            <label for="" class="form-label">Select Current Session<span class="text-danger">*</span></label>
                            <select name="session_id" id="session_id_modal" class="form-select" required>
                                @if (!@empty(GetSession('active_session')))
                                    @foreach (GetSession('active_session') as $index=>$item)
                                        <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Select Current class<span class="text-danger">*</span></label>
                            <select name="class_id" id="class_id_modal" class="form-select" required>
                                <option value="">--Select Class--</option>
                                @if (!@empty(GetClasses()))
                                    @foreach (GetClasses() as $index=>$item)
                                        <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Select Current Section <span class="text-danger">*</span></label>
                            <select name="section_id" id="section_id_modal" class="form-select" required>
                                <option value="">--Select Section--</option>
                            </select>
                        </div>
                        <input type="hidden" name="user_id" id="modal_student_id">
                        {{-- deposite --}}
                            <div class="col-3 mb-2">
                                <label for="" class="form-label">Student Roll<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="student_roll" id="student_roll" placeholder="Roll">
                            </div>
                            <div class="col-3 mb-2">
                                <label for="" class="form-label">Select Month<span class="text-danger">*</span></label>
                                <select name="month" id="month" class="form-select" required>
                                    <option value="">--Select Month--</option>
                                    @if (!@empty(GetallMonths()))
                                        @foreach (GetallMonths() as $item)
                                            <option value="{{@$item}}" {{$item == date('F') ? "selected": ""}}>{{@$item}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-3 mb-2">
                                <label for="" class="form-label">Select Year<span class="text-danger">*</span></label>
                                <select name="year" id="year" class="form-select" required>
                                    <option value="">--Select Year--</option>
                                    @if (!@empty(LastFiveYear()))
                                        @foreach (LastFiveYear() as $item)
                                            <option value="{{@$item}}" {{$item == date('Y') ? "selected": ""}}>{{@$item}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 my-2">
                                <div class="row p-3">
                                    <div class="col-8">
                                        Admission Charges / Enrolment Fee
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" name="enrolment_fee" onblur="CountTotalPayment()" id="enrolment_fee" min="0" value="0" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        Tuition Fee
                                    </div>
                                    <div class="col-4">
                                    <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="tuition_fee" onblur="CountTotalPayment()" id="tuition_fee" value="0" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        Terminal Fee
                                    </div>
                                    <div class="col-4">
                                    <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="terminal_fee" onblur="CountTotalPayment()" id="terminal_fee" value="0" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        Misc, Charges
                                    </div>
                                    <div class="col-4">
                                    <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="misc_charges" onblur="CountTotalPayment()" id="misc_charges" value="0" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        Identity Card
                                    </div>
                                    <div class="col-4">
                                    <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="identity_card" onblur="CountTotalPayment()" id="identity_card" value="0" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <b>Total</b>
                                    </div>
                                    <div class="col-4">
                                    <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="total" id="total" value="0" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <label for="" class="form-label">Payment Mode<span class="text-danger">*</span></label>
                                <select name="payment_mode" id="payment_mode" onclick="checkPaymentMode(value)" class="form-select" required>
                                    <option value="">--Select Mode--</option>
                                    <option value="Online">Online</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                            <div class="col-4 mb-2 ChequeShowHide">
                                <label for="" class="form-label">Cheque No</label>
                                <input type="text" class="form-control" name="cheque_no" id="cheque_no" placeholder="Cheque No">
                            </div>
                            <div class="col-4 mb-2 ChequeShowHide">
                                <label for="" class="form-label">Cheque Date</label>
                                <input type="date" class="form-control" name="cheque_date" id="cheque_date">
                            </div>
                            <div class="col-8 mb-2 ChequeShowHide">
                                <label for="" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name">
                            </div>
                            <div class="col-4 mb-2 ChequeShowHide">
                                <label for="" class="form-label">Branch</label>
                                <input type="text" class="form-control" name="branch" id="branch" placeholder="Branch">
                            </div>
                            <div class="col-8 mb-2 OnlineShowHide">
                                <label for="" class="form-label">Transaction Id</label>
                                <input type="text" class="form-control" name="transaction_id" id="transaction_id" placeholder="Transaction Id">
                            </div>
                        {{-- deposite end --}}
                        
                        <div class="col-12 mt-3">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success ">Pay & Promoted</a>
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

        $(".ChequeShowHide").hide();
        $(".OnlineShowHide").hide();
    });

    function checkPaymentMode(payment_mode){
        $(".ChequeShowHide").hide();
        $(".OnlineShowHide").hide();
        if(payment_mode == 'Cheque'){
            $(".ChequeShowHide").show();
        }else if(payment_mode == 'Online'){
            $(".OnlineShowHide").show();
        }
    }

    function CountTotalPayment(){
        var enrolment_fee = parseFloat($("#enrolment_fee").val()) || 0;
        var tuition_fee = parseFloat($("#tuition_fee").val()) || 0;
        var terminal_fee = parseFloat($("#terminal_fee").val()) || 0;
        var misc_charges = parseFloat($("#misc_charges").val()) || 0;
        var identity_card = parseFloat($("#identity_card").val()) || 0;

        var total = enrolment_fee + tuition_fee + terminal_fee + misc_charges + identity_card;
        $("#total").val(total.toFixed(2));
    }

    $(window).on('load', function() {
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
                                            <input class="form-check-input" type="radio" name="radioDefault" id="${item.student_details.id}_enroled" 
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

    var userdetails =[];
    function openModalEnrollStudent(radioElement){
        var studentDetailsString = radioElement.getAttribute('data-student');
        var studentDetails = JSON.parse(studentDetailsString);
        $('#modal_student_id').val(studentDetails.id);

        userdetails = studentDetails;

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
        var html  = `<h6 class="mb-2"><b>Student Name: </b>`+studentDetails.student_name+`</h6><h6 class="my-2"> <b>Admission No: </b>`+studentDetails.admission_number+`</h6>`
        $('.studentDatabind').html(html);
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