@extends('admin.layout.admin_main')
@section('content')
<div class="pagetitle">
    <h1>Admission</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.studentList') }}">Manage Student's</a></li>
            <li class="breadcrumb-item active">Admission</li>
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
            <form action="{{route('student.storeStudentDetails')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label class="form-label mr-2">Admission Number:</label>
                        <span class="fw-bold">{{generateAdmissionNumber()}}</span>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label mr-2">Date:</label>
                        <span>{{date('d-m-Y')}}</span>
                    </div>
                    <div class="col-6">
                        <img src="/assets/website/images/logo.png" class="img-fluid" style="height:100px;">
                    </div>
                    <div class="col-6 text-end">
                        <div class="image-upload-wrapper">
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
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <h4 class="text-uppercase fw-bold">Student's Profile</h4>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="student_name" class="form-label">Name of Pupil(In Capital Letters)<span class="text-danger">*</span></label>
                        <input type="text" id="student_name" class="form-control text-uppercase" name="student_name" required value="{{old('student_name')}}" required>
                        @if ($errors->has('student_name'))
                            <span class="text-danger">{{ $errors->first('student_name') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="" class="form-label">Admission sought for the class: <span class="text-danger">*</span></label>
                        <select name="class_id" id="class_id" class="form-select" required>
                            <option value="">Select Class</option>
                            @if (!@empty(GetClasses()))
                                @foreach (GetClasses() as $index=>$item)
                                    <option value="{{@$item->id}}">{{@$item->class_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('class_id'))
                            <span class="text-danger">{{ $errors->first('class_id') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="" class="form-label">Academic Section: <span class="text-danger">*</span></label>
                        <select name="section_id" id="section_id" class="form-select" required>
                            <option value="">Select Section</option>
                        </select>
                        @if ($errors->has('section_id'))
                            <span class="text-danger">{{ $errors->first('section_id') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="" class="form-label">Academic Year: <span class="text-danger">*</span></label>
                        <select name="session_id" id="session_id" class="form-select" required>
                            @if (!@empty(GetSession('all_session')))
                                @foreach (GetSession('all_session') as $index=>$item)
                                    <option value="{{@$item->id}}" {{$item->status == 1 ? 'selected': ''}} >{{@$item->sessions_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('session_id'))
                            <span class="text-danger">{{ $errors->first('session_id') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="date_of_birth" class="form-label">Date of Birth: <span class="text-danger">*</span></label>
                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{old('date_of_birth')}}" required>
                        @if ($errors->has('date_of_birth'))
                            <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="aadhar_no" class="form-label"> Aadhar No: </label>
                        <input type="text" id="aadhar_no" class="form-control" maxlength="12" name="aadhar_no"  value="{{old('aadhar_no')}}" >
                        @if ($errors->has('aadhar_no'))
                            <span class="text-danger">{{ $errors->first('aadhar_no') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="nationality" class="form-label"> Nationality: </label>
                        <input type="text" id="nationality" class="form-control" name="nationality"  value="{{old('nationality')}}" >
                        @if ($errors->has('nationality'))
                            <span class="text-danger">{{ $errors->first('nationality') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="religion" class="form-label"> Religion: </label>
                        <select name="religion" class="form-select" id="religion" >
                            <option value="{{$item['name']}}">Select Religion</option>
                            @foreach (Religion() as $item)
                                <option value="{{$item['name']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('religion'))
                            <span class="text-danger">{{ $errors->first('religion') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="gender" class="form-label"> Gender: </label>
                        <select name="gender" class="form-select" id="gender" >
                            <option value="{{$item['name']}}">Select Gender</option>
                            @foreach (Gender() as $item)
                                <option value="{{$item['name']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="caste" class="form-label"> Caste: </label>
                        <select name="caste" class="form-select" id="caste" >
                            <option value="{{$item['name']}}">Select Caste</option>
                            @foreach (Caste() as $item)
                                <option value="{{$item['name']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('caste'))
                            <span class="text-danger">{{ $errors->first('caste') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                        <textarea id="address" class="form-control" rows="4" required name="address">{{old('address')}} </textarea>
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="pin_code" class="form-label">Pin Code: <span class="text-danger">*</span></label>
                        <input type="number" id="pin_code" class="form-control" required name="pin_code"  value="{{old('pin_code')}}">
                        @if ($errors->has('pin_code'))
                            <span class="text-danger">{{ $errors->first('pin_code') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="mother_tongue" class="form-label">Mother Tongue: </label>
                        <input type="text" id="mother_tongue" class="form-control"  name="mother_tongue" value="{{old('mother_tongue')}}">
                        @if ($errors->has('mother_tongue'))
                            <span class="text-danger">{{ $errors->first('mother_tongue') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="blood_group" class="form-label">Blood Group: </label>
                        <select name="blood_group" class="form-select" id="blood_group" >
                            <option value="{{$item['name']}}">Select Blood Group</option>
                            @foreach (BloodGroup() as $item)
                                <option value="{{$item['name']}}">{{$item['name']}}</option>
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
                            <input class="form-check-input" name="stream" type="checkbox" value="Science" id="flexCheckScience">
                            <label class="form-check-label" for="flexCheckScience">
                                Science
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" name="stream" type="checkbox" value="Commerce" id="flexCheckCommerce">
                            <label class="form-check-label" for="flexCheckCommerce">
                                Commerce
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" name="stream" type="checkbox" value="Humanities" id="flexCheckHumanities">
                            <label class="form-check-label" for="flexCheckHumanities">
                                Humanities  
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" name="stream" type="checkbox" value="Combination" id="flexCheckCombination">
                            <label class="form-check-label" for="flexCheckCombination">
                                Combination
                            </label>
                        </div>
                        <div class="me-3">
                            <input type="text" class="form-control" name="combination_text" placeholder="Enter Combination stream">
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
                                <tr>
                                    <td><input type="text" class="form-control" name="school_name[]"></td>
                                    <td><input type="text" class="form-control" name="academic_session[]"></td>
                                    <td><input type="text" class="form-control" name="class[]"></td>
                                    <td><input type="text" class="form-control" name="second_language[]"></td>
                                    <td><button type="button" class="btn btn-danger btn-sm removeRow">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary my-2 btn-sm" id="addRow">Add Row</button>
                    </div>
                    <div class="col-12 my-3">
                        <h4>Achievements of your child :</h4>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="achievements" class="form-label">Please mention the achievements, if any, of your child in academics / co-curricular activities :</label>
                        <textarea id="achievements" class="form-control" rows="4" name="achievements">{{old('achievements')}} </textarea>
                        @if ($errors->has('achievements'))
                            <span class="text-danger">{{ $errors->first('achievements') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="previous_school_info" class="form-label">Please mention, in brief, if there is any history of previous illness :</label>
                        <textarea id="previous_school_info" class="form-control" rows="4" name="previous_school_info">{{old('previous_school_info')}} </textarea>
                        @if ($errors->has('previous_school_info'))
                            <span class="text-danger">{{ $errors->first('previous_school_info') }}</span>
                        @endif
                    </div>
                    <div class="col-12 my-3">
                        <h4>PARENTS' / GUARDIAN'S PROFILE:</h4>
                    </div>
                    <div class="col-4 mb-2">
                        <label for="parent_name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" id="parent_name" class="form-control" name="parent_name" required value="{{old('parent_name')}}">
                        @if ($errors->has('parent_name'))
                            <span class="text-danger">{{ $errors->first('parent_name') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-2">
                        <label for="parent_relation" class="form-label">Relation <span class="text-danger">*</span></label>
                        <select name="parent_relation" class="form-select" id="parent_relation" required>
                            <option value="{{$item['name']}}">Select Relation</option>
                            @foreach (Relation() as $item)
                                <option value="{{$item['name']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent_relation'))
                            <span class="text-danger">{{ $errors->first('parent_relation') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" id="qualification" class="form-control"  name="qualification" value="{{old('qualification')}}">
                        @if ($errors->has('qualification'))
                            <span class="text-danger">{{ $errors->first('qualification') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" id="occupation"  class="form-control" name="occupation" value="{{old('occupation')}}">
                        @if ($errors->has('occupation'))
                            <span class="text-danger">{{ $errors->first('occupation') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="organization" class="form-label">Organization</label>
                        <input type="text" id="organization" class="form-control" name="organization" value="{{old('organization')}}">
                        @if ($errors->has('organization'))
                            <span class="text-danger">{{ $errors->first('organization') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" id="designation" class="form-control" name="designation" value="{{old('designation')}}">
                        @if ($errors->has('designation'))
                            <span class="text-danger">{{ $errors->first('designation') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="mobile_no" class="form-label">Mobile No</label>
                        <input type="text" id="mobile_no"  maxlength="10" class="form-control" name="mobile_no" value="{{old('mobile_no')}}">
                        @if ($errors->has('mobile_no'))
                            <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="parent_aadhar_number" class="form-label">Aadhar Number</label>
                        <input type="text" id="parent_aadhar_number"  class="form-control" maxlength="12" name="parent_aadhar_number" value="{{old('parent_aadhar_number')}}">
                        @if ($errors->has('parent_aadhar_number'))
                            <span class="text-danger">{{ $errors->first('parent_aadhar_number') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-1">
                        <label for="annual_income" class="form-label">Annual Income (Rs.)</label>
                        <input type="number" id="annual_income"  class="form-control" name="annual_income" value="{{old('annual_income')}}">
                        @if ($errors->has('annual_income'))
                            <span class="text-danger">{{ $errors->first('annual_income') }}</span>
                        @endif
                    </div>
                    <div class="col-6 mb-1">
                        <label for="office_contact_number" class="form-label">Office Contact Number with extn. (if any)</label>
                        <input type="text" id="office_contact_number" class="form-control" name="office_contact_number" value="{{old('office_contact_number')}}">
                        @if ($errors->has('office_contact_number'))
                            <span class="text-danger">{{ $errors->first('office_contact_number') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="mention_relationship" class="form-label">If Guardian, then mention the relationship with the pupil -</label>
                        <input type="text" id="mention_relationship" class="form-control" name="mention_relationship" value="{{old('mention_relationship')}}">
                        @if ($errors->has('mention_relationship'))
                            <span class="text-danger">{{ $errors->first('mention_relationship') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="" class="form-label">Do you need transport facility : </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transport_facility" value="Yes" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="transport_facility" type="radio" value="Yes" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">No</label>
                        </div>
                        @if ($errors->has('transport_facility'))
                            <span class="text-danger">{{ $errors->first('transport_facility') }}</span>
                        @endif
                    </div>
                    <div class="col-12 mb-1">
                        <label for="route" class="form-label">Route </label>
                        <textarea id="route" class="form-control" rows="4" name="route">{{old('route')}} </textarea>
                        @if ($errors->has('route'))
                            <span class="text-danger">{{ $errors->first('route') }}</span>
                        @endif
                    </div>
                    <div class="col-4 mb-4">
                        <label for="email_address" class="form-label">E-Mail</label>
                        <input type="text" id="email_address" class="form-control text-lowercase" name="email"  value="{{old('email')}}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label d-flex justify-content-between"><div>Password </div>
                            <div><i class="bi bi-magic fs-5 text-primary" onclick="generatePassword()"></i></div>
                        </label>
                        <input type="password" id="password" class="form-control showPassword" name="password" >
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <div class="form-check">
                            <input class="form-check-input" onclick="myShowPassword()" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Show Password
                            </label>
                          </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" class="form-control showPassword" name="password_confirmation" >
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-12">
                        <a type="button" href="javascript:void(0)" onclick="reload()" id="reset" class="btn btn-secondary">Clear</a>
                        <button type="submit" id="save" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function (e) {
        $("#preview-image-before-upload").click(function(){
            $("#image").click();
        });

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

        document.getElementById("addRow").addEventListener("click", function() {
            let tableBody = document.getElementById("tableBody");
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td><input type="text" class="form-control" name="school_name[]"></td>
                <td><input type="text" class="form-control" name="academic_session[]"></td>
                <td><input type="text" class="form-control" name="class[]"></td>
                <td><input type="text" class="form-control" name="second_language[]"></td>
                <td><button type="button" class="btn btn-danger btn-sm removeRow">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
        });

        document.getElementById("tableBody").addEventListener("click", function(e) {
            if (e.target.classList.contains("removeRow")) {
                e.target.closest("tr").remove();
            }
        });


    });
</script>
@endsection