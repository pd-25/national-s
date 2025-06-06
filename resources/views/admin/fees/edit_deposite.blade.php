@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Edit Payment</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.index') }}">Payment</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.viewDownloadDeposite', @$deposite->payment_number)}}">View Payment</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.create') }}">Payment History</a></li>
            <li class="breadcrumb-item active">Edit Payment</li>
        </ol>
    </nav>
</div>
<section>
    <div class="card border-0">
        <div class="card-body pt-4">
            <div class="card-title">
                <h5 class="mb-0">Payment Number : {{@$deposite->payment_number}}</h5>
            </div>
            <form action="{{route('deposite.update', @$deposite->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row my-3">
                    <input type="hidden" name="deposite_id" value="{{@$deposite->id}}">
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id" class="form-select" disabled>
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}" {{@$deposite->session_id == @$item->id ? "selected":""}}>{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select class<span class="text-danger">*</span></label>
                        <select name="class_id" id="class_id" class="form-select" disabled>
                            <option value="">--Select Class--</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}" {{@$deposite->class_id == @$item->id ? "selected":""}}>{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="section_id" class="form-select" onchange="getStudent()" disabled>
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="" class="form-label">Select Student<span class="text-danger">*</span></label>
                        <select name="user_id" id="student_id_bind" class="form-select" disabled>
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <label for="" class="form-label">Select Month<span class="text-danger">*</span></label>
                        <select name="month" id="month" class="form-select">
                            <option value="">--Select Month--</option>
                            @if (!@empty(GetallMonths()))
                                @foreach (GetallMonths() as $item)
                                    <option value="{{@$item}}" {{@$deposite->month == @$item ? "selected":""}}>{{@$item}}</option>
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
                                    <option value="{{@$item}}" {{@$deposite->year == @$item ? "selected":""}}>{{@$item}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12 my-2">
                        <div class="row p-3">
                            <div class="col-8">
                                Admission Charges
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" name="admission_charges" onblur="CountTotalPayment()" id="admission_charges" min="0" class="form-control" value="{{@$deposite->admission_charges}}" >
                                </div>
                            </div>
                            <div class="col-8">
                               Enrolment Fee
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" name="enrolment_fee" onblur="CountTotalPayment()" id="enrolment_fee" min="0" class="form-control" value="{{@$deposite->enrolment_fee}}" >
                                </div>
                            </div>
                            <div class="col-8">
                                Tuition Fee
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="tuition_fee" onblur="CountTotalPayment()" id="tuition_fee" class="form-control" value="{{@$deposite->tuition_fee}}">
                                </div>
                            </div>
                            <div class="col-8">
                                Terminal Fee
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="terminal_fee" onblur="CountTotalPayment()" id="terminal_fee" class="form-control" value="{{@$deposite->terminal_fee}}">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                Sports Fee
                            </div>
                            <div class="col-4 mb-2">
                                <textarea name="sports_comments" class="form-control" id="sports_comments" placeholder="Sports Comments" rows="2">{{@$deposite->sports_comments}}</textarea>
                            </div>
                            <div class="col-4 mb-2">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="sports" onblur="CountTotalPayment()" id="sports" class="form-control" value="{{@$deposite->sports}}">
                                </div>
                            </div>
                            <div class="col-4">
                                Misc, Charges
                            </div>
                            <div class="col-4">
                                <textarea name="misc_charges_comments" class="form-control" id="misc_charges_comments" placeholder=" Misc, Charges Comments" rows="2">{{@$deposite->misc_charges_comments}}</textarea>
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="misc_charges" onblur="CountTotalPayment()" id="misc_charges" class="form-control" value="{{@$deposite->misc_charges}}">
                                </div>
                            </div>
                            <div class="col-8">
                                Identity Card
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. </span>
                                    <input type="number" min="0" name="identity_card" onblur="CountTotalPayment()" id="identity_card" class="form-control" value="{{@$deposite->identity_card}}">
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                Scholarship / Concession
                            </div>
                            <div class="col-4 mb-3">
                                <textarea name="scholarship_concession_comments" class="form-control" id="scholarship_concession_comments" placeholder="Scholarship / Concession Comments" rows="2">{{@$deposite->scholarship_concession_comments}}</textarea>
                            </div>
                            <div class="col-4 mb-3">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs. (-) </span>
                                    <input type="number" min="0" name="scholarship_concession" onblur="CountTotalPayment()" id="scholarship_concession" class="form-control" value="{{@$deposite->scholarship_concession}}">
                                </div>
                            </div>
                            <hr>
                            <div class="col-8">
                                <b>Total</b>
                            </div>
                            <div class="col-4">
                              <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="number" min="0" name="total" value="{{@$deposite->total}}" id="total" class="form-control" >
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Payment Mode<span class="text-danger">*</span></label>
                        <select name="payment_mode" id="payment_mode" onclick="checkPaymentMode(value)" class="form-select">
                            <option value="">--Select Mode--</option>
                            <option value="Online" {{@$deposite->payment_mode == "Online" ? "selected":""}}>Online</option>
                            <option value="Cash" {{@$deposite->payment_mode == "Cash" ? "selected":""}}>Cash</option>
                            <option value="Cheque" {{@$deposite->payment_mode == "Cheque" ? "selected":""}}>Cheque</option>
                        </select>
                    </div>
                    <div class="col-4 mb-2 ChequeShowHide">
                        <label for="" class="form-label">Cheque No</label>
                        <input type="text" class="form-control" name="cheque_no" id="cheque_no" placeholder="Cheque No" value="{{@$deposite->cheque_no}}">
                    </div>
                    <div class="col-4 mb-2 ChequeShowHide">
                        <label for="" class="form-label">Cheque Date</label>
                        <input type="date" class="form-control" name="cheque_date" id="cheque_date" value="{{@$deposite->cheque_date}}">
                    </div>
                    <div class="col-8 mb-2 ChequeShowHide">
                        <label for="" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="{{@$deposite->bank_name}}">
                    </div>
                    <div class="col-4 mb-2 ChequeShowHide">
                        <label for="" class="form-label">Branch</label>
                        <input type="text" class="form-control" name="branch" id="branch" placeholder="Branch" value="{{@$deposite->branch}}">
                    </div>
                    <div class="col-8 mb-2 OnlineShowHide">
                        <label for="" class="form-label">Transaction Id</label>
                        <input type="text" class="form-control" name="transaction_id" id="transaction_id" placeholder="Transaction Id" value="{{@$deposite->transaction_id}}">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary" >Update Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $(".ChequeShowHide").hide();
        $(".OnlineShowHide").hide();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        if(class_id){
            $('#class_id').trigger('change');
            setTimeout(function() {
                $('#section_id').val("{{@$deposite->section_id}}")
                var section_id = $('#section_id').val();
                if(session_id && class_id && section_id){
                    getStudent();
                    setTimeout(function() { 
                        $('#student_id_bind').val("{{@$deposite->user_id}}")
                    }, 2500);
                }
            }, 2500);
        }
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