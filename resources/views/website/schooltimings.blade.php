@extends('website.layouts.main')
@push('title', 'School timings')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('assets/website/images/inner-banner4.jpg');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>School Timings</h1>
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
        <img src="assets/website/images/school-timings-img.jpg" class="img-fluid w-100 border-radius-10">
        </div>
        <div class="col-lg-6 pl-lg-3 align-self-center">
        <h2>What is Lorem Ipsum?</h2>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          </div>
      </div>	
    </div>
  </section>
@endsection