@extends('website.layouts.main')
@push('title', 'Home')
@section("web-content")

<section id="banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <div class="carousel-item active" style="background-image: url('assets/website/images/banner.jpg');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <p class="banner-cap">Best school in town</p>
            <h1>National Public School</h1>
            <a href="contact-us.html" class="banner-btn">Contact Us</a> </div>
        </div>
      </div>
    </div>
</section>
  
<section id="banner-bottom-section">
<div class="container">
    <div class="row">
    <div class="col-lg-4 bb-box-one">
        <div class="banner-btm-box"> <img src="assets/website/images/bb-icon1.png" class="img-fluid">
        <h3>Infrastructure</h3>
        <p>NPS is committed to nurture its students in a happy and holistic... <a href="{{route('web.general')}}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></p>
        </div>
    </div>
    <div class="col-lg-4 bb-box-two">
        <div class="banner-btm-box"> <img src="assets/website/images/bb-icon2.png" class="img-fluid">
        <h3>Admission Notice</h3>
        <p>
            @if (!@empty(GetAdmissionnotice()))
                {{substr(GetAdmissionnotice()[0]->admi_notice_name, 0 , 55)}}... <a href="{{route('web.admissionnotice')}}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></p>
            @endif
        </div>
    </div>
    <div class="col-lg-4 bb-box-three">
        <div class="banner-btm-box"> <img src="assets/website/images/bb-icon3.png" class="img-fluid">
        <h3>Co-Curriculars</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit... <a href="{{route('web.cocurricular')}}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></p>
        </div>
    </div>
    </div>
</div>
</section>

<section id="welcome-section">
<div class="container">
    <div class="row">
    <div class="col-lg-6">
        <div class="wel-pic-box-one"> <img src="assets/website/images/wel-pic1.jpg" class="img-fluid"> </div>
        <div class="wel-pic-box-two"> <img src="assets/website/images/wel-pic2.jpg" class="img-fluid"> </div>
    </div>
    <div class="col-lg-6 pl-lg-5 align-self-center">
        <p class="sec-head">Welcone To</p>
        <h2>National Public School</h2>
        <p><b>National Public School</b> is situated close to Tollygunge metro station and New Alipore. The school is housed in a spacious well lighted three-storeyed building on a sprawling campus it is well equipped with modern amenities, a well-stocked library and state-of-the-art laboratories to nurture and educate students from the pre-primary to high secondary level the curriculum is comprehensive and aims to instil competitive skills and knowledge along with social and ethical values</p>
        <p>Our <b>DIGITAL CURRICULUM</b> and <b>SPACE STUDIES PROGRAM</b> empower our students with the innovative mind set and competence to get success in present and future. </p>
        <a href="{{route('web.aboutus')}}" class="banner-btn">Know More about Us</a> </div>
    </div>
</div>
</section>

<section id="principal-desk-section">
<div class="container">
    <div class="row">
    <div class="col-lg-6 align-self-center">
        <h2>Principal’s Desk</h2>
        <p>National Public School is a symbol of progressive and quality education. Our motto is ” We build the citizens of tomorrow” captures the essence of our spirit. Knowledge and learning are two aspects of human beings which are long run process. We are an institution for a child’s new beginning together with best economic and social infrastructure. Education is not merely requirement of the facts but also of values which help us improve the different facets of mankind. </p>
        <a href="{{route('web.principalsdesk')}}" class="rm-btn">Read More</a> </div>
    <div class="col-lg-6 text-center"> <img src="assets/website/images/principal-image.jpg" class="img-fluid br-100 mb-3">
        <h3>A Successful & Flourishing Future</h3>
        <p class="mb-0">National Public School Students</p>
    </div>
    </div>
</div>
</section>

