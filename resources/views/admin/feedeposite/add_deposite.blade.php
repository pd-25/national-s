@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Add Fee Deposite</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add Fee Deposite</li>
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
                                    <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select class<span class="text-danger">*</span></label>
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
                        <select name="section_id" id="section_id" class="form-select" onchange="getStudent()">
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Student<span class="text-danger">*</span></label>
                        <select name="user_id" id="student_id_bind" class="form-select">
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-2 mb-2">
                        <label for="" class="form-label">Student Roll<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="student_roll" id="student_roll" placeholder="Roll">
                    </div>
                    <div class="col-3 mb-2">
                        <label for="" class="form-label">Select Month<span class="text-danger">*</span></label>
                        <select name="month" id="month" class="form-select">
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
    $(document).ready(function() {
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
</script>
@endsection