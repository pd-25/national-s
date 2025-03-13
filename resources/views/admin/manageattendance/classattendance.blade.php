@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Class Attendance</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Class Attendance</li>
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
                        <option value="">Select Class</option>
                        @if (!@empty(GetClasses()))
                            @foreach (GetClasses() as $index=>$item)
                                <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('class_id'))
                        <span class="text-danger">{{ $errors->first('class_id') }}</span>
                    @endif
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-select">
                        <option value="">Select Section</option>
                    </select>
                    @if ($errors->has('section_id'))
                        <span class="text-danger">{{ $errors->first('section_id') }}</span>
                    @endif
                </div>
                <div class="col-4 mb-2">
                    <label for="" class="form-label">Select Date <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="dateAttendance" value="{{date('Y-m-d')}}" name="dateAttendance">
                </div>
                <div class="col-12 text-end">
                    <button onclick="viewAttendance()" type="submit" class="btn btn-primary me-2">View Attendance</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="table-responsive">
                <table class="w-100 table  table-striped overflow-sc" id="DataTables">
                    <thead>
                        <tr>
                            <th>SL NO </th>
                            <th>Teacher</th>
                            <th>Student Name</th>
                            <th>Admission Number</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">Check</th>
                            <th class="text-center">Late</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#DataTables').DataTable();
    });
    function viewAttendance(){
        var dateAttendance = $('#dateAttendance').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        if(dateAttendance && session_id && class_id && section_id){
            $.ajax({
                url: "{{ route('attendance.classAttendanceData') }}",
                type: "POST",
                dataType: "json",
                data: {
                    session_id: session_id,
                    class_id:class_id,
                    section_id:section_id,
                    dateAttendance:dateAttendance,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var table = $('#DataTables').DataTable({
                        destroy: true,
                        data: response || [], 
                        columns: [
                            { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
                            { data: 'teacher_details.name' },
                            { data: 'student_details.student_name' },
                            { data: 'student_details.admission_number' },
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
                            },
                            { 
                                data: null,
                                render: function(data) {
                                    return '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteStudentAttendance(' + data.id + ')"><i class="bi bi-trash"></i></a>';
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
</script>
@endsection