@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Class Teacher's</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Class Teacher's</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            <form action="{{route('ams.addTeacher')}}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <input type="hidden" name="admin_id" id="admin_id">
                    <div class="col-4 mb-2">
                        <label for="name" class="form-label">Teacher's <span class="text-danger">*</span></label>
                        <input type="text" id="name" placeholder="Enter Teacher's Name" class="form-control" name="name" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Class <span class="text-danger">*</span></label>
                        <select name="class_id" id="class_id" class="form-select" required>
                            <option value="">Select Class</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="" class="form-label">Select Section <span class="text-danger">*</span></label>
                        <select name="section_id" id="section_id" class="form-select" required>
                            <option value="">Select Section</option>
                        </select>
                    </div>
                    <div class="col-4 mb-4">
                        <label for="email_address" class="form-label">Email <span class="text-danger">*</span></label>
                        <small class="form-text text-danger">(This email is used for system login.)</small>
                        <input type="text" id="email_address" class="form-control" name="email" placeholder="Enter Email" autocomplete="off" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="off">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Re Enter Password" autocomplete="off">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-12 text-end">
                        <a type="button" href="javascript:void(0)" onclick="reload()" id="reset" class="btn btn-secondary">Clear</a>
                        <button type="submit" id="save" class="btn btn-primary">Save</button>
                        <button type="submit" id="update" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0">
        <div class="card-body pt-4">
            <table class="small w-100 table table-bordered table-striped" id="DataTables">
                <thead>
                    <tr class="table-primary">
                        <th>SL NO</th>
                        <th>Teacher's</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!@empty(GetTeacher()))
                        @foreach (GetTeacher() as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{@$item->name}}</td>
                                <td>{{@$item->email}}</td>
                                <td>
                                    @if ($item->teacherclassmapping)
                                        @foreach ($item->teacherclassmapping as $mapping)
                                            {{ $mapping->teacherClass->class_name ?? 'N/A' }}
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($item->teacherclassmapping)
                                        @foreach ($item->teacherclassmapping as $mapping)
                                            {{ $mapping->teacherSection->section_name ?? 'N/A' }}
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary btn-sm rounded-pill me-2" href="javascript:void(0)" onclick="editTeacher({{@$item}})"><i class="bi bi-pencil-square"></i> </a>
                                        <form action="{{route('ams.destroyTeachers', @$item->id)}}" method="post">
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
                {{@GetTeacher()->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(e) {
        $("#update").hide();
    });
    function editTeacher(data){
        console.log(data)
        $("#admin_id").val(data.id);
        $("#name").val(data.name);
        $("#email_address").val(data.email);
        $("#email_address").attr('disabled', true);

        $("#password").hide();
        $("#password_confirmation").hide();

        $("#class_id").val(data.teacherclassmapping[0].class_id)
        $('#class_id').val(data.teacherclassmapping[0].class_id).trigger('change');
        
        setTimeout(function(){ 
            $("#section_id").val(data.teacherclassmapping[0].section_id)
         }, 2000);

        $("#update").show();
        $("#save").hide();
    }


</script>
@endsection