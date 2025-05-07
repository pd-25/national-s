@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Fees Payment Settings</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.index') }}">Payment</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.create') }}">Payment History</a></li>
            <li class="breadcrumb-item active">Payment Settings</li>
        </ol>
    </nav>
</div>
<section>
    <div class="card border-0 mb-3">
        <div class="card-body pt-4">
            <form id="formData" action="{{route('paymentsettings.store')}}" method="post">
                @csrf
                <div class="row my-3">
                    <input type="hidden" id="payment_setting_id" name="payment_setting_id" value="">
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id" class="form-select">
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}" {{$item->status == 1 ? 'selected': ''}}>{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('session_id'))
                            <span class="text-danger">{{ $errors->first('session_id') }}</span>
                        @endif
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
                        @if ($errors->has('class_id'))
                            <span class="text-danger">{{ $errors->first('class_id') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="section_id" class="form-select" onchange="getStudent();GetSessionPaymentSettingsData()">
                            <option value="">--Select Section--</option>
                        </select>
                        @if ($errors->has('section_id'))
                            <span class="text-danger">{{ $errors->first('section_id') }}</span>
                        @endif
                    </div><div class="col-4 my-3">
                        <label for="" class="form-label fw-bold">Apply To All Student</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="applyallstudent" name="apply_to_all" id="checkapplyallstudent" checked>
                            <label class="form-check-label" for="checkapplyallstudent">
                              Apply
                            </label>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="" class="form-label ">Select Student<span class="text-danger">*</span></label>
                        <select name="user_id" id="student_id_bind" class="form-select js-example-basic-single ">
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-12 mb-3 border rounded p-3 bg-color-items">
                                <div class="row">
                                    <div class="col-8">
                                        <h6>Admission Charges</h6> 
                                     </div>
                                    <div class="col-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="admission_charges" id="admission_charges" class="form-control" value="{{old('admission_charges')}}">
                                        </div>
                                        @if ($errors->has('admission_charges'))
                                            <span class="text-danger">{{ $errors->first('admission_charges') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <label class="fw-bold" for="">Admission Charges (Visiable Month)</label>
                                <br>
                                @if (!@empty(GetallMonths()))
                                    @foreach (GetallMonths() as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="admission_charges_months_validation[]" id="{{@$item}}_ac" value="{{@$item}}">
                                            <small class="form-check-label" for="{{@$item}}">{{@$item}}</small>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('admission_charges_months_validation'))
                                <span class="text-danger">{{ $errors->first('admission_charges_months_validation') }}</span>
                                @endif
                            </div>
                            <div class="col-12 mb-3 border rounded p-3 bg-color-items">
                                <div class="row">
                                    <div class="col-8">
                                        <h6>Enrolment Fee</h6> 
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="enrolment_fee" id="enrolment_fee" class="form-control" value="{{old('enrolment_fee')}}">
                                        </div>
                                        @if ($errors->has('enrolment_fee'))
                                            <span class="text-danger">{{ $errors->first('enrolment_fee') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <label class="fw-bold" for="">Enrolment Fee (Visiable Month)</label>
                                <br>
                                @if (!@empty(GetallMonths()))
                                    @foreach (GetallMonths() as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="enrolment_fee_months_validation[]" id="{{@$item}}_ef" value="{{@$item}}">
                                            <small class="form-check-label" for="{{@$item}}">{{@$item}}</small>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('enrolment_fee_months_validation'))
                                <span class="text-danger">{{ $errors->first('enrolment_fee_months_validation') }}</span>
                                @endif
                            </div>
                            <div class="col-12 mb-3 border rounded p-3 bg-color-items">
                                <div class="row">
                                    <div class="col-8">
                                        <h6>Tuition Fee</h6> 
                                    </div>
                                    <div class="col-4">
                                      <div class="input-group">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="tuition_fee" id="tuition_fee" class="form-control" value="{{old('enrolment_fee')}}">
                                        </div>
                                        @if ($errors->has('tuition_fee'))
                                            <span class="text-danger">{{ $errors->first('tuition_fee') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <label class="fw-bold" for="">Tuition Fee (Visiable Month)</label>
                                <br>
                                @if (!@empty(GetallMonths()))
                                    @foreach (GetallMonths() as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="tuition_fee_months_validation[]" id="{{@$item}}_tuitf" value="{{@$item}}">
                                            <small class="form-check-label" for="{{@$item}}">{{@$item}}</small>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('tuition_fee_months_validation'))
                                <span class="text-danger">{{ $errors->first('tuition_fee_months_validation') }}</span>
                                @endif
                            </div>
                            <div class="col-12 mb-3 border rounded p-3 bg-color-items">
                                <div class="row">
                                    <div class="col-8">
                                       <h6>Terminal Fee</h6> 
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="terminal_fee" id="terminal_fee" value="{{old('terminal_fee')}}" class="form-control" >
                                        </div>
                                        @if ($errors->has('terminal_fee'))
                                            <span class="text-danger">{{ $errors->first('terminal_fee') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <label class="fw-bold" for="">Terminal Fee (Visiable Month)</label>
                                <br>
                                @if (!@empty(GetallMonths()))
                                    @foreach (GetallMonths() as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="terminal_fee_months_validation[]" id="{{@$item}}_tf" value="{{@$item}}">
                                            <small class="form-check-label" for="{{@$item}}">{{@$item}}</small>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('terminal_fee_months_validation'))
                                    <span class="text-danger">{{ $errors->first('terminal_fee_months_validation') }}</span>
                                @endif
                            </div>
                            <div class="col-12 mb-3 border rounded p-3 bg-color-items">
                                <div class="row">
                                    <div class="col-8 mb-3">
                                        <h6>Sports Fee</h6> 
                                    </div>
                                    <div class="col-4 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="sports" id="sports" value="{{old('sports')}}" class="form-control" >
                                        </div>
                                        @if ($errors->has('sports'))
                                            <span class="text-danger">{{ $errors->first('sports') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <label class="fw-bold" for="">Sports Fee (Visiable Month)</label>
                                <br>
                                @if (!@empty(GetallMonths()))
                                    @foreach (GetallMonths() as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="sports_months_validation[]" id="{{@$item}}_sf" value="{{@$item}}">
                                            <small class="form-check-label" for="{{@$item}}">{{@$item}}</small>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('sports_months_validation'))
                                    <span class="text-danger">{{ $errors->first('sports_months_validation') }}</span>
                                @endif
                            </div>
                            <div class="col-12 mb-3 border rounded p-3 bg-color-items">
                                <div class="row">
                                    <div class="col-8 mb-3">
                                        <h6>Misc, Charges</h6> 
                                    </div>
                                    <div class="col-4 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="misc_charges" id="misc_charges"  value="{{old('misc_charges')}}"  class="form-control" >
                                        </div>
                                        @if ($errors->has('misc_charges'))
                                            <span class="text-danger">{{ $errors->first('misc_charges') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <label class="fw-bold" for="">Misc, Charges (Visiable Month)</label>
                                <br>
                                @if (!@empty(GetallMonths()))
                                    @foreach (GetallMonths() as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="misc_charges_months_validation[]" id="{{@$item}}_msc" value="{{@$item}}">
                                            <small class="form-check-label" for="{{@$item}}">{{@$item}}</small>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('misc_charges_months_validation'))
                                    <span class="text-danger">{{ $errors->first('misc_charges_months_validation') }}</span>
                                @endif
                            </div>
                            <div class="col-12 mb-2 border rounded p-3 bg-color-items">
                                <div class="row">
                                    <div class="col-8">
                                        <h6>Scholarship / Concession</h6>
                                    </div>
                                    <div class="col-4">
                                      <div class="input-group">
                                            <span class="input-group-text">Rs. </span>
                                            <input type="number" min="0" name="scholarship_concession" value="{{old('scholarship_concession')}}" id="scholarship_concession" class="form-control" >
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <label class="fw-bold" for="">Scholarship / Concession (Visiable Month)</label>
                                <br>
                                @if (!@empty(GetallMonths()))
                                    @foreach (GetallMonths() as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="scholarship_concession_validation[]" id="{{@$item}}_sc" value="{{@$item}}">
                                            <small class="form-check-label" for="{{@$item}}">{{@$item}}</small>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('scholarship_concession_validation'))
                                    <span class="text-danger">{{ $errors->first('scholarship_concession_validation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" id="add_payment_settings" class="btn btn-success" >Add Payment Settings</button>
                        <button type="submit" id="update_payment_settings" class="btn btn-primary" >Update Payment Settings</button>
                        <button type="reset" class="btn btn-secondary" onclick="resetdata()" >Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <h5>Payment Settings</h5>
            <div class="table-wrapper" style="max-height: 700px; overflow-y: auto;">
                <table class="table table-borderless table-striped table-sm table-fixed-header" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th>Sl</th>
                            <th>Session</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Student</th>
                            <th>Admission Charges</th>
                            <th>Enrolment Fee</th>
                            <th>Tuition Fee</th>
                            <th>Terminal Fee</th>
                            <th>Sports Fee</th>
                            <th>Misc, Charges</th>
                            <th>Scholarship/Concession Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    var table;
    $(document).ready(function() {
        $("#add_payment_settings").show();
        $("#update_payment_settings").hide();
        table = $('#DataTables').DataTable({
            bLengthChange: true,
            "lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
            "iDisplayLength": 50,
            bInfo: false,
            responsive: true,
            "bAutoWidth": false
        });
    });

    function resetdata(){
        $("#add_payment_settings").show();
        $("#update_payment_settings").hide();
        var allMonths = @json(GetallMonths());
        $.each(allMonths, function (index, month) {
            $('#'+month+'_ac').prop('checked', false);
            $('#'+month+'_ef').prop('checked', false);
            $('#'+month+'_tuitf').prop('checked', false);
            $('#' + month + '_tf').prop('checked', false);
            $('#' + month + '_sf').prop('checked', false);
            $('#'+month+'_msc').prop('checked', false);
            $('#'+month+'_sc').prop('checked', false);
        });
    }

    function GetSessionPaymentSettingsData() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        if (session_id && class_id && section_id) {
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
                    table.clear();

                    $.each(response, function(index, payemtsetting) {
                        var encoded = JSON.stringify(payemtsetting)
                            .replace(/\\/g, '\\\\')
                            .replace(/'/g, "\\'")
                            .replace(/"/g, '&quot;');
                        var concession = payemtsetting.scholarship_concession != null ? payemtsetting.scholarship_concession : '0';
                        var concessionValidation = payemtsetting.scholarship_concession_validation != null ? JSON.parse(payemtsetting.scholarship_concession_validation) : ' ';
                        table.row.add([
                            index + 1,
                            payemtsetting.student_session.sessions_name,
                            payemtsetting.student_class.class_name,
                            payemtsetting.student_section.section_name,
                            payemtsetting.student_details.student_name,
                            payemtsetting.admission_charges + '<br><b>' + JSON.parse(payemtsetting.admission_charges_months_validation) + '</b>',
                            payemtsetting.enrolment_fee + '<br><b>' + JSON.parse(payemtsetting.enrolment_fee_months_validation) + '</b>',
                            payemtsetting.tuition_fee + '<br><b>' + JSON.parse(payemtsetting.tuition_fee_months_validation) + '</b>',
                            payemtsetting.terminal_fee + '<br><b>' + JSON.parse(payemtsetting.terminal_fee_months_validation) + '</b>',
                            payemtsetting.sports + '<br><b>' + JSON.parse(payemtsetting.sports_months_validation) + '</b>',
                            payemtsetting.misc_charges + '<br><b>' + JSON.parse(payemtsetting.misc_charges_months_validation) + '</b>',
                            concession + '<br><b>' + concessionValidation + '</b>',
                            '<a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="EditPaymentSettings(JSON.parse(\'' + encoded + '\'))"><i class="bi bi-pencil-square"></i></a>' +
                            '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deletePaymentSettings(\'' + payemtsetting.id + '\')"><i class="bi bi-trash"></i></a>'
                        ]);
                    });

                    table.draw();
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    }

    function EditPaymentSettings(data){
        $('#payment_setting_id').val(data.id);
        $('#admission_charges').val(data.admission_charges);
        $('#enrolment_fee').val(data.enrolment_fee);
        $('#tuition_fee').val(data.tuition_fee);
        $('#terminal_fee').val(data.terminal_fee);
        $('#sports').val(data.sports);
        $('#misc_charges').val(data.misc_charges);
        $('#scholarship_concession').val(data.scholarship_concession);
        $("#student_id_bind").val(data.user_id).trigger('change');
        $('#apply_to_all').val(data.apply_to_all);

        var admission_charges_months =  JSON.parse(data.admission_charges_months_validation);
        $.each(admission_charges_months, function (key, val) {
            $('#'+val+'_ac').prop('checked', true);
        });

        var enrolment_fee_months =  JSON.parse(data.enrolment_fee_months_validation);
        $.each(enrolment_fee_months, function (key, val) {
            $('#'+val+'_ef').prop('checked', true);
        });

        var tuition_fee_months =  JSON.parse(data.tuition_fee_months_validation);
        $.each(tuition_fee_months, function (key, val) {
            $('#'+val+'_tuitf').prop('checked', true);
        });

        var terminalMonth =  JSON.parse(data.terminal_fee_months_validation);
        $.each(terminalMonth, function (key, val) {
            $('#'+val+'_tf').prop('checked', true);
        });

        var sportsMonth =  JSON.parse(data.sports_months_validation);
        $.each(sportsMonth, function (key, val) {
            $('#'+val+'_sf').prop('checked', true);
        });

        var misc_charges_months =  JSON.parse(data.misc_charges_months_validation);
        $.each(misc_charges_months, function (key, val) {
            $('#'+val+'_msc').prop('checked', true);
        });

        var scholarship_concession =  JSON.parse(data.scholarship_concession_validation);
        $.each(scholarship_concession, function (key, val) {
            $('#'+val+'_sc').prop('checked', true);
        });

        $("#add_payment_settings").hide();
        $("#update_payment_settings").show();
    }

    function deletePaymentSettings(id){
        Notiflix.Confirm.Show(
            "Delete Confirmation",
            "Do you want to delete?",
            "Delete",
            "Cancel",
            function() {
                $.ajax({
                url: "{{ route('paymentsettings.destroy')}}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'JSON',
                success:function(response)
                {
                    if(response.warning){
                        Notiflix.Notify.Warning(response.warning);
                        GetSessionPaymentSettingsData();
                    }
                },
                error: function(xhr, status, error) {
                    Notiflix.Notify.Failure(response.warning);
                    GetSessionPaymentSettingsData();
                }
            });
        });
    }

</script>
@endsection