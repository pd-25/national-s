@extends('website.layouts.main')
@push('title', 'Contact us')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <div class="carousel-inner" role="listbox"> 
            <div class="carousel-item active" style="background-image: url('assets/website/images/inner-banner13.jpg');">
            <canvas id="canvas"></canvas>
            <div class="carousel-caption">
                <h1>Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="inn-pg-section">
    <div class="container">
       <div class="row justify-content-between">
          <div class="col-lg-5">
             <div class="contact-info-bx">
                <h2>Address:</h2>
                <p class="mb-5">We appreciate feedback and interaction of any sort so please feel free to get in touch.</p>
                <div class="media contact-info-bx mb-lg-5 mb-3">
                   <i class="fa fa-map-marker mr-2" aria-hidden="true"></i>
                   <div class="media-body align-self-center">
                      <h5 class="mt-0">Address</h5>
                      <p class="mb-0">91/A/7, B. L. Saha Road, kolkata 700053</p>
                   </div>
                </div>
                <div class="media contact-info-bx mb-lg-5 mb-3">
                   <i class="fa fa-clock-o mr-2" aria-hidden="true"></i>
                   <div class="media-body align-self-center">
                      <h5 class="mt-0">Work Time:</h5>
                      <p class="mb-0">Mon - Fri 9 AM - 5 PM & Sat : 8AM-2PM</p>
                   </div>
                </div>
                <div class="media contact-info-bx mb-lg-5 mb-3">
                   <i class="fa fa-phone mr-2" aria-hidden="true"></i>
                   <div class="media-body align-self-center">
                      <h5 class="mt-0">Call:</h5>
                      <p class="mb-0"><a href="tel:9163741069">9163741069</a> / <a href="tel:03335765184">033-35765184</a></p>
                   </div>
                </div>
                <div class="media contact-info-bx mb-3">
                   <i class="fa fa-envelope mr-2" aria-hidden="true"></i>
                   <div class="media-body align-self-center">
                      <h5 class="mt-0">Email:</h5>
                      <p class="mb-0"><a href="mailto:info@npskolkata.com">info@npskolkata.com</a></p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-lg-7">
             <div class="contact-fm-bx">
                <h3 class="mb-lg-5">Get In Touch With Us</h3>
                @include('website.layouts.message')
                <form role="form" action="{{route('web.contact.store')}}" method="post" id="contact-form">
                   @csrf
                   @method('POST')
                    <div class="controls">
                      <div class="row mb-3">
                         <div class="col-lg-6">
                            <div class="form-group">
                               <input type="text" required="required" placeholder="First Name*" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}">
                            </div>
                            @error('first_name')
                                <span class="error" role="alert">
                                    {{ $first_name }}
                                </span>
                            @enderror
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                               <input type="text" required="required" placeholder="Last Name*" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}">
                            </div>
                            @error('last_name')
                                <span class="error" role="alert">
                                    {{ $last_name }}
                                </span>
                            @enderror
                         </div>
                      </div>
                      <div class="row mb-3">
                         <div class="col-lg-6">
                            <div class="form-group">
                               <input type="email" required="required" placeholder="Email*" class="form-control" name="email" id="email" value="{{old('email')}}">
                            </div>
                            @error('email')
                                <span class="error" role="alert">
                                    {{ $email }}
                                </span>
                            @enderror
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                               <input type="tel" required="required" minlength="10" maxlength="10" placeholder="Phone Number*" class="form-control" name="phone_no" id="form_phone" value="{{old('phone_no')}}">
                            </div>
                            @error('phone_no')
                                <span class="error" role="alert">
                                    {{ $phone_no }}
                                </span>
                            @enderror
                         </div>
                      </div>
                      <div class="row mb-2">
                         <div class="col-lg-12">
                            <div class="form-group">
                               <textarea id="form_message" name="message" class="form-control" placeholder="Message..." rows="3" required="required" data-error="Please,leave us a message.">{{old('message')}}</textarea>
                            </div>
                            @error('message')
                                <span class="error" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-lg-12 mt-2">
                            <button type="submit" class="banner-btn">Submit Now</button>
                         </div>
                      </div>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </section>
@endsection
@push('web-script')
    
@endpush
