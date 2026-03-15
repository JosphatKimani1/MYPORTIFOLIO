<section class="blog-section" id="blog-section">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="section-header text-center">
                     <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">Recent Blogs</h2>
                     <p class="wow fadeInUp" data-wow-delay=".4s">
                        We put your ideas and thus your wishes in the form of a unique web project that inspires you and
                        you customers.
                     </p>
                  </div>
               </div>
            </div>
            <div class="row">
               @php
                   $posts = App\Models\BlogPost::Latest()->limit(3)->get();
               @endphp
               @unless (count($posts)<1)
                  @foreach ($posts as $post)
                     @php
                        $comments = App\Models\Comment::where('post_id', $post->id)->where('status',1)->get();
                     @endphp
                  <div class="col-lg-4 col-md-6">
                  <div class="blog-item wow fadeInUp" data-wow-delay=".5s">
                     <div class="blog-thumb">
                        <a href="post/details/{{ $post->post_slug }}">
                           <img src="{{ asset($post->post_photo) }}" alt="" />
                        </a>
                        <a href="#" class="category">Tutorial</a>
                     </div>

                     <div class="blog-content">
                        <div class="blog-meta">
                           <ul class="ul-reset">
                              <li><i class="fa-light fa-calendar-days"></i>{{ $post->created_at->format('D M, Y') }}</li>
                              <li><i class="fa-light fa-comments"></i> <a href="#">Comment ({{ $comments }})</a></li>
                           </ul>
                        </div>
                        <h3 class="blog-title"><a href="post/details/{{ $post->post_slug }}">{{ Str::limit($post->post_title, 40) }}</a></h3>
                     </div>
                  </div>
               </div>
                  @endforeach

               @else

               <p>No Post Found!!! 😒😒😒😒</p>
                  
               @endunless
              
            </div>
         </div>
      </section>