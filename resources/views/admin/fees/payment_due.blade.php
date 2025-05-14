@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Payment Due</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.index') }}">Payment</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deposite.create') }}">Payment History</a></li>
            <li class="breadcrumb-item active">Payment Due</li>
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
                        <label for="" class="form-label">Select Student</label>
                        <select name="user_id" id="student_id_bind" class="form-select js-example-basic-single">
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <label for="" class="form-label">Select Month</label>
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
                        <label for="" class="form-label">Select Year</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">--Select Year--</option>
                            @if (!@empty(LastFiveYear()))
                                @foreach (LastFiveYear() as $item)
                                    <option value="{{@$item}}" {{$item == date('Y') ? "selected": ""}}>{{@$item}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <a onclick="filterPaymentDue()" class="btn btn-primary btn-sm" style="margin-right: 10px;" ><i class="bi bi-filter-left"></i> Filter</a>
                        <a href="javascript:void(0)" onclick="reload()" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-repeat"></i> Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <section class="section">
        <h5>Payment Due</h5>
        <div class="card border-0">
            <div class="card-body pt-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="DataTables">
                        <thead>
                            <tr class="table-primary">
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</section>
<script>
    var table;
    $(document).ready(function() {
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

    function filterPaymentDue(){
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var user_id = $('#student_id_bind').val();
        var month = $('#month').val();
        var year = $('#year').val();
        if (session_id && class_id && section_id) {
            $.ajax({
                url: "{{route('deposite.show_due_payment')}}",
                type: 'post',
                data:{
                    session_id:session_id,
                    class_id:class_id,
                    section_id:section_id,
                    user_id:user_id,
                    month:month,
                    year:year,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    table.clear();
                    $.each(response, function(index, deposite) {
                        table.row.add([
                            index + 1,
                            deposite.student_name + '<br>' + deposite.admission_number,
                            deposite.month,
                            deposite.year,
                            "<span class='badge text-bg-danger'>"+deposite.status+"</span>",
                            '<a class="btn btn-primary btn-sm rounded-pill" href="javascript:void(0)" onclick="paymentNow(\''+ deposite.student_id +'\')"><i class="bi bi-credit-card"></i> Pay Now </a>'
                        ])
                    });
                    table.draw();
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }else{
            Notiflix.Notify.Failure("Please Select Session, Class and Section");
        }
    }

    function paymentNow(student_id){
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var month = $('#month').val();
        var year = $('#year').val();

        window.location.href ="fees-payment?session_id="+session_id + '&class_id='+class_id+ '&section_id='+ section_id + '&student_id='+student_id +  '&month='+month + '&year='+year;
    }
</script>
@endsection