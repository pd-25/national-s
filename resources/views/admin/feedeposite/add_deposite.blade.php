@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Fees Payment</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.create') }}">Payment History</a></li>
            <li class="breadcrumb-item active">Payment</li>
        </ol>
    </nav>
</div>
<section>
    <div class="card border-0">
        <div class="card-body pt-4">
            <form action="" method="post">
                @csrf
                <div class="row my-3">
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id" class="form-select">
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}" {{$item->status == 1 ? 'selected': ''}}>{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Class<span class="text-danger">*</span></label>
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
                        <select name="section_id" id="section_id" class="form-select" onchange="getStudent();">
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="" class="form-label">Select Student<span class="text-danger">*</span></label>
                        <select name="user_id" id="student_id_bind" class="form-select js-example-basic-single" onchange="GetPaymentSettingsData();GetPaymentHistoryOfStudent();">
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <label for="" class="form-label">Select Month<span class="text-danger">*</span></label>
                        <select name="month" id="month" class="form-select" onchange="GetPaymentSettingsData()">
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
                        <select name="year" id="year" class="form-select" onchange="GetPaymentSettingsData()">
                            <option value="">--Select Year--</option>
                            @if (!@empty(LastFiveYear()))
                                @foreach (LastFiveYear() as $item)
                                    <option value="{{@$item}}" {{$item == date('Y') ? "selected": ""}}>{{@$item}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12 my-2">
                        <h5>Current Session Payment Details</h5>
                        <div class="table-wrapper" style="max-height: 250px; overflow-y: auto;">
                            <table class="table table-bordered table-striped table-sm table-fixed-header" id="DataTables">
                                <thead>
                                    <tr class="table-primary" >
                                        <th>Sl</th>
                                        <th>Student</th>
                                        <th>Payment No</th>
                                        <th>Month - Year</th>
                                        <th>Status</th>
                                        <th>Admission Charges</th>
                                        <th>Enrolment Fee</th>
                                        <th>Tuition Fee</th>
                                        <th>Terminal Fee</th>
                                        <th>Sports</th>
                                        <th>Misc, Charges</th>
                                        <th>Identity Card</th>
                                        <th>Scholarship / Concession</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <div class="row p-3">
                            <div class="col-8">
                                Admission Charges
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" name="admission_charges" onblur="CountTotalPayment()" id="admission_charges" min="0" class="form-control" >
                                </div>
                            </div>
                            <div class="col-8">
                               Enrolment Fee
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" name="enrolment_fee" onblur="CountTotalPayment()" id="enrolment_fee" min="0" class="form-control" >
                                </div>
                            </div>
                            <div class="col-8">
                                Tuition Fee
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="tuition_fee" onblur="CountTotalPayment()" id="tuition_fee" class="form-control" >
                                </div>
                            </div>
                            <div class="col-8">
                                Terminal Fee
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="terminal_fee" onblur="CountTotalPayment()" id="terminal_fee" class="form-control" >
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                Sports Fee
                            </div>
                            <div class="col-4 mb-2">
                                <textarea name="sports_comments" class="form-control" id="sports_comments" placeholder="Sports Comments" rows="2"></textarea>
                            </div>
                            <div class="col-4 mb-2">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="sports" onblur="CountTotalPayment()" id="sports" class="form-control" >
                                </div>
                            </div>
                            <div class="col-4">
                                Misc, Charges
                            </div>
                            <div class="col-4">
                                <textarea name="misc_charges_comments" class="form-control" id="misc_charges_comments" placeholder=" Misc, Charges Comments" rows="2"></textarea>
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="misc_charges" onblur="CountTotalPayment()" id="misc_charges" class="form-control" >
                                </div>
                            </div>
                            <div class="col-8">
                                Identity Card
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="identity_card" onblur="CountTotalPayment()" id="identity_card" class="form-control" >
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                Scholarship / Concession
                            </div>
                            <div class="col-4 mb-3">
                                <textarea name="scholarship_concession_comments" class="form-control" id="scholarship_concession_comments" placeholder="Scholarship / Concession Comments" rows="2"></textarea>
                            </div>
                            <div class="col-4 mb-3">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. (-) </span>
                                    <input type="number" min="0" name="scholarship_concession" onblur="CountTotalPayment()" id="scholarship_concession" class="form-control" >
                                </div>
                            </div>
                            <hr>
                            <div class="col-8">
                                <b>Total</b>
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="total" id="total" class="form-control" >
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Payment Mode<span class="text-danger">*</span></label>
                        <select name="payment_mode" id="payment_mode" onclick="checkPaymentMode(value)" class="form-select">
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
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success" >Pay Now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    var table;
    $(document).ready(function() {
        $(".ChequeShowHide").hide();
        $(".OnlineShowHide").hide();
        let searchParams = new URLSearchParams(window.location.search)
        var session_id = searchParams.get('session_id');
        var class_id = searchParams.get('class_id');
        var section_id = searchParams.get('section_id');
        var student_id = searchParams.get('student_id');
        if(session_id){
            $("#session_id").val(session_id);
            if(class_id){
                $("#class_id").val(class_id);
                $('#class_id').trigger('change');
                $(document).one('sectionsLoaded', function () {
                    if (section_id) {
                        $("#section_id").val(section_id);
                        getStudent().then(function () {
                            if (student_id) {
                                $("#student_id_bind").val(student_id).trigger('change');
                            }
                        });
                    }
                });
            }
        }
        $('.js-example-basic-single').select2();

        table = $('#DataTables').DataTable({
            bLengthChange: true,
            "lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
            "iDisplayLength": 50,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false
        });
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

    function GetPaymentHistoryOfStudent(){
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var user_id = $('#student_id_bind').val();
        if (session_id && class_id && section_id && user_id) {
            $.ajax({
                url: "{{route('deposite.show')}}",
                type: 'post',
                data:{
                    session_id:session_id,
                    class_id:class_id,
                    section_id:section_id,
                    user_id:user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    table.clear();
                    $.each(response, function(index, deposite) {
                        var status;
                        if(deposite.status == "Completed"){
                            status = "<span class='text-success'>Completed</span>"
                        }else if(deposite.status == "Pending"){
                            status = "<span class='text-primary'>Pending</span>"
                        }
                        table.row.add([
                            index + 1,
                            deposite.student_name + '<br>' + deposite.student_details.admission_number,
                            '<b>'+ deposite.payment_number + '</b>',
                            deposite.month + ' / '+ deposite.year,
                            status,
                            deposite.admission_charges != null ? deposite.admission_charges : 0,
                            deposite.enrolment_fee != null ? deposite.enrolment_fee: 0,
                            deposite.tuition_fee != null ? deposite.tuition_fee: 0,
                            deposite.terminal_fee != null ? deposite.terminal_fee: 0,
                            deposite.sports != null ? deposite.sports: 0,
                            deposite.misc_charges != null ? deposite.misc_charges: 0,
                            deposite.identity_card != null ? deposite.identity_card : 0,
                            deposite.scholarship_concession != null ? '-' + deposite.scholarship_concession : 0,

                            deposite.total,
                            new Date(deposite.created_at).toLocaleDateString('en-UK', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }),
                            '<a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="EditDeposite(\'' + deposite.payment_number + '\')"><i class="bi bi-pencil-square"></i> </a> <a class="btn btn-success btn-sm rounded-pill" href="javascript:void(0)" onclick="ViewDeposite(\'' + deposite.payment_number + '\')"><i class="bi bi-eye-fill"></i></a>' + 
                            '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteDeposite(\'' + deposite.id + '\')"><i class="bi bi-trash"></i></a>'
                        ])
                    });
                    table.draw();
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    }

    function GetPaymentSettingsData(){
        $('#admission_charges').val('');
        $('#enrolment_fee').val('');
        $('#tuition_fee').val('');
        $('#terminal_fee').val('');
        $('#sports').val('');
        $('#misc_charges').val('');
        $('#scholarship_concession').val('');

        var month = $('#month').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var user_id = $('#student_id_bind').val();
        if (session_id && class_id && section_id && user_id) {
            $.ajax({
                url: "{{route('paymentsettings.create')}}",
                type: 'get',
                data:{
                    session_id:session_id,
                    class_id:class_id,
                    section_id:section_id,
                    user_id:user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var data = response;
                    if(data != null){
                        var admission_charges = 0;
                        var enrolment_fee =0;
                        var tuition_fee=0;
                        var terminal_fee=0;
                        var sports=0;
                        var misc_charges=0;
                        var scholarship_concession=0;

                        if(response.admission_charges_months_validation){
                            var admission_charges_months =  JSON.parse(response.admission_charges_months_validation);
                            $.each(admission_charges_months, function (key, val) {
                                if(month == val){
                                    admission_charges = data.admission_charges;
                                    $('#admission_charges').val(data.admission_charges);
                                }
                            });
                        }
                        
                        if(response.enrolment_fee_months_validation){
                            var enrolment_fee_months =  JSON.parse(response.enrolment_fee_months_validation);
                            $.each(enrolment_fee_months, function (key, val) {
                                if(month == val){
                                    enrolment_fee = data.enrolment_fee;
                                    $('#enrolment_fee').val(data.enrolment_fee);
                                }
                            });
                        }

                        if(response.tuition_fee_months_validation){
                            var tuition_fee_months =  JSON.parse(response.tuition_fee_months_validation);
                            $.each(tuition_fee_months, function (key, val) {
                                if(month == val){
                                    tuition_fee = data.tuition_fee;
                                    $('#tuition_fee').val(data.tuition_fee);
                                }
                            });
                        }


                        if(response.terminal_fee_months_validation){
                            var terminalMonth =  JSON.parse(response.terminal_fee_months_validation);
                            $.each(terminalMonth, function (key, val) {
                                if(month == val){
                                    terminal_fee = data.terminal_fee;
                                    $('#terminal_fee').val(data.terminal_fee);
                                }
                            });
                        }

                        if(response.sports_months_validation){
                            var sportsMonth =  JSON.parse(response.sports_months_validation);
                            $.each(sportsMonth, function (key, val) {
                                if(month == val){
                                    sports = data.sports;
                                    $('#sports').val(data.sports);
                                }
                            });
                        }

                        if(response.misc_charges_months_validation){
                            var misc_charges_months =  JSON.parse(response.misc_charges_months_validation);
                            $.each(misc_charges_months, function (key, val) {
                                if(month == val){
                                    misc_charges = data.misc_charges;
                                    $('#misc_charges').val(data.misc_charges);
                                }
                            });
                        }

                        if(response.scholarship_concession_validation){
                            var scholarship_concession =  JSON.parse(response.scholarship_concession_validation);
                            $.each(scholarship_concession, function (key, val) {
                                if(month == val){
                                    scholarship_concession = data.scholarship_concession;
                                    $('#scholarship_concession').val(data.scholarship_concession);
                                }
                            });
                        }
                        var total =
                            safeParse(admission_charges) +
                            safeParse(enrolment_fee) +
                            safeParse(tuition_fee) +
                            safeParse(terminal_fee) +
                            safeParse(sports) +
                            safeParse(misc_charges) +
                            safeParse(identity_card) -
                            safeParse(scholarship_concession);
                        $("#total").val(total.toFixed(2));
                    }
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    }

    function CountTotalPayment(){
        var admission_charges = parseFloat($("#admission_charges").val()) || 0;
        var enrolment_fee = parseFloat($("#enrolment_fee").val()) || 0;
        var tuition_fee = parseFloat($("#tuition_fee").val()) || 0;
        var terminal_fee = parseFloat($("#terminal_fee").val()) || 0;
        var sports = parseFloat($("#sports").val()) || 0;
        var misc_charges = parseFloat($("#misc_charges").val()) || 0;
        var identity_card = parseFloat($("#identity_card").val()) || 0;
        var scholarship_concession = parseFloat($("#scholarship_concession").val()) || 0;
        var total = ((admission_charges + enrolment_fee + tuition_fee + terminal_fee + sports + misc_charges + identity_card) - scholarship_concession);
        $("#total").val(total.toFixed(2));
    }
</script>
@endsection