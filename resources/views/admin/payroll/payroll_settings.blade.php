@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
        <h1>Manage Payroll Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Manage Payroll Settings</li>
            </ol>
        </nav>
    </div>
    <section>
        <div class="card border-0 mb-3">
            <div class="card-body pt-4">
                <h5 class="fw-bold">Create Payroll Settings</h5>
                <form id="formData" action="{{ route('payroll.store') }}" method="post">
                    @csrf
                    <div class="row my-3">
                        <input type="hidden" name="payroll_id" id="payroll_id">
                        <div class="col-12 mb-3">
                            <label for="" class="form-label mb-3">Type <span class="text-danger">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="Allowances" value="Allowances"
                                    name="type" checked onchange="GetPayrollType()">
                                <label class="form-check-label" for="Allowances">Allowances</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="Deductions" value="Deductions"
                                    name="type" onchange="GetPayrollType()">
                                <label class="form-check-label" for="Deductions">Deductions</label>
                            </div>
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Parent Component</label>
                            <select name="parent_id" class="form-select" id="parent_id">
                                <option value="">Select when you want to create a subcomponent</option>
                            </select>
                        </div>
                        <div class="col-6 mb-4">
                            <label for="" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter name" id="name"
                                name="name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-4">
                            <label for="" class="form-label">Fixed Amount </label>
                            <input type="number" class="form-control" placeholder="Enter fixed amount" name="fixed_amount"
                                id="fixed_amount">
                            @if ($errors->has('fixed_amount'))
                                <span class="text-danger">{{ $errors->first('fixed_amount') }}</span>
                            @endif
                        </div>
                        <div class="col-4 mb-4">
                            <label for="" class="form-label">Apply Fee Settings</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" value="applied" name="apply_on_fee_Settings"
                                    id="apply_on_fee_Settings">
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" id="add_payroll_settings" class="btn btn-success">Add Payroll</button>
                            <button type="submit" id="update_payroll_settings" class="btn btn-primary">Update
                                Payroll</button>
                            <button type="reset" class="btn btn-secondary" onclick="resetdata()">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body pt-4">
                <h5>List Payroll Settings</h5>
                <div class="row">
                    <div class="col-4 my-3">
                        <label for="" class="form-label">Type</label>
                        <select name="type" class="form-select" id="listType" onchange="GetPayrollSettingsData()">
                            <option value="Allowances">Allowances</option>
                            <option value="Deductions">Deductions</option>
                        </select>
                    </div>
                </div>
                <div class="table-wrapper" style="max-height: 700px; overflow-y: auto;">
                    <table class="table table-striped table-bordered" id="DataTables">
                        <thead>
                            <tr class="table-primary">
                                <th>No.</th>
                                <th>Name</th>
                                <th>Parent Component</th>
                                <th>Amount</th>
                                <th>Apply Fee Settings</th>
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
            $("#add_payroll_settings").show();
            $("#update_payroll_settings").hide();
            table = $('#DataTables').DataTable({
                bLengthChange: true,
                "lengthMenu": [
                    [10, 15, 25, 50, 100, -1],
                    [10, 15, 25, 50, 100, "All"]
                ],
                "iDisplayLength": 10,
                bInfo: false,
                responsive: true,
                "bAutoWidth": false
            });
            GetPayrollType();
            GetPayrollSettingsData();
        });

        function GetPayrollType() {
            var Allowances = $('#Allowances').is(':checked');
            var Deductions = $('#Deductions').is(':checked');
            var listType;
            if (Allowances) {
                listType = "Allowances";
            } else if (Deductions) {
                listType = "Deductions";
            }
            if (listType) {
                $('#parent_id').empty();
                $('#parent_id').append('<option value="">Select when you want to create a subcomponent</option>');
                return $.ajax({
                    url: "{{ route('payroll.create') }}",
                    type: 'get',
                    data: {
                        type: listType,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $.each(response, function(index, item) {
                            $('#parent_id').append('<option value="' + item.id + '">' + item.name +
                                '</option>');
                        });
                    },
                    error: function() {
                        console.error('Error fetching sections');
                    }
                });
            }
        }

        function GetPayrollSettingsData() {
            var listType = $('#listType').val();
            console.log(listType)
            if (listType === 'Allowances') {
                $('#Allowances').prop('checked', true);
                $('#Deductions').prop('checked', false);
            } else if (listType === 'Deductions') {
                $('#Deductions').prop('checked', true);
                $('#Allowances').prop('checked', false);
            }
            GetPayrollType();
            if (listType) {
                $.ajax({
                    url: "{{ route('payroll.show') }}",
                    type: 'get',
                    data: {
                        type: listType,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        table.clear();
                        $.each(response, function(index, payroll) {
                            table.row.add([
                                index + 1,
                                payroll.name,
                                payroll.parent != null ? payroll.parent.name : '--',
                                payroll.fixed_amount,
                                payroll.apply_on_fee_Settings == 0 ? "Not Applied" : "Applied",
                                '<a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick=\'EditPayRollSettings(' +
                                JSON.stringify(payroll) +
                                ')\'><i class="bi bi-pencil-square"></i></a>' +
                                '<a class="btn btn-danger btn-sm rounded-pill show_confirm" href="javascript:void(0)" onclick="deletePayrollSettings(\'' +
                                payroll.id + '\')"><i class="bi bi-trash"></i></a>'
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

        function EditPayRollSettings(data) {
            if (data.type == 'Allowances') {
                $('#Allowances').prop('checked', true);
                $('#Deductions').prop('checked', false);
            } else if (data.type == 'Deductions') {
                $('#Deductions').prop('checked', true);
                $('#Allowances').prop('checked', false);
            }
            $('#payroll_id').val(data.id);
            $('#parent_id').val(data.parent_id);
            $('#name').val(data.name);
            $('#fixed_amount').val(data.fixed_amount);

            if (data.apply_on_fee_Settings == 1) {
                $('#apply_on_fee_Settings').prop('checked', true);
            } else {
                $('#apply_on_fee_Settings').prop('checked', false);
            }

            $("#add_payroll_settings").hide();
            $("#update_payroll_settings").show();
        }

        function deletePayrollSettings(payroll_id) {
            Notiflix.Confirm.show(
                "Delete Confirmation",
                "Do you want to delete?",
                "Delete",
                "Cancel",
                function() {
                    $.ajax({
                        url: "{{ route('payroll.destroy') }}",
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "payroll_id": payroll_id
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.warning) {
                                Notiflix.Notify.warning(response.warning);
                                GetPayrollSettingsData();
                            }
                        },
                        error: function(xhr, status, error) {
                            Notiflix.Notify.failure(response.error);
                            GetPayrollSettingsData();
                        }
                    });
                });
        }
    </script>
@endsection
