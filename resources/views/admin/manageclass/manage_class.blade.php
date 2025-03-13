@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Create Class</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Class</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <form action="{{route('ams.addClasses')}}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="class_id" id="class_id">
                    <div class="col-6 mb-4">
                        <label for="" class="form-label">Class Name <span class="text-danger">*</span></label>
                        <input type="text" id="class_name" class="form-control" placeholder="Class Name" name="class_name" required>
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
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!@empty(GetClasses()))
                        @foreach (GetClasses() as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{@$item->class_name}}</td>
                                <td >
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="editClass({{$item}})"><i class="bi bi-pencil-square"></i> </a>
                                        <form action="{{route('ams.destroyClasses', $item->id)}}" method="post">
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
        </div>
    </div>
</section>
<script>
    $(document).ready(function(e) {
        $("#update").hide();
    });
    function editClass(data){
        $("#class_id").val(data.id);
        $("#class_name").val(data.class_name);
        $("#update").show();
        $("#save").hide();
    }

</script>
@endsection