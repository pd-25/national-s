@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
        <h1>Payment Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Payment Report</li>
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
                            <select name="session_id" id="session_id" class="form-select" onchange="getAllStudent()"
                                required>
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
                        <div class="col-3 mb-2">
                            <label for="" class="form-label">from Date</label>
                            <input class="form-control" type="date" id="from_date" name="from_date" required>
                        </div>
                        <div class="col-3 mb-2">
                            <label for="" class="form-label">To Date</label>
                            <input class="form-control" type="date" id="to_date" name="to_date" required>
                        </div>
                        <div class="col-3 mb-2">
                            <label for="" class="form-label">Payment Mode</label>
                            <select name="payment_mode" id="payment_mode" class="form-select">
                                <option value="All">All</option>
                                <option value="Online">Online</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="col-3 mb-2">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="status_id" class="form-select">
                                <option value="All">All</option>
                                <option value="Completed">Completed</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="col-12 text-end mt-2">
                            <button onclick="filterDepositeReport()" id="SaveButton" type="button"
                                class="btn btn-primary me-2"><i class="bi bi-journal-text"></i> Generate
                                Report</button>
                            <button type="reset" onclick="$('#showFeesReport').hide()" class="btn btn-secondary me-2"><i
                                    class="bi bi-arrow-clockwise"></i>
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
        <div class="card border-0" id="showFeesReport">
            <div class="card-body pt-4">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0 fw-bold text-uppercase">Payment Report</h5>
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
                        <canvas id="myChartPaymentReport"></canvas>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="w-100 table table-bordered table-striped overflow-sc">
                        <thead>
                            <tr class="table-dark">
                                <th>NO</th>
                                <th>Admission#</th>
                                <th>Payment#</th>
                                <th>Name</th>
                                <th>Session</th>
                                <th>Class-Section</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Mobile</th>
                                <th>ModeOfPayment</th>
                                <th>Amount</th>
                                <th>Date</th>
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
            $("#showFeesReport").hide();
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

        function filterDepositeReport() {
            var session_id = $('#session_id').val();
            var section_class = $('#class_id_section_id').val();
            var section_id = section_class.split('_')[0];
            var class_id = section_class.split('_')[1];
            var user_id = $('#report_student_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var payment_mode = $('#payment_mode').val();
            var status_id = $('#status_id').val();

            $("#attendanceLoader").show();
            $("#showFeesReport").hide();

            $.ajax({
                url: "{{ route('report.feesreportshow') }}",
                type: "POST",
                dataType: "json",
                data: {
                    session_id: session_id,
                    class_id: class_id,
                    section_id: section_id,
                    user_id: user_id,
                    from_date: from_date,
                    to_date: to_date,
                    payment_mode: payment_mode,
                    status_id: status_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#attendanceLoader").hide();
                    $("#showFeesReport").show();
                    ChartPaymentReport(response);
                    $("#studentTableBodyReport").empty();
                    let tbody = $("#studentTableBodyReport");
                    $.each(response, function(index, deposite) {

                        var statusHtml = "";
                        if (deposite.status === "Completed") {
                            statusHtml = "<span class='badge text-bg-success'>Paid</span>";
                        } else if (deposite.status === "Pending") {
                            statusHtml = "<span class='badge text-bg-danger'>Unpaid</span>";
                        }

                        // Format date
                        let createdAt = new Date(deposite.created_at).toLocaleDateString('en-GB');

                        let row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${deposite.student_details?.admission_number ?? ""}</td>
                        <td>${deposite.payment_number ?? ""}</td>
                        <td>${deposite.student_details?.student_name ?? ""}</td>
                        <td>${deposite.student_session?.sessions_name ?? ""}</td>
                        <td>${deposite.student_class?.class_name ?? ""}<br>${deposite.student_section?.section_name ?? ""}</td>
                        <td>${deposite.month ?? ""}</td>
                        <td>${deposite.year ?? ""}</td>
                        <td>${deposite.student_details?.mobile_no ?? ""}</td>
                       
                        <td>${deposite.payment_mode ?? ""}</td>
                        <td>${deposite.total_payable ?? ""}</td>
                        <td>${createdAt}</td>
                    </tr>
                `;
                        //  <td>${statusHtml}</td>
                        tbody.append(row);
                    });
                },

                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Something went wrong! Check console for details.");
                }
            });
        }

        // Excel Export
        $('#exportExcel').on('click', function() {
            let rows = [];
            $("#studentTableBodyReport tr").each(function() {
                let tds = $(this).find("td");

                rows.push({
                    "No": tds.eq(0).text().trim(),
                    "Admission Number": tds.eq(1).text().trim(),
                    "Payment Number": tds.eq(2).text().trim(),
                    "Student Name": tds.eq(3).text().trim(),
                    "Session": tds.eq(4).text().trim(),
                    "Class / Section": tds.eq(5).text().trim(),
                    "Month": tds.eq(6).text().trim(),
                    "Year": tds.eq(7).text().trim(),
                    "Mobile": tds.eq(8).text().trim(),
                    "Status": tds.eq(9).text().trim(),
                    "Total Payable": tds.eq(10).text().trim(),
                    "Created Date": tds.eq(11).text().trim()
                });
            });

            var ws = XLSX.utils.json_to_sheet(rows);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Deposit Report");
            XLSX.writeFile(wb, "deposit_report.xlsx");
        });

        $('#exportPdf').on('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            var doc = new jsPDF('l', 'pt', 'a4');

            doc.setFontSize(14);
            doc.text("Deposit Report", 40, 40);

            let headers = [
                "No", "Admission No", "Payment No", "Student", "Session",
                "Class/Section", "Month", "Year", "Mobile", "Status",
                "Payable", "Created Date"
            ];

            let tableData = [];

            $("#studentTableBodyReport tr").each(function() {
                let tds = $(this).find("td");
                tableData.push([
                    tds.eq(0).text().trim(),
                    tds.eq(1).text().trim(),
                    tds.eq(2).text().trim(),
                    tds.eq(3).text().trim(),
                    tds.eq(4).text().trim(),
                    tds.eq(5).text().trim(),
                    tds.eq(6).text().trim(),
                    tds.eq(7).text().trim(),
                    tds.eq(8).text().trim(),
                    tds.eq(9).text().trim(),
                    tds.eq(10).text().trim(),
                    tds.eq(11).text().trim()
                ]);
            });

            doc.autoTable({
                head: [headers],
                body: tableData,
                startY: 60,
                styles: {
                    fontSize: 10
                }
            });

            doc.save("deposit_report.pdf");
        });
        let chartPayment = null;

        function ChartPaymentReport(PayemntData) {
            let cash = 0;
            let online = 0;
            let cheque = 0;
            PayemntData.forEach(function(value) {
                if (value.payment_mode === "Cash") cash++;
                else if (value.payment_mode === "Online") online++;
                else if (value.payment_mode === "Cheque") cheque++;
            });

            if (chartPayment !== null) {
                chartPayment.destroy();
            }
            const ctx = document.getElementById('myChartPaymentReport');
            chartPayment = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Cash', 'Online', 'Cheque'],
                    datasets: [{
                        label: 'Payment Report',
                        data: [cash, online, cheque],
                        backgroundColor: [
                            'rgb(75, 192, 75)',
                            'rgb(255, 99, 132)',
                            'rgb(255, 193, 7)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }



        function GetFeeSettingsData() {}
    </script>
@endsection
