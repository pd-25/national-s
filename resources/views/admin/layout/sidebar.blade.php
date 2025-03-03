<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item {{Route::is('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link {{ request()->is('admin.dashboard') ? 'active' : 'collapsed' }}" href="{{route('admin.dashboard')}}">
                <i class="bi bi-house"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{-- <li class="nav-heading">Website Management</li> --}}
         <li class="nav-item">
            <a href="#" class="nav-link collapsed" data-bs-target="#Parties-nav" data-bs-toggle="collapse">
                <i class="bi bi-browser-chrome"></i><span>Website Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Parties-nav" data-bs-parent="#sidebar-nav"
                @if (request()->is('admin/all-news')||
                request()->is('admin/contact-list')||
                request()->is('admin/all-notice') ||
                request()->is('admin/all-admission-notice')
                
                )
                class="nav-content"
                @else
                class="nav-content collapse" @endif>
                <li class="{{ request()->is('admin/all-news') ? 'active' : '' }}" id="">
                    <a href="{{route('news.create')}}" 
                    class="{{ request()->is('admin/all-news') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Manage News</span>
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
    </ul>
</aside>