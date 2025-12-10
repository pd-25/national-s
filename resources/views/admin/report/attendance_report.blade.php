@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
        <h1>Attendance Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Attendance Report</li>
            </ol>
        </nav>
    </div>
    <section>
        <div class="card border-0">
            <div class="card-body pt-4">
                <form action="#">
                    <div class="row my-3">
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">Session</label>
                            <select name="session_id" id="session_id" class="form-select" required
                                onchange="getAllStudent()">
                                @if (!@empty(GetSession('all_session')))
                                    @foreach (GetSession('all_session') as $index => $item)
                                        <option value="{{ @$item->id }}">{{ @$item->sessions_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">Class - Section</label>
                            <select name="class_id_section_id" id="class_id_section_id" class="form-select"
                                onchange="getAllStudent()" required>
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
                            <label for="" class="form-label">Student</label>
                            <select name="student_id" id="report_student_id" class="form-select">
                                <option value="All">All</option>
                            </select>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">from Date</label>
                            <input class="form-control" type="date" id="from_date" name="from_date" required>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">To Date</label>
                            <input class="form-control" type="date" id="to_date" name="to_date" required>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="status_id" class="form-select">
                                <option value="All">All</option>
                                <option value="P">Present</option>
                                <option value="A">Absent</option>
                                <option value="L">Late</option>
                            </select>
                        </div>
                        <div class="col-12 text-end mt-2">
                            <button onclick="viewAttendanceReport()" id="SaveButton" type="button"
                                class="btn btn-primary me-2"><i class="bi bi-journal-text"></i> Generate
                                Report</button>
                            <button type="reset" onclick="$('#showAttendanceReport').hide()"
                                class="btn btn-secondary me-2"><i class="bi bi-arrow-clockwise"></i>
                                Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="attendanceLoader" class="text-center py-3" style="display:none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="mt-2 fw-bold">Generating report...</div>
        </div>

        <div class="card border-0" id="showAttendanceReport">
            <div class="card-body pt-4">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0 fw-bold text-uppercase">Attendance Report</h5>
                    <div class="d-flex">
                        <button id="exportExcel" class="btn btn-success btn-sm me-2"><i
                                class="bi bi-file-earmark-spreadsheet"></i>
                            Download
                            Excel</button>
                        <button id="exportPdf" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i>
                            Download
                            PDF</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 my-2">
                        <canvas id="myChartAttendanceReport"></canvas>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="w-100 table table-bordered table-striped overflow-sc">
                        <thead>
                            <tr class="table-dark">
                                <th>NO </th>
                                <th>Teacher's</th>
                                <th>Admission#</th>
                                <th>Student's</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">P/A/L</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBodyReport">
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $("#showAttendanceReport").hide();
        });

        function getAllStudent() {
            var session_id = $('#session_id').val();
            var section_class = $('#class_id_section_id').val();
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
                        $('#report_student_id').empty();
                        $('#report_student_id').append('<option value="All" >All</option>');
                        $.each(response, function(index, item) {
                            $('#report_student_id').append('<option value="' + item
                                .student_details.id + '">' + item.student_details
                                .student_name + ' (' + item.student_details
                                .admission_number + ') </option>');
                        });
                    },
                    error: function() {
                        console.error('Error fetching sections');
                    }
                });
            } else {
                Notiflix.Notify.failure("Please select class section");
            }
        };

        function viewAttendanceReport() {
            var session_id = $('#session_id').val();
            var section_class = $('#class_id_section_id').val();
            var class_id = section_class.split('_')[1];
            var section_id = section_class.split('_')[0];
            var student_id = $('#report_student_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var status = $('#status_id').val();
            if (session_id && class_id && section_id && from_date && to_date) {
                $("#attendanceLoader").show();
                $("#showAttendanceReport").hide();
                $.ajax({
                    url: "{{ route('report.classAttendance') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        session_id: session_id,
                        class_id: class_id,
                        section_id: section_id,
                        student_id: student_id,
                        from_date: from_date,
                        to_date: to_date,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        BarChartAttendaceReport(response);
                        $("#attendanceLoader").hide();
                        $("#showAttendanceReport").show();
                        let tbody = $("#studentTableBodyReport");
                        tbody.empty();
                        if (!response || response.length === 0) {
                            tbody.append(
                                '<tr><td colspan="8" class="text-center text-danger">No records found</td></tr>'
                            );
                            return;
                        }
                        response.forEach(function(data, index) {

                            let statusHTML = '';
                            if (data.status == 1 && data.late == 0) {
                                statusHTML = '<span class="text-success">P</span>';
                            } else if (data.status == 0 && data.late == 0) {
                                statusHTML = '<span class="text-danger">A</span>';
                            } else if (data.status == 1 && data.late == 1) {
                                statusHTML = '<span class="text-warning">L</span>';
                            }

                            let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${data.teacher_details?.name || ''}</td>
                            <td>${data.student_details?.admission_number || ''}</td>
                            <td>${data.student_details?.student_name || ''}</td>
                            <td class="text-center">${data.date_taken || ''}</td>
                            <td class="text-center">${data.time_taken || ''}</td>
                            <td class="text-center">${statusHTML}</td>
                        </tr>
                    `;
                            tbody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        $("#attendanceLoader").hide();
                        console.error(xhr.responseText);
                        Notiflix.Notify.failure("Something went wrong!");
                    }
                });
            } else {
                Notiflix.Notify.failure("Please Select Class and Section");
            }
        }

        // Excel Export
        $('#exportExcel').on('click', function() {
            let rows = [];
            $("#studentTableBodyReport tr").each(function() {
                let tds = $(this).find("td");
                rows.push({
                    "Teacher Name": tds.eq(1).text(),
                    "Admission Number": tds.eq(2).text(),
                    "Student Name": tds.eq(3).text(),
                    "Date": tds.eq(4).text(),
                    "Time": tds.eq(5).text(),
                    "Status": tds.eq(6).text()
                });
            });
            var ws = XLSX.utils.json_to_sheet(rows);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Attendance Report");
            XLSX.writeFile(wb, "attendance_report.xlsx");
        });

        $('#exportPdf').on('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            var doc = new jsPDF('l', 'pt', 'a4');
            doc.setFontSize(14);
            doc.text("Attendance Report", 40, 40);
            let tableData = [];
            let tableHeaders = ["NO", "Teacher", "Admission#", "Student", "Date", "Time", "Status"];
            $("#studentTableBodyReport tr").each(function() {
                let tds = $(this).find("td");
                tableData.push([
                    tds.eq(0).text(),
                    tds.eq(1).text(),
                    tds.eq(2).text(),
                    tds.eq(3).text(),
                    tds.eq(4).text(),
                    tds.eq(5).text(),
                    tds.eq(6).text()
                ]);
            });
            doc.autoTable({
                head: [tableHeaders],
                body: tableData,
                startY: 60,
                styles: {
                    fontSize: 10
                }
            });

            doc.save("attendance_report.pdf");
        });

        function GetFeeSettingsData() {}

        let barAttedance = null;

        function BarChartAttendaceReport(GlobalAttendanceData) {
            let present = 0;
            let absent = 0;
            let late = 0;
            var data = GlobalAttendanceData.filter(function(value) {
                if (value.late == 0 && value.status == 1) {
                    present++;
                } else if (value.late == 0 && value.status == 0) {
                    absent++;
                } else if (value.late == 1 && value.status == 1) {
                    late++;
                }
            })
            if (barAttedance !== null) {
                barAttedance.destroy();
            }
            const ctx = document.getElementById('myChartAttendanceReport');
            barAttedance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Present', 'Absent', 'Late'],
                    datasets: [{
                        label: 'Attendance Report',
                        data: [present, absent, late],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 205, 86, 0.2)'
                        ],
                        borderColor: [
                            '#28a745',
                            '#dc3545',
                            '#ffc107'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endsection
