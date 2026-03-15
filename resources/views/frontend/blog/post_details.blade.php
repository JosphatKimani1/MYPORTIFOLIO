<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
   <meta charset="utf-8" />
   <meta http-equiv="x-ua-compatible" content="ie=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta name="description" content="Hey there! I’m CPA Kimani Josphat, I studied computer science for 4 years at AL-QALAM University Katsina, graduated in 2022 atfer completing Information Technology Developer (ITD) program at Legacy Computer Institute kaduna. I design and develop services for customers of all sizes, specialized in creating stylish, modern websites / web applications, web services and online stores" />

   <!-- Site Title -->
   <title>{{ config('app.name') }}</title>

   <!-- Place favicon.ico in the root directory -->
   <link rel="apple-touch-icon" href="{{ asset('Frontend/assets/img/favicon.png') }}" />
   <link rel="shortcut icon" type="image/png" href="{{ asset('Frontend/assets/img/favicon.png') }}" />

   <!-- CSS here -->
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/animate.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/bootstrap.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/font-awesome-pro.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/flaticon_gerold.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/nice-select.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/backToTop.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/owl.carousel.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/swiper.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/odometer-theme-default.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/magnific-popup.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/main.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/light-mode.css') }}" />
   <link rel="stylesheet" href="{{ asset('Frontend/assets/css/responsive.css') }}" />
   
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>

<body>
   <!-- Preloader Area Start -->
   <div class="preloader">
      <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
         <path id="preloaderSvg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
      </svg>

      <div class="preloader-heading">
         <div class="load-text">
            <span>L</span>
            <span>o</span>
            <span>a</span>
            <span>d</span>
            <span>i</span>
            <span>n</span>
            <span>g</span>
         </div>
      </div>
   </div>
   <!-- Preloader Area End -->

   <!-- start: Back To Top -->
   <div class="progress-wrap" id="scrollUp">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
         <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
   </div>
   <!-- end: Back To Top -->
   <!-- HEADER START -->
      @include('frontend.partials.header')

   <!-- HEADER END -->
