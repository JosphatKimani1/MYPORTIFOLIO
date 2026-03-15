@php
    $service_cats = App\Models\Service::all();
    $works =App\Models\Portfolio::Latest()->limit(6)->get();
@endphp

<section class="portfolio-section" id="works-section">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="section-header text-center">
                     <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">My Recent Works</h2>
                     <p class="wow fadeInUp" data-wow-delay=".4s">
                        We put your ideas and thus your wishes in the form of a unique web project that inspires you and
                        you customers.
                     </p>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                  <div class="portfolio-filter text-center wow fadeInUp" data-wow-delay=".5s">
                     <div class="button-group filter-button-group">
                        <button data-filter="*" class="active">All</button>
                        @foreach ($service_cats as $cat)
                            <button data-filter=".{{ Str::replace(' ','-', $cat->service_title) }}">{{ $cat->service_title }}</button>
                        @endforeach
                        <div class="active-bg"></div>
                     </div>
                  </div>

                  <div class="portfolio-box wow fadeInUp" data-wow-delay=".6s">
                     <div class="portfolio-sizer"></div>
                     <div class="gutter-sizer"></div>
                        @foreach ($works as $work)
                           <div class="portfolio-item {{ Str::replace(' ', '-', $work->service?->service_title) }}">
                           <div class="image-box">
                              <img src="{{ asset($work->photo) }}" alt="" />
                           </div>
                           <a href="{{ $work->url }}" target="_blank" style="color: #f3f3f3">
                              <div class="content-box">
                                 <h3 class="portfolio-title"> {{$work->title}} </h3>
                                 <p>{{$work->sub_title}}</p>
                                 <i class="flaticon-up-right-arrow"></i>
                                 {{-- <button data-mfp-src="#portfolio-wrapper" class="portfolio-link modal-popup"></button> --}}
                              </div>
                           </a>
                           </div>
                        @endforeach
                    
                  </div>
               </div>
            </div>
         </div>
      </section>