@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
        <h1>Transfer & Promote Students History</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.studentsEntrollment') }}">Transfer & Promote
                        Students</a></li>
                <li class="breadcrumb-item active">Transfer & Promote Students History</li>
            </ol>
        </nav>
    </div>
    <section>
        <div class="card border-0">
            <div class="card-body pt-4">
                <h5 class="fw-bold mb-3">Promoted Students History</h5>
                <div class="row my-3">
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id" class="form-select">
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index => $item)
                                    <option value="{{ @$item->id }}">{{ @$item->sessions_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Class - Section<span class="text-danger">*</span></label>
                        <select name="class_id_section_id" id="class_id_section_id" class="form-select"
                            onchange="getAllStudent(value)">
                            <option value="">--Select Class--</option>
                            @if (!@empty(@$newSections))
                                @foreach (@$newSections as $index => $item)
                                    <option value="{{ @$item['id'] }}_{{ @$item['class_id'] }}">
                                        {{ @$item['class_section'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="DataTables">
                        <thead>
                            <tr class="table-primary">
                                <th>No.</th>
                                <th>Student</th>
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
    </section>
    <script>
        function getAllStudent(value) {
            var session_id = $('#session_id').val();
            // var section_class = $('#class_id_section_id').val();
            var section_class = value;
            var class_id = section_class.split('_')[1];
            var section_id = section_class.split('_')[0];
            if (session_id && class_id && section_id) {
                $.ajax({
                    url: "{{ route('attendance.studentsListUsingSessionClassSection') }}",
                    type: 'Post',
                    data: {
                        session_id: session_id,
                        class_id: class_id,
                        section_id: section_id,
                        history: 1,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var tableBody = $('#studentTableBody');
                        tableBody.empty();
                        if (response.length > 0) {
                            $.each(response, function(index, item) {
                                let updateButton = '';
                                if (item.status == 0) {
                                    updateButton =
                                        `<a href="javascript:void(0)" class="btn btn-info btn-sm text-white" onclick="updateEnrollStudent(${item.id}, ${item.student_details.id})">Update Status <i class="bi bi-arrow-repeat"></i></a>`;
                                }
                                tableBody.append(`
                                    <tr> 
                                        <td>${index + 1}</td>
                                        <td>${item.student_details.student_name} <br> ${item.student_details.admission_number}</td>
                                        <td class="text-center">
                                        ${item.status == 1 ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-danger">Inactive</span>'}
                                        </td>
                                        <td class="text-center">
                                            ${updateButton}
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteEnrollStudent(${item.id})">Delete Promotion<i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="4" class="fw-bold text-center">No students found.</td></tr>'
                            );
                        }
                    },
                    error: function() {
                        console.error('Error fetching sections');
                    }
                });
            } else {
                Notiflix.Notify.failure("Please select class section");
            }
        };

        function updateEnrollStudent(enroll_id, user_id) {
            Notiflix.Confirm.show(
                "Update Confirmation",
                "Do you want to Update?",
                "Update",
                "Cancel",
                function() {
                    $.ajax({
                        url: "{{ route('student.updateEntrollmentHistory') }}",
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": enroll_id,
                            "user_id": user_id,
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.info) {
                                Notiflix.Notify.info(response.info);
                            }
                            getAllStudent($('#class_id_section_id').val());
                        },
                        error: function(xhr, status, error) {
                            getAllStudent($('#class_id_section_id').val());
                        }
                    });
                });
        }

        function deleteEnrollStudent(enroll_id) {
            Notiflix.Confirm.show(
                "Delete Confirmation",
                "Do you want to delete?",
                "Delete",
                "Cancel",
                function() {
                    $.ajax({
                        url: "{{ route('student.deleteEnrollmentHistory') }}",
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": enroll_id
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.warning) {
                                Notiflix.Notify.warning(response.warning);
                                getAllStudent($('#class_id_section_id').val());
                            }
                        },
                        error: function(xhr, status, error) {
                            getAllStudent($('#class_id_section_id').val());
                            Notiflix.Notify.failure(response.error);
                        }
                    });
                });
        }
    </script>
@endsection
