@extends('website.layouts.main')
@push('title', 'Co curricular')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('assets/website/images/inner-banner7.jpg');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>Co-Curricular</h1>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Content -->
  <section id="inn-pg-section">
    <div class="container">
      <div class="row mb-lg-2">
        <div class="col-lg-6 text-center">
        <img src="assets/website/images/Co-Curricular-img.jpg" class="img-fluid w-100 border-radius-10">
        </div>
        <div class="col-lg-6 pl-lg-3 align-self-center">
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
          <ul class="wel-list">
          <li>Dance (classical, western and contemporary)</li>
          <li>Dramatics</li>
          <li>Art</li>
          <li>Craftwork</li>
          <li>Vocal Music</li>
          <li>Percussion ( Drums , Thumba, Djembe, Bongo )</li>
          <li>Instrumental Music( Violin, Guitar, Synthesizer, Mouthorgan )</li>
          <li>Sports & Games ( Basketball, Cricket, Football, Table Tennis, Tennis, Swimming , Taekwondo )</li>
          </ul>
          </div>
      </div>	
       </div>	
      
      <div class="container-lfuid p-0">	
      <div class="row mt-lg-5 pt-lg-5 text-center">
        <div class="col-lg-12 mb-lg-3">
        <h2>Our Gallery</h2>
          <div id="demo-pranab">
            <div id="owl-inn-gallery" class="owl-carousel owl-theme">
              <div class="item">
                <img src="{{asset('assets/website/images/laboratorie-pic1.jpg')}}" class="img-fluid border-radius-10" alt="...">
              </div>
              <div class="item">
                <img src="{{asset('assets/website/images/laboratorie-pic2.jpg')}}" class="img-fluid border-radius-10" alt="...">
              </div>
              <div class="item">
                <img src="{{asset('assets/website/images/librarie-image.jpg')}}" class="img-fluid border-radius-10" alt="...">
              </div>
              <div class="item">
                <img src="{{asset('assets/website/images/general-image.jpg')}}" class="img-fluid border-radius-10" alt="...">
              </div>
              <div class="item">
                <img src="{{asset('assets/website/images/rules-regulations-img.jpg')}}" class="img-fluid border-radius-10" alt="...">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('web-script')
    <script>
        $('#owl-inn-gallery').owlCarousel({
            stagePadding: 150,
            loop:true,
            margin:20,
            dots:true,
            nav:true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive:{
                0:{
                    items:1,
                    stagePadding: 0
                },
                600:{
                    items:1
                },
                1000:{
                    items:2
                }
            }
        })
    </script>
@endpush