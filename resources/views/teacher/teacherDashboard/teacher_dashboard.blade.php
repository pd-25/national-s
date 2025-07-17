@extends('admin.layout.admin_main')
@section('content')
<div class="card border-0">
    <div class="card-body pt-4">
        <div class="container-fluid pt-4 px-4">
        @php
            $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
            //$teacher_class_assigned = $teacher_details->teacherclassmapping[0]->teacherClass->class_name;
            //$teacher_section_assigned = $teacher_details->teacherclassmapping[0]->teacherSection->section_name;
        @endphp
            <h4 class=""> {{auth()->guard('admin')->user()->name}}, Class Teacher of: <br> <ul> @foreach (@$teacher_details->teacherclassmapping as $item)
                <li><span style="font-size: 14px">{{@$item->teacherClass->class_name}} / {{@$item->teacherSection->section_name}}</span></li> @endforeach </ul> </h4>
            <div class="row g-4">
                <div class="col-sm-6 col-xl-6">
                    <div class="bg-primary rounded  text-white d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-person-badge fs-3"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Total Students</p>
                            <h6 class="mb-0">{{@$dashboardData['totalStudent']}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-6">
                    <div class="bg-success rounded  text-white d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-clock fs-3"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Today Present</p>
                            <h6 class="mb-0">{{@$dashboardData['total_present']}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-6">
                    <div class="bg-danger text-white rounded d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-clock-history fs-3"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2">Today Absent</p>
                            <h6 class="mb-0">{{@$dashboardData['total_absent']}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-6">
                    <div class="bg-warning rounded text-white d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-exclamation fs-3"></i>
                        <div class="ms-3  text-end">
                            <p class="mb-2">Today Late</p>
                            <h6 class="mb-0">{{@$dashboardData['total_late']}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