<section id="why-choose-section">
<div class="container">
    <div class="row">
    <div class="col-lg-12 text-center mb-lg-4">
        <h2>Why Choose Us?</h2>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-4">
        <div class="whyc-box"> <img src="assets/website/images/why-c-icon1.png" class="img-fluid mb-3">
        <h4>Academics</h4>
        <p class="mb-0">Our spacious and well-ventilated classrooms are equipped with advanced technology, including smart boards and interactive whiteboards, to enhance the learning experience.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="whyc-box"> <img src="assets/website/images/why-c-icon2.png" class="img-fluid mb-3">
        <h4>Sports and Recreation</h4>
        <p class="mb-0">Our sports facilities include a football field, basketball court, tennis court, and indoor games room, providing ample opportunities for students to develop their physical skills and teamwork.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="whyc-box"> <img src="assets/website/images/why-c-icon3.png" class="img-fluid mb-3">
        <h4>Technology Enabled Learning</h4>
        <p class="mb-0">Our spacious and well-ventilated classrooms are equipped with advanced technology, including smart boards and interactive whiteboards, to enhance the learning experience.</p>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-4">
        <div class="whyc-box"> <img src="assets/website/images/why-c-icon4.png" class="img-fluid mb-3">
        <h4>Co-Curricular Activities</h4>
        <p class="mb-0">In National Public School a lot of emphasis is given to both indoor and outdoor co curricular activities such as yoga self defence, chess, volley ball, kho kho, kabaddi, table tennis...</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="whyc-box"> <img src="assets/website/images/why-c-icon5.png" class="img-fluid mb-3">
        <h4>Safety and Security</h4>
        <p class="mb-0">The safety and security of our students are paramount. Our campus features CCTV surveillance, access control systems, fire alarms, and emergency exit routes.</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="whyc-box"> <img src="assets/website/images/why-c-icon6.png" class="img-fluid mb-3">
        <h4>Other Amenities</h4>
        <p class="mb-0">Our cafeteria and mess provide nutritious meals and snacks, while our student lounge offers a relaxing space for socialization.</p>
        </div>
    </div>
    </div>
</div>
</section>

<section id="hm-accord-section">
    <div class="container-fluid p-0">
        <div class="row">
        <div class="col-lg-6"> <img src="assets/website/images/hm-accord-pic.jpg" class="img-fluid w-100 br-right"> </div>
        <div class="col-lg-6 pt-lg-5 pl-lg-5 cus-pr align-self-center">
            <h2>We Build Strong Infrastructure For Tomorrow</h2>
            <p class="mb-0">Our effort is focused not only on pure study but also on providing opportunities to each child to explore his or her own capabilities and area of interest. </p>
            <ul id="accordable-example-two" class="accordable">
            <li> <span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Karate Training Classes</span>
                <div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis faucibus urna, quis blandit odio. Suspendisse dapibus ultrices vehicula. Pellentesque ut ligula vel est rutrum ultrices.</p>
                </div>
            </li>
            <li> <span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Football Training Classes</span>
                <div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis faucibus urna, quis blandit odio. Suspendisse dapibus ultrices vehicula. Pellentesque ut ligula vel est rutrum ultrices.</p>
                </div>
            </li>
            <li> <span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Table Tenis Training Classes</span>
                <div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis faucibus urna, quis blandit odio. Suspendisse dapibus ultrices vehicula. Pellentesque ut ligula vel est rutrum ultrices.</p>
                </div>
            </li>
            <li> <span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Yoga Classes</span>
                <div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis faucibus urna, quis blandit odio. Suspendisse dapibus ultrices vehicula. Pellentesque ut ligula vel est rutrum ultrices.</p>
                </div>
            </li>
            <li> <span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Chess Training Classes</span>
                <div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis faucibus urna, quis blandit odio. Suspendisse dapibus ultrices vehicula. Pellentesque ut ligula vel est rutrum ultrices.</p>
                </div>
            </li>
            </ul>
        </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-4">
        <div class="col-lg-3">
            <div class="counter-box"> <span class="num" data-val="15">000</span><span>+</span>
            <p>Average Class Size</p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="counter-box"> <span class="num" data-val="21">000</span><span>+</span>
            <p>Years of Experience</p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="counter-box"> <span class="num" data-val="30">000</span><span>+</span>
            <p>Teachers</p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="counter-box"> <span class="num" data-val="350">000</span><span>+</span>
            <p>Success Students</p>
            </div>
        </div>
        </div>
    </div>
