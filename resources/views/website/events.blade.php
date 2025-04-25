@extends('website.layouts.main')
@push('title', "Event's")
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('assets/website/images/inner-banner11.jpg');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>Our Events</h1>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Content -->
  <section id="inn-pg-section">
    <div class="container">
        <div class="row">
          @if (!@empty(GetEvents()))
            @foreach (GetEvents() as $item)
              <div class="col-lg-4 col-md-6 col-sm-12">
                  <article class="blog-box">
                      <div class="blog-img-box">
                          <img src="{{@$item->event_image}}" class="img-fluid border-radius-10" alt="Event Image - Art Olympia">	  
                      </div>
                      <div class="blog-post-box">
                          <h2>{{@$item->event_name}}</h2>
                          <ul class="blog-dtl">
                              <li><span><i class="fa fa-calendar" aria-hidden="true"></i></span>{{date('M d Y', strtotime(@$item->event_date))}}</li>
                          </ul>
                          <p>{{ Str::words(@$item->event_desc, 15) }}.</p>
                          <a href="{{route('web.events.edit', @$item->event_slug)}}" class="rm-btn">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                      </div>
                  </article>
                </div>
              @endforeach
            @endif
        </div> 
    </div>
</section>
@endsection