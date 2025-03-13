@extends('admin.layout.admin_main')
@section('content')
<div class="card border-0">
    <div class="card-body pt-4">
        <div class="container-fluid pt-4 px-4">
        @php
            $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
            $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->teacherClass->class_name;
            $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->teacherSection->section_name;
        @endphp
            <h4 class="mb-4"> {{auth()->guard('admin')->user()->name}}, Class Teacher of ({{@$teacher_class_assigned}} - {{@$teacher_section_assigned}})</h4>
            <div class="row g-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-success rounded  text-white d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-box-seam fs-3"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Students</p>
                            {{-- <h6 class="mb-0">{{@$dashboardData['manageProduct']}}</h6> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-primary rounded  text-white d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-receipt fs-3"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Classes</p>
                            {{-- <h6 class="mb-0">{{@$dashboardData['billing']}}</h6> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-dark text-white rounded d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-currency-rupee fs-3"></i>
                        <div class="ms-3">
                            <p class="mb-2">Class Sections</p>
                            {{-- <h6 class="mb-0">{{@$dashboardData['today_total']}}</h6> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="bg-info rounded text-white d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-currency-rupee fs-3"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Student Attendance</p>
                            {{-- <h6 class="mb-0">{{@$dashboardData['weekly_total']}}</h6> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
