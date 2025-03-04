@if (!Route::is('web.contact'))
  <section id="top-footer-section">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6 tf_left_area address-box">
                <h2>National Public School, Kolkata</h2>
                <p><b>Address:</b></p>
                <p>91/A/7, B. L. Saha Road, kolkata 700053</p>
                <p><b>Work Time:</b></p>
                <p>Mon - Fri 9 AM - 5 PM & Sat : 8AM-2PM</p>
                <p><b>Call:</b></p>
                <p>9163741069 / 033-35765184</p>
                <p><b>Email:</b></p>
                <p>info@npskolkata.com</p>
            </div>
            <div class="col-lg-6 tf_right_area">
                <h2>Enquiry Form</h2>
                @include('website.layouts.message')
                <form id="home-form" method="post" action="{{route('web.contact.store')}}" role="form">
                  @csrf
                <div class="controls">
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input type="text" required="required" placeholder="First Name" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}">
                     </div>
                     @error('first_name')
                         <span class="error" role="alert">
                             {{ $first_name }}
                         </span>
                     @enderror
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <input type="email" required="required" placeholder="Email" class="form-control" name="email" id="email" value="{{old('email')}}">
                     </div>
                     @error('email')
                         <span class="error" role="alert">
                             {{ $email }}
                         </span>
                     @enderror
                    </div>
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
                    <div class="col-lg-12">
                        <input type="submit" class="form-btn" value="Send Now">
                    </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
  </section>
@endif
<footer id="main_footer">
    <div id="top-footer">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4"> <img src="{{asset('assets/website/images/logo.png')}}" class="img-fluid mb-4">
            <p class="mb-3">Lorem ipsum dolor sitdmet, consectetur adipiscing elit. Faucibus non faucibus non, eleifend non risus. </p>
            <ul class="footer-social">
              <li><a href=""><i class="fa fa-facebook-f" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-3">
            <h4>Quick Links</h4>
            <ul class="footer-menu">
              <li><a href="{{route('web.home')}}">Home</a></li>
              <li><a href="pay-fee-online.html">Pay Fee Online</a></li>
              <li><a href="{{route('web.contact')}}">Contact Us</a></li>
              <li><a href="{{route('web.privacyPolicy')}}">Privacy Policy</a></li>
              <li><a href="{{route('web.termsConditions')}}">Terms & Conditions</a></li>
            </ul>
          </div>
          <div class="col-lg-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d921.5844687517006!2d88.338719!3d22.491503!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a027095fcea7531%3A0xf11d1c7dd974ad88!2sNational%20Public%20School%2CTollygunge%2C%20Sirity%2C%20Behala%2C%20Kolkata%2C%20West%20Bengal%20700041!5e0!3m2!1sen!2sin!4v1739450948063!5m2!1sen!2sin" width="100%" height="280" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-radius-10"></iframe>
          </div>
        </div>
      </div>
    </div>
    <div id="footer-copyright">
      <div class="container">
        <div class="row text-center">
          <div class="col-lg-12">
            <p> Copyright © {{date("Y")}}, National Public School. All Rights Reserved 
                {{-- | Design and Developed By <a href="https://www.webredas.com/">Webredas --}}
                </a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="{{asset('assets/website/js/count_script.js')}}" defer></script> 
  <!-- SmartMenus jQuery plugin --> 
  <script type="text/javascript" src="{{asset('assets/website/addons/jquery.smartmenus.js')}}"></script> 
  <!-- SmartMenus jQuery Bootstrap 4 Addon --> 
  <script type="text/javascript" src="{{asset('assets/website/addons/jquery.smartmenus.bootstrap-4.js')}}"></script> 
  <script src="{{asset('assets/website/js/script.js')}}" defer></script> 
  <script src="{{asset('assets/website/owl-carousel/js/owl.carousel.js')}}"></script> 
  <script src="{{asset('assets/website/js/jquery.accordable.min.js')}}"></script> 
  <!-- End Owl pranab--> 
  <script>
    $(document).ready(function(){
        $(".faq-btn").click(function(){
            $(".accordion-wrapper").toggle();
          });
       
        var owl = $('#owl-gallery');
        owl.owlCarousel({
            items: 4,
            loop: true,
            nav:false,
            dots:false,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive:{
          0:{
              items:1
          },
          600:{
              items:2
          },
          1000:{
              items:4
          }
        }
            });
            $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [2000])
            })
            $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
            })


            var owl = $('#owl-facilities');
            owl.owlCarousel({
                items: 3,
                loop: true,
                nav:true,
                dots:false,
                margin: 0,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
                });
                $('.play').on('click', function() {
                  owl.trigger('play.owl.autoplay', [2000])
                })
                $('.stop').on('click', function() {
                  owl.trigger('stop.owl.autoplay')
                })

            (function(){
            
                $('#accordable-example-one').accordable({
                    openPanel: [1]
                });
                
                $('#accordable-example-two').accordable({
                    openPanel: [1],
                    //closeAll: false
                });	
            })();
    });
  </script>