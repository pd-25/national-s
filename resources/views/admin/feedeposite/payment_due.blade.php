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
                        <label for="" class="form-label">Select Session</label>
                        <select name="session_id" id="session_id" class="form-select">
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select class</label>
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
                        <label for="" class="form-label">Select Section </label>
                        <select name="section_id" id="section_id" class="form-select" onchange="getStudent()">
                            <option value="">--Select Section--</option>
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Student</label>
                        <select name="user_id" id="student_id_bind" class="form-select">
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Month</label>
                        <select name="month" id="month" class="form-select">
                            <option value="">--Select Month--</option>
                            @if (!@empty(GetallMonths()))
                                @foreach (GetallMonths() as $item)
                                    <option value="{{@$item}}">{{@$item}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-4">
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
        <div class="card border-0">
            <div class="card-body pt-4">
                <div class="table-responsive">
                    <table class="table table-striped" id="DataTables">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Admission No</th>
                                <th>Name</th>
                                <th>Session</th>
                                <th>Class</th>
                                <th>Section</th>
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
</script>
@endsection