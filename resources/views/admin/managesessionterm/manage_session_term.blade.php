@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Create Session</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Session</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <form action="{{route('ams.addSessionTerm')}}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="session_id" id="session_id">
                    <div class="col-4 mb-2">
                        <label class="form-label">Session Name <span class="text-danger">*</span></label>
                        <input type="text" id="session_name" class="form-control" placeholder="Session Name" name="session_name" required>
                    </div>
                    <div class="col-4 mb-4">
                        <label class="form-label">Session Valid From<span class="text-danger">*</span></label>
                        <input type="date" id="section_valid_from" class="form-control" name="section_valid_from" required>
                    </div>
                    <div class="col-4 mb-4">
                        <label class="form-label">Session Valid To<span class="text-danger">*</span></label>
                        <input type="date" id="section_valid_to" class="form-control" placeholder="Class Arm Name" name="section_valid_to" required>
                    </div>
                    <div class="col-4 mb-4">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" id="status">
                            @foreach (Allstatus() as $item)
                                <option value="{{$item['id']}}">{{$item['status']}}</option>
                            @endforeach
                        </select>
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
                        <th>Session Name</th>
                        <th>Valid From</th>
                        <th>Valid To</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!@empty(GetSession()))
                        @foreach (GetSession() as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{@$item->sessions_name}}</td>
                                <td>{{ date('d-m-Y', strtotime(@$item->section_valid_from))}}</td>
                                <td>{{ date('d-m-Y', strtotime(@$item->section_valid_to))}}</td>
                                <td class="text-center">
                                    @if (@$item->status ==1)
                                        <i class="bi bi-check-lg fw-bold fs-5 text-success"></i>
                                    @else
                                    <i class="bi bi-x-lg fw-bold fs-6 text-danger"></i>
                                    @endif
                                </td>
                                <td >
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="editClass({{@$item}})"><i class="bi bi-pencil-square"></i> </a>
                                        <form action="{{route('ams.destroySession', $item->id)}}" method="post">
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
            {{-- <div class="justify-content-end mt-4">
                {{@GetClassesArms()->appends(request()->input())->links()}}
            </div> --}}
        </div>
    </div>
</section>
<script>
    $(document).ready(function(e) {
        $("#update").hide();
    });
    function editClass(data){
        $("#session_id").val(data.id);
        $("#session_name").val(data.sessions_name);
        $("#section_valid_from").val(data.section_valid_from);
        $("#section_valid_to").val(data.section_valid_to);
        $("#status").val(data.status);
        $("#update").show();
        $("#save").hide();
    }
</script>
@endsection