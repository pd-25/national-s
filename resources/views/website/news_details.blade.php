@extends('website.layouts.main')
@push('title', 'News Details')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('{{asset('assets/website/images/inner-banner10.jpg')}}');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>Our News</h1>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Content -->
  <section id="inn-pg-section">
    <div class="container">
      <div class="row">		
          <div class="col-lg-12">
          <h2>{{@$news->news_title}}</h2>
          <ul class="blog-dtl">
          <li><span><i class="fa fa-calendar" aria-hidden="true"></i></span>{{date('M d Y', strtotime(@$news->news_date))}}</li>
          </ul>
          {!! @$news->news_desc !!}
          
    </div>
  </section>
@endsection