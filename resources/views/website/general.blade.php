@extends('website.layouts.main')
@push('title', 'General')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <div class="carousel-item active" style="background-image: url('assets/website/images/inner-banner1.jpg');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>Infrastructure</h1>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Content -->
  <section id="inn-pg-section">
    <div class="container">
      <div class="row mb-lg-5">
        <div class="col-lg-6">
         <img src="{{asset('assets/website/images/general-image.jpg')}}" class="img-fluid border-radius-10">
        </div>
        <div class="col-lg-6 pl-lg-5 align-self-center">
          <h2>General</h2>
          <p>NPS is committed to nurture its students in a happy and holistic environment. The School pays attention to minute details of all the facilities so that each and every student is groomed and guided to discover his or her best while in School and when outside it. The stress is on quality learning –of academics as well as co-curricular activities.</p>
          <p>NPS has the most upgraded computer system and software, ensuring a smoother running of School affairs and easing out the communication process amongst all – pupils, teachers and guardians.</p>
          </div>
      </div>
      <hr>
      <div class="row mt-lg-5 mb-lg-5">
         <div class="col-lg-6 pr-lg-5 align-self-center">
          <h2>Libraries</h2>
          <p>NPS students can spend fruitful hours in the spacious, airy and stimulating ambience of their libraries. Here, books of an amazingly wide variety are neatly arranged on the shelves. Students have an enjoyable time seated in the cosy environment while the efficient and qualified librarians go around, guiding the students through thousands of titles.</p>
          </div>
          <div class="col-lg-6">
         <img src="{{asset('assets/website/images/librarie-image.jpg')}}" class="img-fluid border-radius-10">
        </div>
      </div>
      <hr>
      <div class="row mt-lg-5 mb-lg-5">
      <div class="col-lg-12 mb-lg-3">
         <h2>Laboratories</h2>
        </div>
        <div class="col-lg-6">
         <img src="{{asset('assets/website/images/laboratorie-pic1.jpg')}}" class="img-fluid border-radius-10">
        </div>
        <div class="col-lg-6 pl-lg-5 align-self-center">
          <h3>Physics, Chemistry and Biology Laboratories</h3>
          <p>NPS has well-equipped and properly ventilated Physics,Chemistry and Biology laboratories, catering to the need for practical classes for students of Classes XI and XII. Teachers, demonstrators and are always there to guide them and help them learn the subjects hands on through interesting experiments and practical lessons. The Chemistry lab has an elaborate exhaust system, providing a perfectly hygienic environment to everyone. With ample space and scope for work at the labs, students enjoy every step of appreciating and comprehending science. Attention is paid to letting each student make the best use of lab hours.</p>
          </div>
          
        <div class="col-lg-6 pr-lg-5 align-self-center">
          <h3>Computer Lab</h3>
          <p>Computer Laboratories have been set up to provide access to technology and foster better learning for the little ones of Junior classes to Senior classes. Efficient and trained teachers are in charge of the Computer Laboratories to help students learn the use of the latest software.</p>
          </div>
          <div class="col-lg-6">
         <img src="{{asset('assets/website/images/laboratorie-pic2.jpg')}}" class="img-fluid border-radius-10">
        </div>
      </div>
      <hr>
      <div class="row mt-lg-5">
      <div class="col-lg-6">
         <img src="{{asset('assets/website/images/medical-care-image.jpg')}}" class="img-fluid border-radius-10">
        </div>
        <div class="col-lg-6 pr-lg-5 align-self-center">
          <h2>Medical Care</h2>
          <p>The infirmary has comfortable beds and first-aid facilities. We take care of ailing children and provide basic medical assistance. In case of an emergency,  the School informs parents.</p>
          </div>
           
      </div>
    </div>
  </section>
@endsection