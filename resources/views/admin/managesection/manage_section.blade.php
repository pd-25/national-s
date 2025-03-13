@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Create Class Sction</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Class Sction</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <form action="{{route('ams.addClassesSection')}}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="arm_id" id="arm_id">
                    <div class="col-6 mb-4">
                        <label for="" class="form-label">Select Class <span class="text-danger">*</span></label>
                        <select name="class_id" id="class_id" class="form-select">
                            <option value="">Select Class</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mb-4">
                        <label for="" class="form-label">Class Sction Name <span class="text-danger">*</span></label>
                        <input type="text" id="section_name" class="form-control" placeholder="Class Arm Name" name="section_name" required>
                    </div>
                    <div class="col-12">
                        <a type="button" href="javascript:void(0)" onclick="reload()" id="reset" class="btn btn-secondary btn-sm">Clear</a>
                        <button type="submit" id="save" class="btn btn-primary btn-sm">Save</button>
                        <button type="submit" id="update" class="btn btn-success btn-sm">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <table class="small w-100 table table-striped" id="DataTables">
                <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Class Name</th>
                        <th>Class Sction Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!@empty(GetClassesArms()))
                        @foreach (GetClassesArms() as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{@$item->className->class_name}}</td>
                                <td>{{@$item->section_name}}</td>
                                <td >
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="editClass({{$item}})"><i class="bi bi-pencil-square"></i> </a>
                                        <form action="{{route('ams.destroyClassesArms', $item->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill show_confirm"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="justify-content-end mt-4">
                {{@GetClassesArms()->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(e) {
        $("#update").hide();
    });
    function editClass(data){
        $("#arm_id").val(data.id);
        $("#class_id").val(data.class_id);
        $("#section_name").val(data.section_name);
        $("#update").show();
        $("#save").hide();
    }

</script>
@endsection