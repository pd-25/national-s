@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
        <h1>Transfer & Promote Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.entrollmentHistory') }}">Transfer & Promote History</a>
                </li>
                <li class="breadcrumb-item active">Transfer & Promote Students</li>
            </ol>
        </nav>
    </div>
    <section>
        <div class="card border-0 mb-4">
            <div class="card-body pt-4">
                <h5 class="fw-bold mb-3">Transfer Student In Next Section</h5>
                <div class="row my-4">
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Current Class - Section<span
                                class="text-danger">*</span></label>
                        <select name="class_id_section_id" id="class_id_section_id" class="form-select"
                            onchange="GetClassWiseSection(value)">
                            <option value="">--Select Class--</option>
                            @if (!@empty(@$newSections))
                                @foreach (@$newSections as $index => $item)
                                    <option value="{{ @$item['id'] }}_{{ @$item['class_id'] }}">
                                        {{ @$item['class_section'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Transfer Class Section<span
                                class="text-danger">*</span></label>
                        <select name="class_id_wise_section_id" id="class_id_wise_section_id" class="form-select">
                            <option value="">--Select Class--</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table-bordered table table-striped" id="DataTables">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center" style="width: 20px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="all_student_checked"
                                            onchange="toggleAllUsers(this)" id="all_student_checked">
                                    </div>
                                </th>
                                <th>NO.</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            <tr class="text-center" id="ShowHideNoStudent">
                                <td colspan="3" class="fw-bold">No Student's Found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-secondary" onclick="SubmitTransferStudentSection()">Transfer Student</button>
                </div>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-body pt-4">
                <h5 class="fw-bold mb-3">Promote Student In Next Section</h5>
                <div class="row my-4">
                    <div class="col-3">
                        <label for="" class="form-label">Previous Session<span class="text-danger">*</span></label>
                        <select name="previous_session_id" id="previous_session_id" class="form-select">
                            @if (!@empty(GetSession('deactive_session')))
                                @foreach (GetSession('deactive_session') as $index => $item)
                                    <option value="{{ @$item->id }}">{{ @$item->sessions_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <label for="" class="form-label">Class Section<span class="text-danger">*</span></label>
                        <select name="previous_class_id_section_id" id="previous_class_id_section_id" class="form-select"
                            onchange="getAllStudent('deactive_session', 'previous_session_id', 'previous_class_id_section_id', 'priviousSessionStudent')">
                            <option value="">--Select Class--</option>
                            @if (!@empty(@$newSections))
                                @foreach (@$newSections as $index => $item)
                                    <option value="{{ @$item['id'] }}_{{ @$item['class_id'] }}">
                                        {{ @$item['class_section'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="" class="form-label">Promote In<span class="text-danger">*</span></label>
                        <select name="promote_session_id" id="promote_session_id" class="form-select">
                            @if (!@empty(GetSession('active_session')))
                                @foreach (GetSession('active_session') as $index => $item)
                                    <option value="{{ @$item->id }}">{{ @$item->sessions_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <label for="" class="form-label">Promote Class - Section<span
                                class="text-danger">*</span></label>
                        <select name="promote_class_id_section_id" id="promote_class_id_section_id" class="form-select">
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
                    <table class="table-bordered table table-striped" id="DataTables">
                        <thead>
                            <tr class="table-primary">
                                <th>NO.</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="priviousSessionStudent">
                            <tr class="text-center" id="ShowHideNoStudentPrev">
                                <td colspan="3" class="fw-bold">No Student's Found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <script>
        var user_ids = [];
        $(document).ready(function() {
            $('#ShowHideNoStudent').show();
            $('#ShowHideNoStudentPrev').show();
            $('#class_id').trigger('change');
        });
        //Get Class Wise Section
        function GetClassWiseSection(class_id) {
            $('#class_id_wise_section_id').prop('disabled', true);
            var section_class = $('#class_id_section_id').val();
            if (class_id) {
                $.ajax({
                    url: "{{ route('student.studentsClasWiseSection') }}",
                    type: 'Get',
                    data: {
                        class_id: class_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#class_id_wise_section_id').empty();
                        if (response.length < 2) {
                            $('#class_id_wise_section_id').append(
                                '<option value="null" selected">--No Data Found--</option>');
                            $('#class_id_wise_section_id').prop('disabled', true);
                        } else {
                            getAllStudent('active_session', null, 'class_id_section_id', 'studentTableBody');
                            $.each(response, function(index, item) {
                                $('#class_id_wise_section_id').prop('disabled', false);
                                if (item.id + '_' + item.class_id != section_class) {
                                    $('#class_id_wise_section_id').append('<option value="' + item.id +
                                        '_' + item.class_id + '">' + item.class_section +
                                        ') </option>');
                                }
                            });
                        }
                    },
                    error: function() {
                        console.error('Error fetching sections');
                    }
                });
            }
        };
        //Get all student for particular section
        function getAllStudent(session, session_id, classSection, tableid) {
            var GetSession;
            if (session == 'active_session') {
                GetSession = @json(GetSession('active_session'));
            } else if (session == 'deactive_session') {
                GetSession = @json(GetSession('deactive_session'));
            }
            if (GetSession.length > 0 && session_id == null) {
                var session_id = GetSession[0].id;
            } else if (GetSession.length > 0 && session_id != null) {
                var session_id = $('#' + session_id).val();
            }
            var section_class = $('#' + classSection).val();
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
                        history: 0,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var tableBody = $('#' + tableid);
                        if (tableBody.attr('id') == 'priviousSessionStudent') {
                            tableBody.empty();
                            if (response.length > 0) {
                                $.each(response, function(index, item) {
                                    tableBody.append(`
                                    <tr> 
                                        <td>${index + 1}</td>
                                        <td>${item.student_details.student_name} <br> ${item.student_details.admission_number}</td>
                                        <td class="">
                                            <div class="form-check form-check-inline">
                                                <button class="btn btn-success btn-sm" type="button" onclick="PromoteStudentSection(${item.user_id}, )"><i class="bi bi-check2-circle"></i> Promoted</button>
                                            </div>
                                        </td>
                                    </tr>
                                `);
                                });
                            } else {
                                tableBody.append(
                                    '<tr><td colspan="3" class="fw-bold text-center">No students found.</td></tr>'
                                );
                            }
                        } else {
                            tableBody.empty();
                            if (response.length > 0) {
                                $.each(response, function(index, item) {
                                    tableBody.append(`
                                       <tr> 
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" name="transfer_section[]" id="${item.user_id}_transfer_section" value="${item.user_id}" onchange="TransferStudentSection(${item.user_id}, this)">
                                            </td>
                                            <td>${index + 1}</td>
                                            <td>${item.student_details.student_name} <br> ${item.student_details.admission_number}</td>
                                        </tr>
                                    `);
                                });
                            } else {
                                tableBody.append(
                                    '<tr><td colspan="3" class="fw-bold text-center">No students found.</td></tr>'
                                );
                            }
                        }
                    },
                    error: function() {
                        console.error('Error fetching sections');
                    }
                });
            }
        };

        function TransferStudentSection(user_id, event) {
            if (event.checked) {
                if (!user_ids.includes(user_id)) {
                    user_ids.push(user_id);
                }
            } else {
                user_ids = user_ids.filter(id => id !== user_id);
            }
        }

        function toggleAllUsers(masterCheckbox) {
            const allCheckboxes = document.querySelectorAll('input[name="transfer_section[]"]');
            user_ids = [];
            allCheckboxes.forEach(cb => {
                cb.checked = masterCheckbox.checked;
                const user_id = parseInt(cb.value);
                if (masterCheckbox.checked) {
                    if (!user_ids.includes(user_id)) {
                        user_ids.push(user_id);
                    }
                }
            });
            if (!masterCheckbox.checked) {
                user_ids = [];
            }
        }

        function SubmitTransferStudentSection() {
            var GetSession = @json(GetSession('active_session'));
            if (GetSession.length > 0) {
                var session_id = GetSession[0].id;
            }
            var section_class = $('#class_id_wise_section_id').val();
            var section_class_old = $('#class_id_section_id').val();
            var class_id = section_class.split('_')[1];
            var section_id = section_class.split('_')[0];
            var old_section_id = section_class_old.split('_')[0];
            if (session_id && class_id && section_id && user_ids.length > 0) {
                $.ajax({
                    url: "{{ route('student.storeTransferStudents') }}",
                    type: 'Post',
                    data: {
                        session_id: session_id,
                        class_id: class_id,
                        section_id: section_id,
                        user_ids: user_ids,
                        old_section_id: old_section_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        getAllStudent('active_session', null, 'class_id_section_id', 'studentTableBody');
                        Notiflix.Notify.success(response[1]);
                    },
                    error: function(xhr, status, error) {
                        Notiflix.Notify.failure(response[1]);
                    }
                })
            }
        }

        function PromoteStudentSection(user_id) {
            Notiflix.Confirm.show(
                "Promote Confirmation",
                "Do you want to Promote?",
                "Promote",
                "Cancel",
                function() {
                    var session_id = $("#promote_session_id").val();
                    var promote_class_id_section_id = $("#promote_class_id_section_id").val();
                    if (!promote_class_id_section_id) {
                        Notiflix.Notify.failure("Please Select Class Section");
                        return;
                    }
                    var class_id = promote_class_id_section_id.split('_')[1];
                    var section_id = promote_class_id_section_id.split('_')[0];
                    if (user_id && session_id && class_id && section_id) {
                        $.ajax({
                            url: "{{ route('student.studentsEntrollmentStore') }}",
                            type: 'Post',
                            data: {
                                session_id: session_id,
                                class_id: class_id,
                                section_id: section_id,
                                user_id: user_id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $("#promote_session_id").val(session_id);
                                $("#promote_class_id_section_id").val(section_id + '_' + class_id);
                                getAllStudent('deactive_session', 'previous_session_id',
                                    'previous_class_id_section_id', 'priviousSessionStudent');
                                Notiflix.Notify.success(response[1]);
                            },
                            error: function(xhr, status, error) {
                                Notiflix.Notify.failure(response[1]);
                            }
                        });
                    }
                });
        }
    </script>
@endsection
