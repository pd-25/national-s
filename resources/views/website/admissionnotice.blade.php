@extends('website.layouts.main')
@push('title', 'Admission Notice')
@section("web-content")

<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('{{asset("assets/website/images/inner-banner8.jpg")}}');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>Admission Notice</h1>
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
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing and more recently with desktop publishing software.</p>
          <ul class="notice-list">
            @if (!@empty(GetAdmissionnotice()))
                    @foreach (GetAdmissionnotice() as $item)
                        <li><img class="mr-2" src="{{asset('assets/website/images/right-arrow.png')}}"><span>{{date('M d Y', strtotime(@$item->admi_notice_date))}} :</span> {{@$item->admi_notice_name}}</li>
                    @endforeach
            @endif
          </ul>
          </div>
      </div>
      
    </div>
  </section>
@endsection