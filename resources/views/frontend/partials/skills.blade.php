<section class="skills-section" id="skills-section">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="section-header text-center">
                     <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">My Skills</h2>
                     <p class="wow fadeInUp" data-wow-delay=".4s">
                        We put your ideas and thus your wishes in the form of a unique web project that inspires you and
                        you customers.
                     </p>
                  </div>
               </div>
            </div>

            @php
               $skills = App\Models\Skill::all();
            @endphp

            <div class="row">
               <div class="col-md-12">
                  <div class="skills-widget d-flex flex-wrap justify-content-center align-items-center">
                  @unless (count($skills)==0)
                     @foreach ($skills as $skill)
                     <div class="skill-item wow fadeInUp" data-wow-delay=".3s">
                        <div class="skill-inner">
                           <div class="icon-box">
                              <img src="{{ asset($skill->icon) }}" alt="" />
                           </div>
                           <div class="number">{{$skill->exp_level}}</div>
                        </div>
                        <p>{{$skill->technology_name}}</p>
                     </div>
                     @endforeach
                  @else
                  <p>No Skills Found!! 😒😒😒</p>
                  @endunless

                  </div>
               </div>
            </div>
         </div>
      </section>