</section>

<section id="facilities-section">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 mb-3">
            <h2>Our Facilities</h2>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-12 mb-4">
            <div id="demo-pranab">
            <div id="owl-facilities" class="owl-carousel owl-theme">
                <div class="item">
                <div class="facilities-box">
                    <div class="facilities-box-img"> <img src="assets/website/images/facilities-img1.jpg" class="img-fluid w-100"> </div>
                    <div class="facilities-box-ctn">
                    <h3>Libraries</h3>
                    <p class="mb-2">In National Public School a lot of emphasis is given to both indoor and outdoor co curricular.</p>
                    </div>
                </div>
                </div>
                <div class="item">
                <div class="facilities-box">
                    <div class="facilities-box-img"> <img src="assets/website/images/facilities-img2.jpg" class="img-fluid w-100"> </div>
                    <div class="facilities-box-ctn">
                    <h3>School Uniform</h3>
                    <p class="mb-2">In National Public School a lot of emphasis is given to both indoor and outdoor co curricular.</p>
                    </div>
                </div>
                </div>
                <div class="item">
                <div class="facilities-box">
                    <div class="facilities-box-img"> <img src="assets/website/images/facilities-img3.jpg" class="img-fluid w-100"> </div>
                    <div class="facilities-box-ctn">
                    <h3>Medical Care</h3>
                    <p class="mb-2">In National Public School a lot of emphasis is given to both indoor and outdoor co curricular.</p>
                    </div>
                </div>
                </div>
                <div class="item">
                <div class="facilities-box">
                    <div class="facilities-box-img"> <img src="assets/website/images/facilities-img1.jpg" class="img-fluid w-100"> </div>
                    <div class="facilities-box-ctn">
                    <h3>Libraries</h3>
                    <p class="mb-2">In National Public School a lot of emphasis is given to both indoor and outdoor co curricular.</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

