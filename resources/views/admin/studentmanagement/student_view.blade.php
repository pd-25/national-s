@extends('admin.layout.admin_main')
@section('content')
<style>
    .prof-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 3px solid #007bff;
    }
    table th {
        background-color: #007bff;
        color: white;
        padding: 8px;
    }
    table td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
</style>
<div class="pagetitle">
    <h1>View Student</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentList') }}">All Student</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentEdit', @$studentClassMapping->id) }}">Edit Student</a></li>
            <li class="breadcrumb-item active">View Student</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-card text-center p-3">
                        <img src="{{@$studentClassMapping->image ?: asset('assets/admin/img/upload.png') }}" 
                            class="rounded-circle prof-photo mb-3" 
                            alt="Student Image" 
                            id="preview-image-before-upload">
                        <input type="file" class="form-control d-none" name="image" id="image" accept="image/*">
                        <h5 class="fw-bold">{{@$studentClassMapping->student_name}}</h5>
                        <p class="text-muted mb-0">Admission No: <span class="fw-bold">{{@$studentClassMapping->admission_number}}</span></p>
                        <p class="text-muted">Email: <span class="fw-bold">{{@$studentClassMapping->email}}</span></p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="accordion" id="Student">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-Student" aria-expanded="true" aria-controls="panelsStayOpen-Student">
                                    Student Information
                                </button>
                            </h2>
                            <div id="panelsStayOpen-Student" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <table class="table  mt-3 table-borderless">
                                        <tr><th>Name</th><td>{{@$studentClassMapping->student_name}}</td></tr>
                                        <tr><th>Date of Birth</th><td>{{@$studentClassMapping->date_of_birth}}</td></tr>
                                        <tr><th>Gender</th><td>{{@$studentClassMapping->gender}}</td></tr>
                                        <tr><th>Aadhar No</th><td>{{@$studentClassMapping->aadhar_no}}</td></tr>
                                        <tr><th>Nationality</th><td>{{@$studentClassMapping->nationality}}</td></tr>
                                        <tr><th>Religion</th><td>{{@$studentClassMapping->religion}}</td></tr>
                                        <tr><th>Caste</th><td>{{@$studentClassMapping->caste}}</td></tr>
                                        <tr><th>Address</th><td>{{@$studentClassMapping->address}} {{@$studentClassMapping->pin_code}}</td></tr>
                                        <tr><th>Blood Group</th><td>{{@$studentClassMapping->blood_group}}</td></tr>
                                        <tr><th>Stream</th><td>{{@$studentClassMapping->stream}} {{@$studentClassMapping->combination_text}}</td></tr>
                                        <tr><th>Mother Tongue</th><td>{{@$studentClassMapping->mother_tongue}}</td></tr>
                                        <tr><th>Co-curricular Activities</th><td>{{@$studentClassMapping->achievements}}</td></tr>
                                        <tr><th>History of previous illness</th><td>{{@$studentClassMapping->previous_school_info}}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 mb-4">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Previous Academic Information
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <table class="table table-borderless mt-3">
                                    <tbody id="tableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="accordion" id="Achievements">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-Achievements" aria-expanded="true" aria-controls="panelsStayOpen-Achievements">
                                    Achievements / History
                                </button>
                            </h2>
                            <div id="panelsStayOpen-Achievements" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <table class="table table-borderless mt-3">
                                        <tr><th>Co-curricular activities</th><td>{{@$studentClassMapping->achievements}}</td></tr>
                                        <tr><th>History of previous illness</th><td>{{@$studentClassMapping->previous_school_info}}</td></tr>
                                        <tr><th>Transport facility</th><td>{{@$studentClassMapping->transport_facility}}</td></tr>
                                        <tr><th>Route If(Yes)</th><td>{{@$studentClassMapping->route}}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="accordion" id="ParentandGuardian">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-ParentandGuardian" aria-expanded="true" aria-controls="panelsStayOpen-ParentandGuardian">
                                    Parent/Guardian Details
                                </button>
                            </h2>
                            <div id="panelsStayOpen-ParentandGuardian" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <table class="table table-borderless mt-3">
                                        <tr><th>Parent Name</th><td>{{@$studentClassMapping->parent_name}}</td></tr>
                                        <tr><th>Relation</th><td>{{@$studentClassMapping->parent_relation}}</td></tr>
                                        <tr><th>Qualification</th><td>{{@$studentClassMapping->qualification}}</td></tr>
                                        <tr><th>Occupation</th><td>{{@$studentClassMapping->occupation}}</td></tr>
                                        <tr><th>Organization</th><td>{{@$studentClassMapping->organization}}</td></tr>
                                        <tr><th>Designation</th><td>{{@$studentClassMapping->designation}}</td></tr>
                                        <tr><th>Aadhar Number</th><td>{{@$studentClassMapping->parent_aadhar_number}}</td></tr>
                                        <tr><th>Annual Income (Rs.)</th><td>{{@$studentClassMapping->annual_income}}</td></tr>
                                        <tr><th>Mobile No</th><td>{{@$studentClassMapping->mobile_no}}</td></tr>
                                        <tr><th>Office Contact Number</th><td>{{@$studentClassMapping->office_contact_number}}</td></tr>
                                        <tr><th>If Guardian, then mention the relationship</th><td>{{@$studentClassMapping->mention_relationship}}</td></tr>
                                        <tr><th>Mobile No</th><td>{{@$studentClassMapping->mobile_no}}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="accordion mb-4" id="Enrollment">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-Enrollment" aria-expanded="true" aria-controls="panelsStayOpen-Enrollment" onclick="GetStudentEnrollment()" id="enrollmentAndHistory"> 
                        Enrollment History
                        </button>
                    </h2>
                    <div id="panelsStayOpen-Enrollment" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="w-100 table  table-striped overflow-sc" id="DataTables">
                                    <thead>
                                        <tr>
                                            <th>SL NO </th>
                                            <th>Student Name</th>
                                            <th>Admission Number</th>
                                            <th class="text-center">Session</th>
                                            <th class="text-center">Class</th>
                                            <th class="text-center">Section</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                    <select name="session_id" id="session_id" class="form-select" onchange="viewStudentAttendance(); filterDepositeDetails()">
                        @if (!@empty(GetSession('all_session')))
                            @foreach (GetSession('all_session') as $index=>$item)
                                <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="accordion mb-4" id="Attendance">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-Attendance" aria-expanded="true" aria-controls="panelsStayOpen-Attendance" onclick="viewStudentAttendance()" id="AttendanceHistory"> 
                        Attendance History
                        </button>
                    </h2>
                    <div id="panelsStayOpen-Attendance" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="w-100 table  table-striped overflow-sc" id="DataTablesAttendance">
                                    <thead>
                                        <tr>
                                            <th>SL NO </th>
                                            <th>Student Name</th>
                                            <th>Admission Number</th>
                                            <th>Attenadnce Date</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center">Check</th>
                                            <th class="text-center">Late</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion mb-4" id="Deposite">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-Deposite" aria-expanded="true" aria-controls="panelsStayOpen-Deposite" onclick="filterDepositeDetails()" id="DepositeHistory"> 
                        Deposite History
                        </button>
                    </h2>
                    <div id="panelsStayOpen-Deposite" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="w-100 table  table-striped overflow-sc" id="DataTablesDeposite">
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Payment NO</th>
                                            <th>Admission No</th>
                                            <th>Name</th>
                                            <th>Session</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function (e) {
        DynamictrtdBind();
        $('#DataTables').DataTable();
        $('#DataTablesAttendance').DataTable();
        $('#DataTablesDeposite').DataTable();
    });
    
    function GetStudentEnrollment(){
        var aria = $("#enrollmentAndHistory").attr("aria-expanded");
        // var session_id = $('#session_id').val();
        var user_id = "{{$studentClassMapping->id}}";
        if(aria == 'true'){
            $.ajax({
                url: "{{route('student.sessionWiseStudent')}}",
                type: 'Post',
                data:{
                    // session_id:session_id,
                    user_id:user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var tableBody = $('#DataTables').DataTable();
                    tableBody.clear().draw();
                   
                    $.each(response, function(index, item) {
                        tableBody.row.add([
                            index + 1,
                            item.student_details.student_name,
                            item.student_details.admission_number,
                            item.student_session.sessions_name,
                            item.student_class.class_name,
                            item.student_section.section_name,
                            item.status == 1 ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>',

                        ]).draw(false);

                    });

                    tableBody.destroy();
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
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    }
    
    function viewStudentAttendance(){
        var aria = $("#AttendanceHistory").attr("aria-expanded");
        var session_id = $('#session_id').val();
        var user_id = "{{$studentClassMapping->id}}";
        var typeData = 1;
        if(aria == 'true'){
            $.ajax({
                url: "{{ route('attendance.viewStudentList') }}",
                type: "POST",
                dataType: "json",
                data: {
                    session_id:session_id,
                    student_id:user_id,
                    class_id:null,
                    section_id:null,
                    typeData:typeData,
                    single_date:null,
                    from_date:null,
                    to_date:null,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var table = $('#DataTablesAttendance').DataTable({
                        destroy: true,
                        data: response || [], 
                        columns: [
                            { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
                            { data: 'student_details.student_name' },
                            { data: 'student_details.admission_number' },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    const date = new Date(data.date_taken);
                                    const options = {
                                        year: 'numeric',
                                        month: '2-digit',
                                        day: '2-digit'
                                    };
                                    return date.toLocaleDateString('en-Uk', options);
                                }
                            },
                            { data: 'time_taken', className: 'text-center' },
                            { 
                                data: null,
                                render: function(data) {
                                    if (data.status == 1 && data.late == 0) {
                                        return '<i class="bi bi-check-lg text-success fs-5"></i>';
                                    } else if (data.status == 0 && data.late == 0) {
                                        return '<i class="bi bi-x text-danger fs-4"></i>';
                                    } else {
                                        return '<i class="bi bi-reception-0 text-secondary fs-5"></i>';
                                    }
                                },
                                className: 'text-center'
                            },
                            { 
                                data: null,
                                render: function(data) {
                                    if (data.status == 1 && data.late == 1) {
                                        return '<i class="bi bi-exclamation-diamond text-warning fs-5"></i>';
                                    } else {
                                        return '<i class="bi bi-reception-0 text-secondary fs-5"></i>';
                                    }
                                },
                                className: 'text-center'
                            }
                        ]
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#results').append('<p>An error occurred while searching for students.</p>');
                }
            });
        }
    }

    function filterDepositeDetails(){
        var aria = $("#DepositeHistory").attr("aria-expanded");
        var session_id = $('#session_id').val();
        var user_id = "{{$studentClassMapping->id}}";
        var typeData = 1;
        if(aria == 'true'){
            $.ajax({
                url: "{{ route('deposite.show') }}",
                type: "POST",
                dataType: "json",
                data: {
                    payment_number:null,
                    session_id: session_id,
                    class_id: null,
                    section_id: null,
                    user_id: user_id,
                    month: null,
                    year: null,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var table = $('#DataTablesDeposite').DataTable();
                    table.clear().draw();

                    $.each(response, function(index, deposite) {
                        table.row.add([
                            index + 1,
                            deposite.student_details.admission_number,
                            deposite.payment_number,
                            deposite.student_name,
                            deposite.student_session.sessions_name,
                            deposite.student_class.class_name,
                            deposite.student_section.section_name,
                            deposite.month,
                            deposite.year,
                            deposite.total,
                            new Date(deposite.created_at).toLocaleDateString('en-UK', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }),
                        ]).draw(false);
                    });

                    table.destroy();
                    $('#DataTablesDeposite').DataTable({
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
    }

    function DynamictrtdBind() {
        var school_name = {!! json_encode(@$studentClassMapping->school_name) !!} || [];
        var academic_session = {!! json_encode(@$studentClassMapping->academic_session) !!} || [];
        var class_data = {!! json_encode(@$studentClassMapping->class) !!} || []; 
        var second_language = {!! json_encode(@$studentClassMapping->second_language) !!} || [];

        var school_name_data = JSON.parse(school_name);
        var academic_session_data = JSON.parse(academic_session);
        var class_data_data = JSON.parse(class_data);
        var second_language_data = JSON.parse(second_language);


        if (school_name_data.length > 0 || academic_session_data.length > 0 || class_data_data.length > 0 || second_language_data.length > 0) {
            let tableBody = $("#tableBody");
            let lastRow = tableBody.find("tr.dynamicRow").last();
            if (lastRow.length) {
                lastRow.remove();
            }
            for (let index = 0; index < school_name_data.length; index++) {
                let newRow = `
                    <tr class="dynamicRow">
                        <td>`+school_name_data[index]+`</td>
                        <td>`+academic_session_data[index]+`</td>
                        <td>`+class_data_data[index]+`</td>
                        <td>`+second_language_data[index]+`</td>
                    </tr>
                `;
                tableBody.append(newRow);
            }
        }
    }
</script>
@endsection