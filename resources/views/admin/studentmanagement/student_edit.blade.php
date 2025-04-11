@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Edit Student</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.StudentRegister') }}">Registration</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentList') }}">Manage Student's</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentView', @$studentClassMapping->id) }}">View Student</a></li>
            <li class="breadcrumb-item active">Edit Student</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="card border-0">
        <div class="card-body pt-4">
            @if ($errors)
                @foreach ($errors as $item)
                    <small class="text-danger">{{ $item }}</small>
                @endforeach
            @endif
            <form action="{{route('student.updateStudentDetails')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{@$studentClassMapping->id}}">
                    <div class="col-12">
                        <label class="form-label mr-2">Admission Number:</label>
                        <span class="fw-bold">{{@$studentClassMapping->admission_number}}</span>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label mr-2">Date:</label>
                        <span>{{date('d-m-Y', strtotime(@$studentClassMapping->created_at))}}</span>
                    </div>
                    <div class="col-6">
                        <img src="/assets/website/images/logo.png" class="img-fluid" style="height:100px;">
                    </div>
                    <div class="col-6 text-end">
                        <div class="image-upload-wrapper">
                            @if ($studentClassMapping->image)
                                <img 
                                src="{{@$studentClassMapping->image}}" 
                                class="rounded-circle prof-photo img-thumbnail" 
                                alt="Image" 
                                id="preview-image-before-upload"
                                >
                                <div class="upload-btn-wrapper">
                                    <input 
                                        type="file" 
                                        class="form-control d-none" 
                                        name="image" 
                                        id="image" 
                                        accept="image/*"
                                    >
                                </div>
                            @else
                                <img 
                                    src="{{asset('assets/admin/img/upload.png')}}" 
                                    class="rounded-circle prof-photo img-thumbnail" 
                                    alt="Image" 
                                    id="preview-image-before-upload"
                                >
                                <div class="upload-btn-wrapper">
                                    <input 
                                        type="file" 
                                        class="form-control d-none" 
                                        name="image" 
                                        id="image" 
                                        accept="image/*"
                                    >
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="text-uppercase fw-bold">Student's Profile</h4>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="student_name" class="form-label">Name of Pupil(In Capital Letters)<span class="text-danger">*</span></label>
                        <input type="text" id="student_name" class="form-control" name="student_name" required value="{{@$studentClassMapping->student_name}}">
                        @if ($errors->has('student_name'))
                            <span class="text-danger">{{ $errors->first('student_name') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="date_of_birth" class="form-label">Date of Birth: <span class="text-danger">*</span></label>
                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{date('Y-m-d', strtotime(@$studentClassMapping->date_of_birth))}}">
                        @if ($errors->has('date_of_birth'))
                            <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="aadhar_no" class="form-label"> Aadhar No: <span class="text-danger">*</span></label>
                        <input type="number" id="aadhar_no" class="form-control" name="aadhar_no"  value="{{@$studentClassMapping->aadhar_no}}">
                        @if ($errors->has('aadhar_no'))
                            <span class="text-danger">{{ $errors->first('aadhar_no') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="nationality" class="form-label"> Nationality: <span class="text-danger">*</span></label>
                        <input type="text" id="nationality" class="form-control" name="nationality"  value="{{@$studentClassMapping->nationality}}">
                        @if ($errors->has('nationality'))
                            <span class="text-danger">{{ $errors->first('nationality') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="religion" class="form-label"> Religion: <span class="text-danger">*</span></label>
                        <select name="religion" class="form-select" id="religion">
                            <option value="">Select Religion</option>
                            @foreach (Religion() as $item)
                                <option value="{{$item['name']}}" {{@$studentClassMapping->religion == @$item['name'] ? "selected":""}}>{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('religion'))
                            <span class="text-danger">{{ $errors->first('religion') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="gender" class="form-label"> Gender: <span class="text-danger">*</span></label>
                        <select name="gender" class="form-select" id="gender">
                            <option value="">Select Gender</option>
                            @foreach (Gender() as $item)
                                <option value="{{$item['name']}}" {{@$studentClassMapping->gender == @$item['name'] ? "selected":""}}>{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="caste" class="form-label"> Caste: <span class="text-danger">*</span></label>
                        <select name="caste" class="form-select" id="caste">
                            <option value="">Select Caste</option>
                            @foreach (Caste() as $item)
                                <option value="{{$item['name']}}" {{@$studentClassMapping->caste == @$item['name'] ? "selected":""}}>{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('caste'))
                            <span class="text-danger">{{ $errors->first('caste') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                        <textarea id="address" class="form-control" rows="4" name="address">{{@$studentClassMapping->address}} </textarea>
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="pin_code" class="form-label">Pin Code: <span class="text-danger">*</span></label>
                        <input type="number" id="pin_code" class="form-control" name="pin_code"  value="{{@$studentClassMapping->pin_code}}">
                        @if ($errors->has('pin_code'))
                            <span class="text-danger">{{ $errors->first('pin_code') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="mother_tongue" class="form-label">Mother Tongue: <span class="text-danger">*</span></label>
                        <input type="text" id="mother_tongue" class="form-control" name="mother_tongue" value="{{@$studentClassMapping->mother_tongue}}">
                        @if ($errors->has('mother_tongue'))
                            <span class="text-danger">{{ $errors->first('mother_tongue') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="blood_group" class="form-label">Blood Group: <span class="text-danger">*</span></label>
                        <select name="blood_group" class="form-select" id="blood_group">
                            <option value="">Select Blood Group</option>
                            @foreach (BloodGroup() as $item)
                                <option value="{{$item['name']}}"  {{@$studentClassMapping->blood_group == @$item['name'] ? "selected":""}}>{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('blood_group'))
                            <span class="text-danger">{{ $errors->first('blood_group') }}</span>
                        @endif
                    </div>
                    <div class="col-12 my-3">
                        <h4>Selection of Stream: ( Applicable for class Admissions in class XI)</h4>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="form-check me-3">
                            <input class="form-check-input" name="stream" type="radio" value="Science" id="flexCheckScience" {{@$studentClassMapping->stream == "Science" ? "checked":""}}>
                            <label class="form-check-label" for="flexCheckScience">
                                Science
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" name="stream" type="radio" value="Commerce" id="flexCheckCommerce" {{@$studentClassMapping->stream == "Commerce" ? "checked":""}}>
                            <label class="form-check-label" for="flexCheckCommerce">
                                Commerce
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" name="stream" type="radio" value="Humanities" id="flexCheckHumanities" {{@$studentClassMapping->stream == "Humanities" ? "checked":""}}>
                            <label class="form-check-label" for="flexCheckHumanities">
                                Humanities  
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" name="stream" type="radio" value="Combination" id="flexCheckCombination" {{@$studentClassMapping->stream == "Combination" ? "checked":""}}>
                            <label class="form-check-label" for="flexCheckCombination">
                                Combination
                            </label>
                        </div>
                        <div class="me-3">
                            <input type="text" class="form-control" name="combination_text" placeholder="Enter Combination stream" value="{{@$studentClassMapping->combination_text}}">
                        </div>
                        @if ($errors->has('stream'))
                            <span class="text-danger">{{ $errors->first('stream') }}</span>
                        @endif
                    </div>
                    <div class="col-12 my-3">
                        <h4>Previous Academic Information :</h4>
                    </div>
                    <div class="col-12">
                        <table id="previousSchoolTable" class="table">
                            <thead>
                                <tr>
                                    <td>Name of the previous school & location</td>
                                    <td>Academic Session</td>
                                    <td>Class</td>
                                    <td>Second Language</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary my-2 btn-sm" id="addRow">Add Row</button>
                    </div>
                    <div class="col-12 my-3">
                        <h4>Achievements of your child :</h4>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="achievements" class="form-label">Please mention the achievements, if any, of your child in academics / co-curricular activities :</label>
                        <textarea id="achievements" class="form-control" rows="4" name="achievements">{{@$studentClassMapping->achievements}} </textarea>
                        @if ($errors->has('achievements'))
                            <span class="text-danger">{{ $errors->first('achievements') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="previous_school_info" class="form-label">Please mention, in brief, if there is any history of previous illness :</label>
                        <textarea id="previous_school_info" class="form-control" rows="4" name="previous_school_info">{{@$studentClassMapping->previous_school_info}} </textarea>
                        @if ($errors->has('previous_school_info'))
                            <span class="text-danger">{{ $errors->first('previous_school_info') }}</span>
                        @endif
                    </div>
                    <div class="col-12 my-3">
                        <h4>PARENTS' / GUARDIAN'S PROFILE:</h4>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="parent_name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" id="parent_name" class="form-control" name="parent_name" required value="{{@$studentClassMapping->parent_name}}">
                        @if ($errors->has('parent_name'))
                            <span class="text-danger">{{ $errors->first('parent_name') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-2">
                        <label for="parent_relation" class="form-label">Relation <span class="text-danger">*</span></label>
                        <select name="parent_relation" class="form-select" id="parent_relation">
                            <option value="{{$item['name']}}">Select Relation</option>
                            @foreach (Relation() as $item)
                                <option value="{{$item['name']}}" {{@$studentClassMapping->parent_relation == @$item['name'] ? "selected":""}}>{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent_relation'))
                            <span class="text-danger">{{ $errors->first('parent_relation') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                        <input type="text" id="qualification" class="form-control" name="qualification" value="{{@$studentClassMapping->qualification}}">
                        @if ($errors->has('qualification'))
                            <span class="text-danger">{{ $errors->first('qualification') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="occupation" class="form-label">Occupation<span class="text-danger">*</span></label>
                        <input type="text" id="occupation" class="form-control" name="occupation" value="{{@$studentClassMapping->occupation}}">
                        @if ($errors->has('occupation'))
                            <span class="text-danger">{{ $errors->first('occupation') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="organization" class="form-label">Organization</label>
                        <input type="text" id="organization" class="form-control" name="organization" value="{{@$studentClassMapping->organization}}">
                        @if ($errors->has('organization'))
                            <span class="text-danger">{{ $errors->first('organization') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" id="designation" class="form-control" name="designation" value="{{@$studentClassMapping->designation}}">
                        @if ($errors->has('designation'))
                            <span class="text-danger">{{ $errors->first('designation') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="mobile_no" class="form-label">Mobile No<span class="text-danger">*</span></label>
                        <input type="text" id="mobile_no" maxlength="10" class="form-control" name="mobile_no" value="{{@$studentClassMapping->mobile_no}}">
                        @if ($errors->has('mobile_no'))
                            <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="parent_aadhar_number" class="form-label">Aadhar Number<span class="text-danger">*</span></label>
                        <input type="text" id="parent_aadhar_number" class="form-control" name="parent_aadhar_number" value="{{@$studentClassMapping->parent_aadhar_number}}">
                        @if ($errors->has('parent_aadhar_number'))
                            <span class="text-danger">{{ $errors->first('parent_aadhar_number') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="annual_income" class="form-label">Annual Income (Rs.)<span class="text-danger">*</span></label>
                        <input type="text" id="annual_income" class="form-control" name="annual_income" value="{{@$studentClassMapping->annual_income}}">
                        @if ($errors->has('annual_income'))
                            <span class="text-danger">{{ $errors->first('annual_income') }}</span>
                        @endif
                    </div>
                    <div class="col-6 mb-1">
                        <label for="office_contact_number" class="form-label">Office Contact Number with extn. (if any)</label>
                        <input type="text" id="office_contact_number" class="form-control" name="office_contact_number" value="{{@$studentClassMapping->office_contact_number}}">
                        @if ($errors->has('office_contact_number'))
                            <span class="text-danger">{{ $errors->first('office_contact_number') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="mention_relationship" class="form-label">If Guardian, then mention the relationship with the pupil -</label>
                        <input type="text" id="mention_relationship" class="form-control" name="mention_relationship" value="{{@$studentClassMapping->mention_relationship}}">
                        @if ($errors->has('mention_relationship'))
                            <span class="text-danger">{{ $errors->first('mention_relationship') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="" class="form-label">Do you need transport facility : </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transport_facility" value="Yes" id="inlineCheckbox1" {{@$studentClassMapping->transport_facility == "Yes" ? "checked":""}}>
                            <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="transport_facility" type="radio" value="No" id="inlineCheckbox2" {{@$studentClassMapping->transport_facility == "No" ? "checked":""}}>
                            <label class="form-check-label" for="inlineCheckbox2">No</label>
                        </div>
                        @if ($errors->has('transport_facility'))
                            <span class="text-danger">{{ $errors->first('transport_facility') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="route" class="form-label">Route </label>
                        <textarea id="route" class="form-control" rows="4" name="route">{{@$studentClassMapping->route}} </textarea>
                        @if ($errors->has('route'))
                            <span class="text-danger">{{ $errors->first('route') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-4">
                        <label for="email_address" class="form-label">E-Mail<span class="text-danger">*</span></label>
                        <input type="text" id="email_address" disabled class="form-control" name="email"  value="{{@$studentClassMapping->email}}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-12">
                        <a type="button" href="javascript:void(0)" onclick="reload()" id="reset" class="btn btn-secondary btn-sm">Clear</a>
                        <button type="submit" id="save" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function (e) {
        DynamictrtdBind();

        $("#preview-image-before-upload").click(function(){
            $("#image").click();
        });

        var class_id = $('#class_id').val();
        if(class_id){
            $('#class_id').trigger('change');
            setTimeout(function() {
                $('#section_id').val("{{@$studentClassMapping->section_id}}")
            }, 1500);
        }

        $("#image").change(function(event){
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview-image-before-upload").attr("src", e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });


        $("#addRow").on("click", function () {
            let tableBody = $("#tableBody");
            let lastRow = tableBody.find("tr.dynamicRow").last();

            if (lastRow.length) {
                let newRow = `
                    <tr class="dynamicRow">
                        <td><input type="text" class="form-control" name="school_name[]"></td>
                        <td><input type="text" class="form-control" name="academic_session[]"></td>
                        <td><input type="text" class="form-control" name="class[]"></td>
                        <td><input type="text" class="form-control" name="second_language[]"></td>
                        <td><button type="button" class="btn btn-danger btn-sm removeRow">Remove</button></td>
                    </tr>
                `;
                tableBody.append(newRow);
            }
        });


        document.getElementById("tableBody").addEventListener("click", function(e) {
            if (e.target.classList.contains("removeRow")) {
                e.target.closest("tr").remove();
            }
        });


    });

    function DynamictrtdBind() {
        var school_name = {!! json_encode(@$studentClassMapping->school_name) !!} || [];
        var academic_session = {!! json_encode(@$studentClassMapping->academic_session) !!} || [];
        var class_data = {!! json_encode(@$studentClassMapping->class) !!} || []; 
        var second_language = {!! json_encode(@$studentClassMapping->second_language) !!} || [];

        var school_name_data = JSON.parse(school_name);
        var academic_session_data = JSON.parse(academic_session);
        var class_data_data = JSON.parse(class_data);
        var second_language_data = JSON.parse(second_language);


        if (school_name_data.length > 0 || academic_session_data.length > 0 || class_data_data.length > 0 || second_language_data.length > 0) {
            let tableBody = $("#tableBody");
            let lastRow = tableBody.find("tr.dynamicRow").last();
            if (lastRow.length) {
                lastRow.remove();
            }
            for (let index = 0; index < school_name_data.length; index++) {
                let newRow = `
                    <tr class="dynamicRow">
                        <td><input type="text" class="form-control" name="school_name[]" value="`+school_name_data[index]+`"></td>
                        <td><input type="text" class="form-control" name="academic_session[]" value="`+academic_session_data[index]+`"></td>
                        <td><input type="text" class="form-control" name="class[]" value="`+class_data_data[index]+`"></td>
                        <td><input type="text" class="form-control" name="second_language[]" value="`+second_language_data[index]+`"></td>
                        <td><button type="button" class="btn btn-danger btn-sm removeRow">Remove</button></td>
                    </tr>
                `;
                tableBody.append(newRow);
            }
        }
    }
</script>
@endsection