<section id="news-section">
    <div class="container">
        <div class="row">
        <div class="col-lg-6">
            <h2>Stay Updated, Always!</h2>
        </div>
        <div class="col-lg-6">
            <nav class="tabNav">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist"> <a class="nav-item nav-link active tabBg" id="nav-one-tab" data-toggle="tab" href="#nav-one" role="tab" aria-controls="nav-one" aria-selected="true">news</a> <a class="nav-item nav-link tabBg" id="nav-two-tab" data-toggle="tab" href="#nav-two" role="tab" aria-controls="nav-two" aria-selected="false">events</a> <a class="nav-item nav-link tabBg" id="nav-three-tab" data-toggle="tab" href="#nav-three" role="tab" aria-controls="nav-three" aria-selected="false">Notice</a> </div>
            </nav>
        </div>
        <div class="tab-content col-lg-12" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                <div class="row">
                    <div class="col-lg-6">
                        @if (!@empty(Getnews()))
                            <div class="nws_left_box"> <img src="storage/news_images/{{@Getnews()[0]->news_image}}" class="img-fluid border-radius-10">
                                <h3>{{@Getnews()[0]->news_title}}</h3>
                                <p class="b_date">{{date('d-m-Y', strtotime(@Getnews()[0]->news_date))}}</p>
                                <p>{!! Str::words(@Getnews()[0]->news_desc, 20) !!} </p>
                                @if (@Getnews()[0]->news_slug)
                                    <a href="{{route('web.edit', @Getnews()[0]->news_slug)}}"  class="rm-btn">Read More</a> </div>
                                @endif
                            </div>
                        @endif
                    <div class="col-lg-6 tab_img">
                        <div class="nws_right_box">
                            @if (!@empty(Getnews()))
                                @foreach (@Getnews()->take(3) as $item)
                                    <div class="media"> 
                                        <img src="storage/news_images/{{@$item->news_image}}" class="mr-4 border-radius-10" alt="...">
                                        <div class="media-body align-self-center">
                                            <h5 class="mt-0">{{@$item->news_title}}</h5>
                                            <p class="b_date mb-2">{{date('d-m-Y', strtotime(@$item->news_date))}}</p>
                                                {!! Str::words(@$item->news_desc, 8) !!}
                                            <a href="{{route('web.edit', @$item->news_slug)}}" class="rm-btn-sm">Read More</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                <div class="row">
                    <div class="col-lg-6">
                    @if (!@empty(GetEvents()))
                        <div class="nws_left_box"> <img src="{{@GetEvents()[0]->event_image}}" class="img-fluid border-radius-10">
                            <h3>{{@GetEvents()[0]->event_name}}</h3>
                            <p class="b_date">{{date('d-m-Y', strtotime(@GetEvents()[0]->event_date))}}</p>
                            <p>{!! Str::words(@GetEvents()[0]->event_desc, 20) !!} </p>
                            @if (@GetEvents()[0]->event_slug)
                                <a href="{{route('web.events.edit', @GetEvents()[0]->event_slug)}}" class="rm-btn">Read More</a> </div>
                            @endif
                        </div>
                    @endif
                    <div class="col-lg-6 tab_img">
                    <div class="nws_right_box">
                        @if (!@empty(GetEvents()))
                        @foreach (@GetEvents()->take(3) as $item)
                            <div class="media"> <img src="{{@$item->event_image}}" class="mr-4 border-radius-10" alt="...">
                                <div class="media-body align-self-center">
                                    <h5 class="mt-0">{{@$item->event_name}}</h5>
                                    <p class="b_date mb-2">{{date('M d Y', strtotime(@$item->event_date))}}</p>
                                    <p class="mb-0"> {!! Str::words(@$item->event_desc, 8) !!}</p>
                                    <a href="{{route('web.events.edit', @$item->event_slug)}}" class="rm-btn-sm">Read More</a>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="nws_left_box"> 
                        @if (!@empty(Getnotice()[0]->image))
                            <img src="{{@Getnotice()[0]->image}}" class="img-fluid border-radius-10" alt="...">
                        @else
                            <img src="assets/website/images/scholastic-pic.jpg" class="img-fluid border-radius-10" alt="...">
                        @endif
                        {{-- <h3>Cras Vestibulum Nunc</h3> --}}
                        <p class="b_date">{{date('d-m-Y', strtotime(@Getnotice()[0]->notice_date))}}</p>
                        <p>{{ Str::words(@Getnotice()[0]->notice_name, 20) }}</p>
                        <a href="{{route('web.notice')}}" class="rm-btn">Read More</a> </div>
                    </div>
                    <div class="col-lg-6 tab_img">
                        <div class="nws_right_box">
                            @if (!@empty(Getnotice()))
                                @foreach (@Getnotice()->take(3) as $item)
                                    <div class="media"> 
                                        @if ($item->image)
                                            <img src="{{@$item->image}}" class="mr-4 border-radius-10" alt="...">
                                        @else
                                            <img src="assets/website/images/scholastic-pic.jpg" class="mr-4 border-radius-10" alt="...">
                                        @endif
                                        <div class="media-body align-self-center">
                                            {{-- <h5 class="mt-0">Cras Vestibulum Nunc</h5> --}}
                                            <p class="b_date mb-2">{{date('d-m-Y', strtotime(@$item->notice_date))}}</p>
                                            <p class="mb-0">  {{ Str::words(@$item->notice_name, 8) }} </p>
                                            <a href="{{route('web.notice')}}" class="rm-btn-sm">Read More</a>
                                        </div>
                                    </div>
                                @endforeach
                         @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<section id="gallery-section">
    <div class="container-fluid p-0">
        <div class="row">
        <div class="col-lg-12 mb-3 text-center">
            <h3>Moments to Remember: Campus Gallery</h3>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-12">
            <div id="demo-pranab">
            <div id="owl-gallery" class="owl-carousel owl-theme">
                @if (!@empty(GetCampusGalary()))
                    @foreach (GetCampusGalary() as $item)
                        <div class="item">
                            <div class="gallery-box"><img src="{{@$item->image}}" class="img-fluid" alt="{{@$item->program_name}}"> </div>
                        </div>
                    @endforeach
                @endif
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

@endsection