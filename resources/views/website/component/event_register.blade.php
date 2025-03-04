<form id="news-form" method="post" action="{{route('web.eventsregister')}}" role="form" class="mt-lg-5">
    @csrf
    <div class="controls">
       <div class="row">
          <div class="col-lg-12">
            <input type="hidden" name="event_id" value="{{$events->id}}">
             <div class="form-group">
                <label>Email*</label>
                <input type="email" name="email" class="form-control" placeholder="You Email Address" required data-error="required.">
                @error('email')
                    <span class="error" role="alert">
                        {{ $email }}
                    </span>
                @enderror
             </div>
          </div>
          <div class="col-lg-12">
             <div class="form-group">
                <label>Candidate Name*</label>
                <input type="text" name="name" class="form-control" placeholder="Your answer" required data-error="required.">
                @error('name')
                    <span class="error" role="alert">
                        {{ $name }}
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-12">
             <div class="form-group">
                <label>Date of Birth*</label>
                <input type="date" name="date" class="form-control" placeholder="" required data-error="required." value="{{date('Y-m-d')}}">
                @error('date')
                    <span class="error" role="alert">
                        {{ $date }}
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-12">
             <div class="form-group">
                <label>School Name*</label>
                <input type="text" name="school_name" class="form-control" placeholder="Your answer" required data-error="required.">
                @error('school_name')
                    <span class="error" role="alert">
                        {{ $school_name }}
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-12">
             <div class="form-group">
                <label>Class*</label>
                <input type="text" name="class" class="form-control" placeholder="Your answer" required data-error="required.">
                @error('class')
                    <span class="error" role="alert">
                        {{ $class }}
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-12">
             <div class="form-group">
                <label>Father's Name*</label>
                <input type="text" name="father_name" class="form-control" placeholder="Your answer" required data-error="required.">
                @error('father_name')
                    <span class="error" role="alert">
                        {{ $father_name }}
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-12">
             <div class="form-group">
                <label>Contact Number 1*</label>
                <input type="text" name="contact_number" class="form-control" placeholder="Your answer" required data-error="required.">
                @error('contact_number')
                    <span class="error" role="alert">
                        {{ $contact_number }}
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-12">
             <div class="form-group">
                <label>Contact Number 2</label>
                <input type="text" name="contact_number_ii" class="form-control" placeholder="Your answer"  data-error="required.">
                @error('contact_number_ii')
                    <span class="error" role="alert">
                        {{ $contact_number_ii }}
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
               <label>Pay Amount</label>
               <input type="number" name="amount" class="form-control" required data-error="required.">
               @error('amount')
                    <span class="error" role="alert">
                        {{ $amount }}
                    </span>
                @enderror
            </div>
         </div>
         <input type="hidden" name="status" id="statusInput" value="0">
         <div class="col-lg-12">
             <div class="btn-holder">
                 <button type="button" id="statusToggle" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                     <div class="switch"></div>
                 </button>
             </div>
         </div>
          <div class="col-lg-12">
             <input type="submit" class="form-btn" value="Submit Now">
          </div>
       </div>
    </div>
 </form>
 <script>
     $('#statusToggle').on('click', function() {  
        var isPressed = $(this).attr('aria-pressed') === 'true';
        $(this).attr('aria-pressed', !isPressed);
        $('#statusInput').val(!isPressed ? 1 : 0); 
      });
 </script>