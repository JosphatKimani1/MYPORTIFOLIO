<section class="resume-section" id="resume-section">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="section-header wow fadeInUp" data-wow-delay=".3s">
                     <h2 class="section-title"><i class="flaticon-recommendation"></i> My Experience</h2>
                  </div>

                  @php
                      $experiences = App\Models\Resume::where('resume_cat', 'experience')->get();
                      $educations = App\Models\Resume::where('resume_cat', 'education')->get();
                  @endphp

                  <div class="resume-widget">

                     @unless(count($experiences)<1)
                        @foreach ($experiences as $experience)
                        <div class="resume-item wow fadeInLeft" data-wow-delay=".4s">
                           <div class="time">{{ $experience->from_year}} - {{ $experience->to_year}}</div>
                           <h3 class="resume-title">{{ $experience->resume_title}}</h3>
                        <div class="institute">{{ $experience->institution}}</div>
                     </div>
                        @endforeach


                     @else 
                        <p>No Experience Found!! 😒😒</p>
                     @endunless
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="section-header wow fadeInUp" data-wow-delay=".4s">
                     <h2 class="section-title"><i class="flaticon-graduation-cap"></i> My Education</h2>
                  </div>

                  <div class="resume-widget">

                     @unless(count($educations)<1)
                        @foreach ($educations as $education)
                        <div class="resume-item wow fadeInLeft" data-wow-delay=".4s">
                           <div class="time">{{ $education->from_year}} - {{ $education->to_year}}</div>
                           <h3 class="resume-title">{{ $education->resume_title}}</h3>
                        <div class="institute">{{ $education->institution}}</div>
                     </div>
                        @endforeach


                     @else 
                        <p>No Education Found!! 😒😒</p>
                     @endunless
                  
                  </div>
               </div>
            </div>
         </div>
      </section>