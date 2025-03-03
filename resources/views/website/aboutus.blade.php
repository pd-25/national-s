@extends('website.layouts.main')
@push('title', 'About us')
@section("web-content")
<section id="inner-banner-slider" class="banner-slider main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" role="listbox"> 
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('assets/website/images/inner-banner2.jpg');">
          <canvas id="canvas"></canvas>
          <div class="carousel-caption">
            <h1>About Us</h1>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Content -->
  <section id="inn-pg-section">
    <div class="container">
      <div class="row mb-lg-2">
        <div class="col-lg-6">
          <div class="wel-pic-box-one"> <img src="assets/website/images/wel-pic1.jpg" class="img-fluid"> </div>
          <div class="wel-pic-box-two"> <img src="assets/website/images/wel-pic2.jpg" class="img-fluid"> </div>
        </div>
        <div class="col-lg-6 pl-lg-5 align-self-center">
          <h2>National Public School</h2>
          <p><b>National Public School</b> is situated close to Tollygunge metro station and New Alipore. The school is housed in a spacious well lighted three-storeyed building on a sprawling campus it is well equipped with modern amenities, a well-stocked library and state-of-the-art laboratories to nurture and educate students from the pre-primary to high secondary level the curriculum is comprehensive and aims to instil competitive skills and knowledge along with social and ethical values</p>
          <p>Our <b>DIGITAL CURRICULUM</b> and <b>SPACE STUDIES PROGRAM</b> empower our students with the innovative mind set and competence to get success in present and future. Personality development and life skills sessions are conducted to make the students aware of their responsibilities towards each other as well as the society. Annual Health Check up is conducted once in a year by reputed doctors as we believe that a <b>“Healthy Mind”</b> can only reside in a <b>“Healthy Body”</b> In short National Public School stands for world class education and education with fun and all modern amenities.</p>
          </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
          <p>National Public School affiliated to CISCE curriculum. National Public School stands for excellence and continuously set standards. We are equipped with an enormous playground and proper infrastructure to provide quality education. Education has an important role in the life of an individual and it cannot be overstated.</p>
          <p>It shapes individuals <b>FOR THEIR PRESENT AND FUTURE</b> and inculcates values in them that would govern all their choices in life. For me, Education does not mean only being literate. It means being literate in wisdom. My aim is not only to be an able administrator but also to be a friend, philosopher, and guide to students and teachers.</p>
          <p>Our effort is focused not only on pure study but also on providing opportunities to each child to explore his or her own capabilities and area of interest. Each student is special to us, we provide expertise to the children to cross any hurdles that comes in their life.</p>
          <p>National Public School wishes a successful and flourishing future to its students.</p>
          </div>
      </div>
      
    </div>
  </section>
@endsection