@extends('admin.layout.admin_main')
@section('content')
    <div class="pagetitle">
       <h1>Dashboard</h1>
    </div>
    <div class="container-fluid pt-4 px-4">
        <h5 class="mb-4 fw-bold">"Welcome to the Dashboard, <span class="text-primary">{{Auth::guard('admin')->user()->name}}</span>!" </h5>
        <div class="row g-4">
            <div class="col-sm-4 col-xl-4">
                <div class="rounded bg-dark text-white d-flex align-items-center justify-content-between p-4">
                     <i class="bi bi-person-video3 fs-3"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 fw-bold">Total Teachers</p>
                        <h6 class="mb-0 fw-bold">{{@$dashboardData['teachers']}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4">
                <div class="rounded bg-dark text-white d-flex align-items-center justify-content-between p-4">
                   <i class="bi bi-people-fill fs-3"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 fw-bold">Total Students</p>
                        <h6 class="mb-0 fw-bold">{{@$dashboardData['students']}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4">
                <div class="rounded d-flex bg-dark text-white align-items-center justify-content-between p-4">
                    <i class="bi bi-person-fill-gear fs-3"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 fw-bold">Total Staff</p>
                        <h6 class="mb-0 fw-bold">{{@$dashboardData['staff']}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4">
                <div class="bg-dark text-white rounded d-flex align-items-center justify-content-between p-4">
                   <i class="bi bi-diagram-2-fill fs-3"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 fw-bold">Total Classes</p>
                        <h6 class="mb-0 fw-bold">{{@$dashboardData['classes']}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4">
                <div class="bg-dark text-white rounded d-flex align-items-center justify-content-between p-4">
                   <i class="bi bi-diagram-3-fill fs-3"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2 fw-bold">Total Sections</p>
                        <h6 class="mb-0 fw-bold">{{@$dashboardData['sections']}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
