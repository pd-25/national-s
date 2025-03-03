@extends('website.layouts.main')
@push('title', 'News')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('assets/website/images/inner-banner9.jpg');">
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
          @if (!@empty(Getnews()))
              @foreach (Getnews() as $item)
                <div class="col-lg-4">
                    <div class="blog-box">
                        <div class="blog-img-box">
                            <img src="storage/news_images/{{@$item->news_image}}" class="img-fluid border-radius-10">	  
                        </div>
                        <div class="blog-post-box">
                            <h2>{{@$item->news_title}}</h2>
                            <ul class="blog-dtl">
                            <li><span><i class="fa fa-calendar" aria-hidden="true"></i></span>{{date('M d Y', strtotime(@$item->news_date))}}</li>
                            </ul>
                            <p>{!! Str::words(@$item->news_desc, 15) !!}</p>
                            <a href="{{route('web.edit', @$item->news_slug)}}" class="rm-btn">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
              @endforeach
          @endif
        </div>
    </div>
 </section>
@endsection