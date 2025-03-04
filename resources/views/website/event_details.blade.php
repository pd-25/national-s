@extends('website.layouts.main')
@push('title', 'Event Details')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('{{asset('assets/website/images/inner-banner10.jpg')}}');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>Our Events</h1>
            </div>
        </div>
      </div>
    </div>
  </section>


  <section id="inn-pg-section">
    <div class="container">
    <div class="row">
       <div class="col-lg-6">
          <div class="news-img-box">
             <img src="{{@$events->event_image}}" class="img-fluid border-radius-10">	  
          </div>
       </div>
       <div class="col-lg-6">
          <div class="news-form-box">
             <h2>Registration form- {{@$events->event_name}}</h2>
                @include('website.component.event_register', [$events])
          </div>
       </div>
    </div>
 </section>
@endsection