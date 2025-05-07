<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::guard('admin')->user()->usertype == 1)
            <li class="nav-item {{Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : 'collapsed' }}" href="{{route('admin.dashboard')}}">
                    <i class="bi bi-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-heading">Management</li>
            <li class="nav-item">
                <a href="#" class="nav-link collapsed" data-bs-target="#Attendance-management" data-bs-toggle="collapse">
                    <i class="bi bi-calendar2-minus"></i></i><span>Attendance</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Attendance-management" data-bs-parent="#sidebar-nav"
                    @if (Route::is('attendance.classAttendance') ||
                    Route::is('attendance.studentAttendance') ||
                    Route::is('attendance.takeClassAttendance')
                    )
                    class="nav-content"
                    @else
                    class="nav-content collapse" @endif>
                    <li class="{{ Route::is('attendance.takeClassAttendance') ? 'active' : '' }}" id="">
                        <a href="{{route('attendance.takeClassAttendance')}}" 
                        class="{{ Route::is('attendance.takeClassAttendance') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Take Class Attendance</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('attendance.classAttendance') ? 'active' : '' }}" id="">
                        <a href="{{route('attendance.classAttendance')}}" 
                        class="{{ Route::is('attendance.classAttendance') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Class Attendance</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('attendance.studentAttendance') ? 'active' : '' }}" id="">
                        <a href="{{route('attendance.studentAttendance')}}" 
                        class="{{ Route::is('attendance.studentAttendance') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Student Attendance</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link collapsed" data-bs-target="#Student-management" data-bs-toggle="collapse">
                    <i class="bi bi-person-bounding-box"></i><span>Student's</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Student-management" data-bs-parent="#sidebar-nav"
                    @if (Route::is('student.StudentRegister') ||
                    Route::is('student.studentList') ||
                    Route::is('student.studentEdit') ||
                    Route::is('student.studentView')
                    )
                    class="nav-content"
                    @else
                    class="nav-content collapse" @endif>
                    <li class="{{ Route::is('student.StudentRegister') ? 'active' : '' }}" id="">
                        <a href="{{route('student.StudentRegister')}}" 
                        class="{{ Route::is('student.StudentRegister') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Registration</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('student.studentList') ? 'active' : '' }} {{ Route::is('student.studentEdit') ? 'active' : '' }} {{ Route::is('student.studentView') ? 'active' : '' }} " id="">
                        <a href="{{route('student.studentList')}}" 
                        class="{{ Route::is('student.studentList') ? 'active' : '' }} {{ Route::is('student.studentEdit') ? 'active' : '' }} {{ Route::is('student.studentView') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Manage Student's</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link collapsed" data-bs-target="#Enrollment-management" data-bs-toggle="collapse">
                    <i class="bi bi-person-vcard"></i><span>Enrollment</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Enrollment-management" data-bs-parent="#sidebar-nav"
                    @if (
                    Route::is('student.studentsEntrollment') ||
                    Route::is('student.entrollmentHistory')
                    )
                    class="nav-content"
                    @else
                    class="nav-content collapse" @endif>
                    <li class="{{ Route::is('student.studentsEntrollment') ? 'active' : '' }}" id="">
                        <a href="{{route('student.studentsEntrollment')}}" 
                        class="{{ Route::is('student.studentsEntrollment') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Enrolled New Session</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('student.entrollmentHistory') ? 'active' : '' }}" id="">
                        <a href="{{route('student.entrollmentHistory')}}" 
                        class="{{ Route::is('student.entrollmentHistory') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Enrollment History</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link collapsed" data-bs-target="#FreesDeposit-management" data-bs-toggle="collapse">
                    <i class="bi bi-wallet2"></i><span>Fees Payment</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="FreesDeposit-management" data-bs-parent="#sidebar-nav"
                    @if (Route::is('deposite.index') ||
                    Route::is('deposite.create') ||
                    Route::is('deposite.viewDownloadDeposite') || 
                    Route::is('deposite.edit') ||
                    Route::is('paymentsettings.index')
                    )
                    class="nav-content"
                    @else
                    class="nav-content collapse" @endif>
                    <li class="{{ Route::is('deposite.index') ? 'active' : '' }}" id="">
                        <a href="{{route('deposite.index')}}" 
                        class="{{ Route::is('deposite.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Payment</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('deposite.create') ? 'active' : '' }} {{ Route::is('deposite.viewDownloadDeposite') ? 'active' : '' }}" id="">
                        <a href="{{route('deposite.create')}}" 
                        class="{{ Route::is('deposite.create') ? 'active' : '' }} {{ Route::is('deposite.viewDownloadDeposite') ? 'active' : '' }} {{ Route::is('deposite.edit') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Payment History</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('paymentsettings.index') ? 'active' : '' }}" id="">
                        <a href="{{route('paymentsettings.index')}}" 
                        class="{{ Route::is('paymentsettings.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Payment Settings</span>
                        </a>
                    </li>
                    {{-- <li class="{{ Route::is('deposite.paymentdue') ? 'active' : '' }}" id="">
                        <a href="{{route('deposite.paymentdue')}}" 
                        class="{{ Route::is('deposite.paymentdue') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Payment Due</span>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-heading">Master Management</li>
            <li class="nav-item {{Route::is('ams.manageClasses') ? 'active' : '' }}">
                <a class="nav-link {{ Route::is('ams.manageClasses') ? 'active' : 'collapsed' }}" href="{{route('ams.manageClasses')}}">
                    <i class="bi bi-laptop"></i>
                    <span>Manage Classes</span>
                </a>
            </li>
            <li class="nav-item {{Route::is('ams.manageClassesSections') ? 'active' : '' }}">
                <a class="nav-link {{ Route::is('ams.manageClassesSections') ? 'active' : 'collapsed' }}" href="{{route('ams.manageClassesSections')}}">
                    <i class="bi bi-share"></i>
                    <span>Manage Section</span>
                </a>
            </li>
            <li class="nav-item {{Route::is('ams.manageTeacher') ? 'active' : '' }}">
                <a class="nav-link {{ Route::is('ams.manageTeacher') ? 'active' : 'collapsed' }}" href="{{route('ams.manageTeacher')}}">
                    <i class="bi bi-person-video3"></i>
                    <span>Manage Teachers</span>
                </a>
            </li>
            <li class="nav-item {{Route::is('ams.manageSessionTerm') ? 'active' : '' }}">
                <a class="nav-link {{ Route::is('ams.manageSessionTerm') ? 'active' : 'collapsed' }}" href="{{route('ams.manageSessionTerm')}}">
                    <i class="bi bi-calendar-check"></i>
                    <span>Manage Session</span>
                </a>
            </li>
            <li class="nav-heading">Website Management</li>
            <li class="nav-item">
                <a href="#" class="nav-link collapsed" data-bs-target="#Parties-nav" data-bs-toggle="collapse">
                    <i class="bi bi-browser-chrome"></i><span>Website Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Parties-nav" data-bs-parent="#sidebar-nav"
                    @if (request()->is('admin/all-news')||
                    request()->is('admin/contact-list')||
                    request()->is('admin/all-notice') ||
                    request()->is('admin/all-admission-notice') ||
                    request()->is('admin/all-campus-galary') ||
                    request()->is('admin/all-events')
                    )
                    class="nav-content"
                    @else
                    class="nav-content collapse" @endif>
                    <li class="{{ request()->is('admin/all-campus-galary') ? 'active' : '' }}" id="">
                        <a href="{{route('campusgalary.create')}}" 
                        class="{{ request()->is('admin/all-campus-galary') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Manage Galary Images</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/all-news') ? 'active' : '' }}" id="">
                        <a href="{{route('news.create')}}" 
                        class="{{ request()->is('admin/all-news') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Manage News</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/all-events') ? 'active' : '' }}" id="">
                        <a href="{{route('events.create')}}" 
                        class="{{ request()->is('admin/all-events') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Manage Events</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/all-notice') ? 'active' : '' }}" id="">
                        <a href="{{route('notice.create')}}" 
                        class="{{ request()->is('admin/all-notice') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Manage Notice</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/all-admission-notice') ? 'active' : '' }}" id="">
                        <a href="{{route('admissionnotice.create')}}" 
                        class="{{ request()->is('admin/all-admission-notice') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Manage Admission Notice</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/contact-list') ? 'active' : '' }}"  id="">
                        <a href="{{route('contact.create')}}" class="{{ request()->is('admin/contact-list') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Manage Contact/Enquiry</span>
                        </a>
                    </li>
                </ul>
            </li>
        @elseif(Auth::guard('admin')->user()->usertype == 2)
        <li class="nav-item">
            <a href="#" class="nav-link collapsed" data-bs-target="#Student-management" data-bs-toggle="collapse">
                <i class="bi bi-person-bounding-box"></i><span>Student's</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Student-management" data-bs-parent="#sidebar-nav"
                @if (Route::is('student.StudentRegister') ||
                Route::is('student.studentList') ||
                Route::is('student.studentEdit') ||
                Route::is('student.studentView')
                )
                class="nav-content"
                @else
                class="nav-content collapse" @endif>
                <li class="{{ Route::is('student.StudentRegister') ? 'active' : '' }}" id="">
                    <a href="{{route('student.StudentRegister')}}" 
                    class="{{ Route::is('student.StudentRegister') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Registration</span>
                    </a>
                </li>
                <li class="{{ Route::is('student.studentList') ? 'active' : '' }} {{ Route::is('student.studentEdit') ? 'active' : '' }} {{ Route::is('student.studentView') ? 'active' : '' }} " id="">
                    <a href="{{route('student.studentList')}}" 
                    class="{{ Route::is('student.studentList') ? 'active' : '' }} {{ Route::is('student.studentEdit') ? 'active' : '' }} {{ Route::is('student.studentView') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Manage Student's</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link collapsed" data-bs-target="#Enrollment-management" data-bs-toggle="collapse">
                <i class="bi bi-person-vcard"></i><span>Enrollment</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Enrollment-management" data-bs-parent="#sidebar-nav"
                @if (
                Route::is('student.studentsEntrollment') ||
                Route::is('student.entrollmentHistory')
                )
                class="nav-content"
                @else
                class="nav-content collapse" @endif>
                <li class="{{ Route::is('student.studentsEntrollment') ? 'active' : '' }}" id="">
                    <a href="{{route('student.studentsEntrollment')}}" 
                    class="{{ Route::is('student.studentsEntrollment') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Enrolled New Session</span>
                    </a>
                </li>
                <li class="{{ Route::is('student.entrollmentHistory') ? 'active' : '' }}" id="">
                    <a href="{{route('student.entrollmentHistory')}}" 
                    class="{{ Route::is('student.entrollmentHistory') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Enrollment History</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link collapsed" data-bs-target="#FreesDeposit-management" data-bs-toggle="collapse">
                <i class="bi bi-wallet2"></i><span>Fees Payment</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="FreesDeposit-management" data-bs-parent="#sidebar-nav"
                @if (Route::is('deposite.index') ||
                Route::is('deposite.create') ||
                Route::is('deposite.viewDownloadDeposite') || 
                Route::is('deposite.edit')
                )
                class="nav-content"
                @else
                class="nav-content collapse" @endif>
                <li class="{{ Route::is('deposite.index') ? 'active' : '' }}" id="">
                    <a href="{{route('deposite.index')}}" 
                    class="{{ Route::is('deposite.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Payment</span>
                    </a>
                </li>
                <li class="{{ Route::is('deposite.create') ? 'active' : '' }} {{ Route::is('deposite.viewDownloadDeposite') ? 'active' : '' }}" id="">
                    <a href="{{route('deposite.create')}}" 
                    class="{{ Route::is('deposite.create') ? 'active' : '' }} {{ Route::is('deposite.viewDownloadDeposite') ? 'active' : '' }} {{ Route::is('deposite.edit') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Payment History</span>
                    </a>
                </li>
            </ul>
        </li>
        @else
            <li class="nav-item {{Route::is('teacher.dashboard') ? 'active' : '' }}">
                <a class="nav-link {{ Route::is('teacher.dashboard') ? 'active' : 'collapsed' }}" href="{{route('teacher.dashboard')}}">
                    <i class="bi bi-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{Route::is('student.teacherManageStudent') ? 'active' : '' }}">
                <a class="nav-link {{ Route::is('student.teacherManageStudent') ? 'active' : 'collapsed' }}" href="{{route('student.teacherManageStudent')}}">
                    <i class="bi bi-person-bounding-box"></i>
                    <span>Student's</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link collapsed" data-bs-target="#Student-management" data-bs-toggle="collapse">
                    <i class="bi bi-calendar-check"></i><span>Manage Attendance</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Student-management" data-bs-parent="#sidebar-nav"
                    @if (Route::is('attendance.index') ||
                        Route::is('attendance.show') ||
                        Route::is('attendance.viewstudent')
                    )
                    class="nav-content"
                    @else
                    class="nav-content collapse" @endif>
                    <li class="{{ Route::is('attendance.index') ? 'active' : '' }}" id="">
                        <a href="{{route('attendance.index')}}" 
                        class="{{ Route::is('attendance.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Take Attendance</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('attendance.show') ? 'active' : '' }}" id="">
                        <a href="{{route('attendance.show')}}" 
                        class="{{ Route::is('attendance.show') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>View Class Attendance</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('attendance.viewstudent') ? 'active' : '' }}" id="">
                        <a href="{{route('attendance.viewstudent')}}" 
                        class="{{ Route::is('attendance.viewstudent') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>View student Attendance</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</aside>