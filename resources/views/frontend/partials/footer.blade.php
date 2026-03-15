@php
 $siteSettings = App\Models\SiteSettings::findOrFail(1);
@endphp  
  
  <footer class="tj-footer-area">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               <div class="footer-logo-box">
                  <a href="#"><img src="{{ asset($siteSettings->logo) }}" alt="" /></a>
               </div>
               <div class="footer-menu">
                  <nav>
                     <ul>
                        <li><a href="#services-section">Services</a></li>
                        <li><a href="#works-section">Works</a></li>
                        <li><a href="#resume-section">Resume</a></li>
                        <li><a href="#skills-section">Skills</a></li>
                        <li><a href="#testimonials-section">Testimonials</a></li>
                        <li><a href="#contact-section">Contact</a></li>
                     </ul>
                  </nav>
               </div>
               <div class="copy-text">
                  <p>&copy; {{ $siteSettings->footer_note }}</p>
               </div>
            </div>
         </div>
      </div>
   </footer>