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
                        <select name="month" id="month" class="form-select" disabled>
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
                        <select name="year" id="year" class="form-select" disabled>
                            <option value="">--Select Year--</option>
                            @if (!@empty(LastFiveYear()))
                                @foreach (LastFiveYear() as $item)
                                    <option value="{{@$item}}" {{@$deposite->year == @$item ? "selected":""}}>{{@$item}}</option>
                                @endforeach
                            @endif
                        </select>
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
                                                <input type="number" min="0" name="amount[{{ @$item->id }}]" onblur="CountTotalPayment({{@$item->id}},value)" id="amount_{{ @$item->id }}" class="form-control" >
                                            </div>
                                        </div>
                                    @endif
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
    var allFeeComponent = @json(GetPayrollComponent('all_fee_settings'));
    var toatlPayableDatabase = JSON.parse(@json($deposite->amount));
    var allComments = JSON.parse(@json($deposite->comments));

    $(document).ready(function() {
        $(".ChequeShowHide").hide();
        $(".OnlineShowHide").hide();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        checkPaymentMode("{{@$deposite->payment_mode}}");
        var depositSectionId = "{{@$deposite->section_id}}";
        var depositUserId = "{{@$deposite->user_id}}";
        if(class_id){
            $("#class_id").val(class_id);
            $('#class_id').trigger('change');
            $(document).one('sectionsLoaded', function () {
                if (depositSectionId) {
                    $("#section_id").val(depositSectionId);
                    getStudent().then(function () {
                        if (depositUserId) {
                            $("#student_id_bind").val(depositUserId).trigger('change');
                        }
                    });
                }
            });
        }
        $('.js-example-basic-single').select2();

     
        $.each(toatlPayableDatabase, function(i, chargeAmount) {
            var inputSelector = "#amount_" + i;
            $(inputSelector).val(''); 
            $(inputSelector).val(chargeAmount);
        });
        $.each(allComments, function(i, comment) {
            var inputSelector = "#comments_" + i;
            $(inputSelector).val(''); 
            $(inputSelector).val(comment);
        });
        CountTotalPayment();
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

    function GetFeeSettingsData(){
        //This for not getting error
    }

    function CountTotalPayment(paramKey, paramVal){
        // let toatlPayable = toatlPayableDatabase;
        // if(paramKey && paramVal)
        // {
        //     toatlPayable[paramKey] = paramVal;
        // }else{
        //     toatlPayable[paramKey] = 0;
        // }
        // const matchedFees = allFeeComponent
        // .filter(item => toatlPayable.hasOwnProperty(item.id))
        // .map(item => ({
        //     id: item.id,
        //     name: item.name,
        //     type: item.type,
        //     amount: Number(toatlPayable[item.id])
        // }));
        
        // var total = 0;
        // matchedFees.forEach((value, key) => {
        //     if(value.type == "Allowances"){
        //         total += Number(value.amount);
        //     }else if(value.type == "Deductions"){
        //         total -= Number(value.amount);
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