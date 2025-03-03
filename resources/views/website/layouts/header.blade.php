<header id="main-header" class="header">
    <div id="top-header">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-3">
            <div class="top-header-left"> <i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:info@npskolkata.com">info@npskolkata.com</a> </div>
          </div>
          <div class="col-lg-6 text-center">
            <div class="top-header-center"> <i class="fa fa-map-marker" aria-hidden="true"></i> 91/ A/7,B .L Saha Road, Kolkata, India, 700053 </div>
          </div>
          <div class="col-lg-3">
            <div class="top-header-right"> <i class="fa fa-phone" aria-hidden="true"></i> <span><a href="tel:+9163741069">+9163741069</a></span>/<span><a href="tel:03335765184">033-35765184</a></span> </div>
          </div>
        </div>
      </div>
    </div>
    <div id="second-header">
      <div class="container-fluid px-lg-5">
        <div class="row">
          <div class="col-lg-2 col-4">
            <div class="logo"> <img src="{{asset('assets/website/images/logo.png')}}" class="img-fluid"> </div>
          </div>
          
          <!-- Section: Navbar Menu -->
          <div class="col-lg-10 col-8">
            <nav class="navbar navbar-expand-lg navbar-light mainmenu">
              <button aria-label="Toggle navigation" aria-expanded="false" aria-controls="navbarNav" data-target="#navbarNav" data-toggle="collapse" type="button" class="navbar-toggler"> <span class="navbar-toggler-icon"></span> </button>
              <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="nav navbar-nav ml-auto mt-3">
                  <li class="nav-item {{Route::is('web.home') ? 'active' : '' }}"> <a href="{{route('web.home')}}" class="nav-link">Home</a> </li>
                  <li class="nav-item {{Route::is('web.general') ? 'active' : '' }} {{Route::is('web.aboutus') ? 'active' : '' }}  {{Route::is('web.principalsdesk') ? 'active' : '' }} dropdown"><a class="nav-link dropdown-toggle" href="#">Infrastructure</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a href="{{route('web.general')}}" class="nav-link">General</a></li>
                      <li class="nav-item"><a href="{{route('web.aboutus')}}" class="nav-link">About Us</a></li>
                      <li class="nav-item"><a href="{{route('web.principalsdesk')}}" class="nav-link">Principal’s Desk</a></li>
                    </ul>
                  </li>
                  <li class="nav-item {{Route::is('web.schooltimings') ? 'active' : '' }}  {{Route::is('web.schooluniform') ? 'active' : '' }}  {{Route::is('web.rulesregulations') ? 'active' : '' }} dropdown"><a class="nav-link dropdown-toggle" href="#">Academics</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a href="{{route('web.schooltimings')}}" class="nav-link">School Timings</a></li>
                      <li class="nav-item"><a href="{{route('web.schooluniform')}}" class="nav-link">School Uniform</a></li>
                      <li class="nav-item"><a href="{{route('web.rulesregulations')}}" class="nav-link">Rules & Regulations</a></li>
                    </ul>
                  </li>
                  <li class="nav-item {{Route::is('web.cocurricular') ? 'active' : '' }} "> <a href="{{route('web.cocurricular')}}" class="nav-link">Co-Curricular</a> </li>

                  <li class="nav-item {{Route::is('web.admissionnotice') ? 'active' : '' }} dropdown"><a class="nav-link dropdown-toggle" href="#">Admission</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a href="apply-online.html" class="nav-link">Apply Online</a></li>
                      <li class="nav-item"><a href="{{route('web.admissionnotice')}}" class="nav-link">Admission Notice</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown {{Route::is('web.news') ? 'active' : '' }} {{Route::is('web.notice') ? 'active' : '' }} "><a class="nav-link dropdown-toggle" href="events.html">News & Events</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a href="{{route('web.news')}}" class="nav-link">News</a></li>
                      <li class="nav-item"><a href="events.html" class="nav-link">Events</a></li>
                      <li class="nav-item"><a href="{{route('web.notice')}}" class="nav-link">Notice</a></li>
                    </ul>
                  </li>
                  <li class="nav-item {{Route::is('web.contact') ? 'active' : '' }}"> <a href="{{route('web.contact')}}" class="nav-link">Contact Us</a> </li>
                  <li class="nav-item"> <a href="pay-fee-online.html" class="nav-link menu-btn">Pay Fee Online</a> </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>