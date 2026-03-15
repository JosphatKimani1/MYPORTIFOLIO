<section class="contact-section" id="contact-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-md-7 order-2 order-md-1">
                  <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
                     <div class="section-header">
                        <h2 class="section-title">Let’s work together!</h2>
                        <p>I design and code beautifully simple things and i love what i do. Just simple like that!</p>
                     </div>

                     <div class="tj-contact-form">
                        <form method="POST" action="{{ route('store.contact.message') }}">
                           @csrf
                           <div class="row gx-3">
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <input type="text" name="fname" id="conName" placeholder="First name"
                                       autocomplete="off" / required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <input type="text" name="lname" id="conLName" placeholder="Last name"
                                       autocomplete="off" / required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <input type="email" name="email" id="conEmail" placeholder="Email address"
                                       autocomplete="off" / required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <input type="tel" name="phone" id="conPhone" placeholder="Phone number"
                                       autocomplete="off" / required>
                                 </div>
                              </div>

                              @php
                                  $services =App\Models\Service::all();
                              @endphp

                              <div class="col-12">
                                 <div class="form_group">
                                    <select name="service_id" id="conService" class="tj-nice-select" required>
                                       <option value="" selected disabled>Choose Service</option>
                                       @foreach ( $services as  $service)
                                          <option value="{{ $service->id }}">{{ Str::title($service->service_title) }}</option required>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form_group">
                                    <textarea name="description" id="conMessage" placeholder="Description" required></textarea>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form_btn">
                                    <button type="submit" class="btn tj-btn-primary">Send Message</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               @php
                  $siteSettings = App\Models\SiteSettings::findOrFail(1);
               @endphp

               <div class="col-lg-5 offset-lg-1 col-md-5 d-flex flex-wrap align-items-center order-1 order-md-2">
                  <div class="contact-info-list">
                     <ul class="ul-reset">
                        <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight"
                           data-wow-delay=".4s">
                           <div class="icon-box">
                              <i class="flaticon-phone-call"></i>
                           </div>
                           <div class="text-box">
                              <p>Phone</p>
                              <a href="tel:{{ $siteSettings->phone }}">{{ $siteSettings->phone }}</a>
                           </div>
                        </li>
                        <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight"
                           data-wow-delay=".5s">
                           <div class="icon-box">
                              <i class="flaticon-mail-inbox-app"></i>
                           </div>
                           <div class="text-box">
                              <p>Email</p>
                              <a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a>
                           </div>
                        </li>
                        <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight"
                           data-wow-delay=".6s">
                           <div class="icon-box">
                              <i class="flaticon-location"></i>
                           </div>
                           <div class="text-box">
                              <p>Address</p>
                              <a href="#">{!! Str::wordWrap($siteSettings->address, 24, '<br />') !!}</a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>