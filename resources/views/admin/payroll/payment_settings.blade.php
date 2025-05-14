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
                    <input type="hidden" name="payment_setting_id" id="payment_setting_id">
                    <div class="col-4 mb-4">
                        <label for="" class="form-label">Select Session<span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id" class="form-select" required>
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
                    <div class="col-4 mb-4">
                        <label for="" class="form-label">Select Class<span class="text-danger">*</span></label>
                        <select name="class_id" id="class_id" class="form-select" required>
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
                    <div class="col-4 mb-4">
                        <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="section_id" class="form-select" onchange="GetSessionPaymentSettingsData()" required>
                            <option value="">--Select Section--</option>
                        </select>
                        @if ($errors->has('section_id'))
                            <span class="text-danger">{{ $errors->first('section_id') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-2">
                        <div class="row">
                            @if (!@empty(GetPayrollComponent('fee_settings')))
                                @foreach (GetPayrollComponent('fee_settings') as $index => $item)
                                    <div class="col-6 mb-3 border rounded p-3 bg-color-items">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6>{{ $item->name }}</h6>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs. </span>
                                                    <input type="number" min="0"
                                                        name="charges_amount[{{ $item->id }}]"
                                                        class="form-control"
                                                        @if (@$item->fixed_amount != null)
                                                            value="{{@$item->fixed_amount}}"
                                                        @else
                                                            value="{{ old('charges_amount.' . @$item->id) }}"
                                                        @endif
                                                        id="charges_amount_{{ $item->id }}">
                                                </div>
                                                @if ($errors->has('charges_amount.' . $item->id))
                                                    <span class="text-danger">{{ $errors->first('charges_amount.' . $item->id) }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <label class="fw-bold">{{ $item->name }} (Visible Months)</label><br>
                                        @foreach (GetallMonths() as $month)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    name="months_validation[{{ $item->id }}][]"
                                                    value="{{ $month }}"
                                                    id="{{ $month }}_{{ $item->id }}">
                                                <small class="form-check-label" for="{{ $month }}_{{ $item->id }}">{{ $month }}</small>
                                            </div>
                                        @endforeach

                                        @if ($errors->has('months_validation.' . $item->id))
                                            <span class="text-danger">{{ $errors->first('months_validation.' . $item->id) }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" id="add_payment_settings" class="btn btn-success" >Add Fee Settings</button>
                        <button type="submit" id="update_payment_settings" class="btn btn-primary" >Update Fee Settings</button>
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
                <table class="table table-bordered table-striped table-sm table-fixed-header" id="DataTables">
                    <thead>
                        <tr class="table-primary">
                            <th rowspan="2">Sl</th>
                            <th rowspan="2">Session</th>
                            <th rowspan="2">Class</th>
                            <th rowspan="2">Section</th>
                            @php $feeComponents = GetPayrollComponent('fee_settings'); @endphp
                            @if (!empty($feeComponents) && $feeComponents->count())
                                <th class="text-center" colspan="{{ $feeComponents->count() }}">Payment Settings</th>
                            @endif
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            @foreach ($feeComponents as $item)
                                <th class="table-warning">{{ $item->name }}</th>
                            @endforeach
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
        GetSessionPaymentSettingsData();
    });

    function resetdata(){
        $("#add_payment_settings").show();
        $("#update_payment_settings").hide();
        
    }

    function GetSessionPaymentSettingsData() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        if (session_id) {
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
                        var charges = JSON.parse(payemtsetting.charges_amount);
                        var months = JSON.parse(payemtsetting.months_validation);
                        var rowData = [
                            index + 1,
                            payemtsetting.student_session.sessions_name,
                            payemtsetting.student_class.class_name,
                            payemtsetting.student_section.section_name
                        ];
                        $.each(charges, function(index, component) {
                            let html = '';
                            if (component) {
                                html += '<strong>' + component + '</strong><br>';
                                html += '<strong>Months:</strong> ' + (months[index] ? months[index].join(', ') : '-');
                            } else {
                                html = '—';
                            }
                            rowData.push(html);
                        });

                        rowData.push(
                            '<a class="btn btn-primary btn-sm me-2 mb-2" href="javascript:void(0)" onclick=\'EditPaymentSettings(' + JSON.stringify(payemtsetting) +')\'><i class="bi bi-pencil-square"></i></a>' +
                            '<a class="btn btn-danger btn-sm show_confirm" href="javascript:void(0)" onclick="deletePaymentSettings(\'' + payemtsetting.id + '\')"><i class="bi bi-trash"></i></a>'
                        );

                        table.row.add(rowData);
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

        $('#session_id').val(data.session_id);
        $('#class_id').val(data.class_id);
         $('#class_id').trigger('change');
            setTimeout(function() {
                $('#section_id').val(data.section_id);
            }, 2000);

        var chargesAmount = JSON.parse(data.charges_amount || '{}');
        for (const id in chargesAmount) {
            const input = document.getElementById('charges_amount_' + id);
            if (input) {
                input.value = chargesAmount[id];
            }
        }
        var monthsValidation = JSON.parse(data.months_validation || '{}');

        for (const componentId in monthsValidation) {
            const monthsArray = monthsValidation[componentId];
            monthsArray.forEach(month => {
                const checkboxId = `${month}_${componentId}`;
                const checkbox = document.getElementById(checkboxId);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        }
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
                    Notiflix.Notify.Failure(response.error);
                    GetSessionPaymentSettingsData();
                }
            });
        });
    }

</script>
@endsection