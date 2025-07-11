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
            <form action="{{route('deposite.store')}}" method="post">
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
                        <select name="section_id" id="section_id" class="form-select" onchange="getStudent(); GetFeeSettingsData()">
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="" class="form-label">Select Student<span class="text-danger">*</span></label>
                        <select name="user_id" id="student_id_bind" class="form-select js-example-basic-single" onchange="GetPaymentHistoryOfStudent();GetStudentFeeSettingsData();">
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <label for="" class="form-label">Select Month<span class="text-danger">*</span></label>
                        <select name="month" id="month" class="form-select" onchange="GetFeeSettingsData();GetStudentFeeSettingsData()">
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
                        <select name="year" id="year" class="form-select">
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
                                        <th>No.</th>
                                        <th>Student</th>
                                        <th>Payment No</th>
                                        <th>Month - Year</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="col-12 my-2">
                        <div class="row p-3" id="BindFeesPayment">
                            @if (!@empty(GetPayrollComponent('all_fee_settings')))
                                @foreach (GetPayrollComponent('all_fee_settings') as $index => $item)
                                    @if (@$item->parent_id == null)
                                        <div class="col-8 d-flex align-items-center border">
                                            <b>{{@$item->name}}</b>
                                        </div>
                                        <div class="col-4 border">
                                            <div class="input-group my-1">
                                                <span class="input-group-text">
                                                    @if ($item->type == 'Allowances')
                                                    Rs.
                                                    @else
                                                    Rs. (-)
                                                    @endif 
                                                </span>
                                                <input type="number" min="0" name="amount[{{ @$item->id }}]" onblur="CountTotalPayment()" id="amount_{{ @$item->id }}" class="form-control" >
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            @if (!@empty(GetPayrollComponent('all_fee_settings')))
                                @foreach (GetPayrollComponent('all_fee_settings') as $index => $item)
                                    @if (@$item->parent_id)
                                        @if (@$item->parent->id == @$item->parent_id)
                                            <div class="col-4 mt-3">
                                                <textarea name="comments[{{@$item->id}}]" class="form-control" id="comments_{{ @$item->id }}" placeholder="{{@$item->parent->name}} Comments" rows="2"></textarea>
                                            </div> 
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="col-8">
                        <h5 class="fw-bold">Total Payable</h5>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rs. </span>
                            <input type="text" min="0" name="total_payable" readonly id="total_payable" class="form-control" >
                        </div>
                    </div>
                    <hr>
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
    var toatlPayableForFee = {};
    var toatlPayableForStudentFee = {};
    var allFeeComponent = @json(GetPayrollComponent('all_fee_settings'));
    $(document).ready(function() {
        $(".ChequeShowHide").hide();
        $(".OnlineShowHide").hide();
        let searchParams = new URLSearchParams(window.location.search)
        var session_id = searchParams.get('session_id');
        var class_id = searchParams.get('class_id');
        var section_id = searchParams.get('section_id');
        var student_id = searchParams.get('student_id');
        var currentDate = new Date();
        var fullMonthName = currentDate.toLocaleString('default', { month: 'long' });
        var month = searchParams.get('month') != null ? searchParams.get('month') : fullMonthName;
        var year = searchParams.get('year')!= null ? searchParams.get('year') : new Date().getFullYear();
        if(session_id){
            $("#session_id").val(session_id);
            $("#month").val(month);
            $("#year").val(year);
            if(class_id){
                $("#class_id").val(class_id);
                $('#class_id').trigger('change');
                $(document).one('sectionsLoaded', function () {
                    if (section_id) {
                        $("#section_id").val(section_id);
                        getStudent().then(function () {
                            if (student_id) {
                                $("#student_id_bind").val(student_id).trigger('change');
                                GetPaymentHistoryOfStudent();
                                GetStudentFeeSettingsData();
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
                            status = "<span class='badge text-bg-success'>Paid</span>"
                        }else if(deposite.status == "Pending"){
                            status = "<span class='badge text-bg-danger'>Unpaid</span>"
                        }
                        table.row.add([
                            index + 1,
                            deposite.student_name + '<br>' + deposite.student_details.admission_number,
                            '<b>'+ deposite.payment_number + '</b>',
                            deposite.month + ' / '+ deposite.year,
                            status,
                            "<span class='fw-bold text-danger'>"+deposite.total_payable+"</span>",
                            new Date(deposite.created_at).toLocaleDateString('en-UK', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }),

                        ])
                        // `<a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="EditDeposite(\'' + deposite.payment_number + '\')"><i class="bi bi-pencil-square"></i> </a> <a class="btn btn-success btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="ViewDeposite(\'' + deposite.payment_number + '\')"><i class="bi bi-eye-fill"></i></a>
                        // <a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deleteDeposite(\'' + deposite.id + '\')"><i class="bi bi-trash"></i></a>`
                    });
                    table.draw();
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    }

    ///................................................///

    function GetFeeSettingsData() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var month = $('#month').val();
        if (session_id && class_id && section_id && month) {
            $.ajax({
                url: "{{route('paymentsettings.show')}}",
                type: 'get',
                data: {
                    session_id: session_id,
                    class_id: class_id,
                    section_id: section_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toatlPayableForFee = {};
                    if (!response || response.length === 0) {
                        $("[id^='amount_']").val('');
                        GetStudentFeeSettingsData();
                        CountTotalPayment();
                        return;
                    }else{
                        $.each(response, function(index, feesetting) {
                            var chargesAmount = JSON.parse(feesetting.charges_amount);
                            var monthsValidation = JSON.parse(feesetting.months_validation);
                            $.each(chargesAmount, function(i, chargeAmount) {
                                var inputSelector = "#amount_" + i;
                                if (monthsValidation[i] && monthsValidation[i].includes(month)) {
                                    $(inputSelector).val(''); 
                                    $(inputSelector).val(chargeAmount);
                                    delete toatlPayableForFee[i];
                                    toatlPayableForFee[i] = chargeAmount;
                                    // $(inputSelector).prop('readonly', true);
                                }else{
                                    $(inputSelector).val(''); 
                                    // $(inputSelector).prop('readonly', false);
                                }
                            });
                        });
                    }
                    CountTotalPayment();
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }else{
            Notiflix.Notify.Failure("Please select session, class, section and month");
        }
    }

    function GetStudentFeeSettingsData() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var user_id = $('#student_id_bind').val();
        var month = $('#month').val();
        if (session_id && class_id && section_id && user_id && month) {
            $.ajax({
                url: "{{route('studentFeeSettings.show')}}",
                type: 'get',
                data: {
                    session_id: session_id,
                    class_id: class_id,
                    section_id: section_id,
                    user_id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toatlPayableForStudentFee = {}
                    if (!response || response.length === 0) {
                        $("[id^='amount_']").val('');
                        GetFeeSettingsData();
                        CountTotalPayment();
                        return;
                    }else{
                        $.each(response, function(index, student_feesetting) {
                            var chargesAmount = JSON.parse(student_feesetting.charges_amount);
                            var monthsValidation = JSON.parse(student_feesetting.months_validation);
                            $.each(chargesAmount, function(i, chargeAmount) {
                                var inputSelector = "#amount_" + i;
                                if (monthsValidation[i] && monthsValidation[i].includes(month)) {
                                    $(inputSelector).val(''); 
                                    $(inputSelector).val(chargeAmount);
                                    delete toatlPayableForStudentFee[i];
                                    toatlPayableForStudentFee[i] = chargeAmount;
                                    // $(inputSelector).prop('readonly', true);
                                }else{
                                    $(inputSelector).val(''); 
                                    // $(inputSelector).prop('readonly', false);
                                }
                            });
                        });
                    }
                    CountTotalPayment();
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    }

    function CountTotalPayment(){
        // let toatlPayable = Object.assign({}, toatlPayableForFee, toatlPayableForStudentFee);
        // if(paramKey && paramVal)
        // {
        //     toatlPayable[paramKey] = paramVal;
        // }else{
        //     toatlPayable[paramKey] = 0;
        // }
        // var matchedFees = allFeeComponent
        // .filter(item => toatlPayable.hasOwnProperty(item.id))
        // .map(item => ({
        //     id: item.id,
        //     name: item.name,
        //     type: item.type,
        //     amount: Number(toatlPayable[item.id])
        // }));

        // console.log(matchedFees);
        
        // var total = 0;
        // allFeeComponent.forEach((value, key) => {
        //     if(value.type == "Allowances"){
        //         total += $("#amount_"+value.id).val();
        //         // total += Number(value.amount);
        //     }else if(value.type == "Deductions"){
        //         // total -= Number(value.amount);
        //         total -= $("#amount_"+value.id).val();
        //     }
        // });
        // $("#total_payable").val(total.toFixed(2));

        var total = 0;
        allFeeComponent.forEach((value, key) => {
            let amount = Number($("#amount_" + value.id).val()) || 0;
            if (value.type === "Allowances") {
                total += amount;
            } else if (value.type === "Deductions") {
                total -= amount;
            }
        });
        $("#total_payable").val(total.toFixed(2));
    }
</script>
@endsection