<main class="site-content" id="content">
       <!-- START: Breadcrumb Area -->
      <section class="breadcrumb_area" data-bg-image="{{ asset('/frontend/assets/img/breadcrumb/breadcrumb-bg.jpg')}}"
         data-bg-color="#140C1C">
         <div class="container">
            <div class="row">
               <div class="col">
                  <div class="breadcrumb_content d-flex flex-column align-items-center">
                     <h2 class="title wow fadeInUp" data-wow-delay=".3s" style="text-align:center">{{ $post->post_title }}</h2>
                     <div class="breadcrumb_navigation wow fadeInUp" data-wow-delay=".5s">
                        <span><a href="/">Home</a></span>
                        <i class="far fa-long-arrow-right"></i>
                        <span class="current-item">Blog Details</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- END: Breadcrumb Area -->


      @php
          $comments = App\Models\Comment::where('post_id', $post->id)->where('status',1)->get();
      @endphp

       <!-- START: Blog Section -->
      <section class="full-width tj-post-details__area">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-8">
                  <div class="tj-post-details__container">
                     <article class="tj-single__post">
                        <div class="tj-post__thumb">
                           <img src="{{ asset( $post->post_photo )}}" alt="" style="width: 1000px; height: 400px" />

                           <a href="#" class="category">Tutorial</a>
                        </div>

                        <div class="tj-post__content">
                           <div class="tj-post__meta entry-meta">
                              <span><i class="fa-light fa-user"></i> <a href="#">By {{ $post->author->username }}</a></span>
                              <span><i class="fa-light fa-calendar-days"></i>{{ $post->created_at->format('D M, Y') }}</span>
                              <span><i class="fa-light fa-comments"></i><a href="#">{{ count($comments) }} Comment(s)</a></span>
                           </div>
                           <h3 class="tj-post__title entry-title">{{ $post->post_title }}</h3>

                           <div class="tj-post__content">
                            {!! $post->post_description  !!}
                           </div>
                        </div>
                     </article>

                        @php
                           $tags = explode(',', $post->post_tags);
                        @endphp

                     <!-- post tags & social share -->
                     <div class="single-post_tag_share">
                        <!-- post tags -->
                        <div class="tj_tag">
                           <h4 class="tag__title">Tags:</h4>
                           <div class="tagcloud">
                              @foreach ($tags as $tag)
                               <a href="#">{{ $tag }}</a> 
                              @endforeach
                           </div>
                        </div>
                        <div class="share_link">
                           <a href="#" target="_blank" class="facebook" title="Share this on Facebook"><i
                                 class="fa-brands fa-facebook-f"></i></a>
                           <a href="#" class="twitter" title="Share this on Twitter" target="_blank"><i
                                 class="fa-brands fa-x-twitter"></i></a>
                           <a href="#" class="linkedin" title="Share this on Linkedin" target="_blank"><i
                                 class="fa-brands fa-linkedin-in"></i></a>
                           <a href="#" class="pinterest" title="Pin this Post" target="_blank"><i
                                 class="fa-brands fa-pinterest-p"></i></a>
                        </div>
                     </div>

                     <!-- comments area -->
                     <div class="tj-comments__container">
                        <div class="tj-comments__wrap">
                           <div class="tj-comment__title">
                              <h3>{{ count($comments) }} Comment(s)</h3>
                           </div>

                           <div class="tj-latest__comments">
                              <ul>
                                 @unless (count($comments)<1)
                                    @foreach ($comments as $comment)
                                       <li class="tj__comment">
                                    <div class="tj-comment__wrap">
                                       <div class="comment__avatar">
                                          <img alt="" src="{{ asset('uploads/no-img-avatar.png')}}" />
                                       </div>
                                       <div class="comment__text">
                                          <div class="avatar__name">
                                             <h5><a href="#">{{ $comment->user_name }}</a></h5>
                                             <span>{{ $comment->created_at->format('M D Y') }}</span>
                                          </div>
                                          <p>
                                             {{ $comment->comment }}
                                          </p>
                                       </div>
                                    </div>
                                 </li>
                                    @endforeach

                                 @else
                                    <p>
                                       No Comment(s) Found!! 😒😒😒😒
                                    </P>
                                 @endunless

                                 

                              </ul>
                           </div>
                        </div>

                        <div class="comment-respond">
                           <h3 class="comment-reply-title">
                              <span class="tj-comment__title">Leave a Comment</span>
                           </h3>

                           <form method="POST" action="{{ route('store.comment')}}" class="tj-post-comment__form">
                              @csrf
                              <input type="hidden" name="post_id" value="{{ $post->id }}">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form_group">
                                       <input placeholder="Enter Name" id="author" name="user_name" type="text"
                                          aria-required="true" />
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form_group">
                                       <input placeholder="Enter Email" id="email" name="user_email" type="email"
                                          aria-required="true" />
                                    </div>
                                 </div>
                                
                              </div>

                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form_group">
                                       <textarea class="msg-box" placeholder="Enter Your Comments" id="comment"
                                          name="comment" cols="45" rows="8"></textarea>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>

                              <button class="tj-btn-primary submit" type="submit">Post Comment</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="tj_main_sidebar">
                     <div class="sidebar_widget widget_search wow fadeInUp" data-wow-delay=".3s">
                        <div class="tj-widget__search form_group">
                           <form class="search-form" action="#" method="get">
                              <input type="search" id="search" name="search" placeholder="Search..." />
                              <button class="search-btn" type="submit"><i
                                    class="fa-light fa-magnifying-glass"></i></button>
                           </form>
                        </div>
                     </div>


                     <div class="sidebar_widget tj_recent_posts wow fadeInUp" data-wow-delay=".3s">
                        <div class="widget_title">
                           <h3 class="title">Recent post</h3>
                        </div>

                        <ul>
                            @foreach ($rposts as $rpost)
                              @php
                                 $comments = App\Models\Comment::where('post_id', $rpost->id)->where('status',1)->get();
                              @endphp

                                <li>
                                <div class="recent-post_thumb">
                                    <a href="blog-details.html">
                                        <img src="{{ asset($rpost->post_photo)}}" alt="" />
                                    </a>
                                </div>

                                <div class="recent-post_content">
                                    <div class="tj-post__meta entry-meta">
                                        <span><i class="fa-light fa-calendar-days"></i>{{ $rpost->created_at->format('M, Y')}}</span>
                                        <span><i class="fa-light fa-comments"></i><a href="#">{{ count($comments) }} Comment(s)</a></span>
                                    </div>
                                    <h4 class="recent-post_title">
                                        <a href="post/details/{{ $rpost->post_slug }}">{{ Str::limit($rpost->post_title, 30) }}</a>
                                    </h4>
                                </div>
                                </li>
                            @endforeach
                           
                        </ul>
                     </div>

                     @php
                         $tags = explode(',', $post->post_tags);
                     @endphp

                     <div class="sidebar_widget widget_tag_cloud wow fadeInUp" data-wow-delay=".3s">
                        <div class="widget_title">
                           <h3 class="title">Popular tag</h3>
                        </div>

                        <div class="tagcloud">
                         
                           @foreach ($tags as $tag)
                               <a href="#">{{ $tag }}</a> 
                           @endforeach
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- END: Blog Section -->
   </main>
 <!-- FOOTER AREA START -->
      @include('frontend.partials.footer')
   <!-- FOOTER AREA END -->

   <!-- CSS here -->
<script src="{{ asset('Frontend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/nice-select.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/backToTop.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/smooth-scroll.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/appear.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/one-page-nav.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/lightcase.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/imagesloaded-pkgd.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/magnific-popup.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/validate.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/main.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>


</body>
</html>