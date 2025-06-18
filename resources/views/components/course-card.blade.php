 @if ($variant == 'compact')
     <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
     @else
         <div class="col-xl-4 col-md-6 wow fadeInUp">
 @endif
 <div class="col-12">
     <div class="wsus__single_courses_3">
         <div class="wsus__single_courses_3_img">
             <img src="{{ asset($thumbnail) }}" alt="{{ $title }}" class="img-fluid">
             <span class="time"><i class="far fa-clock"></i>
                 {{ minutesToTime($duration) }}</span>
         </div>
         <div class="wsus__single_courses_text_3">
             <div class="rating_area">
                 <!-- <a href="#" class="category">Design</a> -->
                 <p class="rating">
                     @if ($rating > 0)
                         @for ($i = 0; $i < $rating; $i++)
                             <i class="fas fa-star" style="color: rgb(255, 199, 13)"></i>
                         @endfor
                         <span>({{ number_format($rating, 1) }}
                             Rating)</span>
                     @else
                         <span>No Reviews Yet</span>
                     @endif
                 </p>
             </div>

             <a class="title" href="{{ $url }}">{{ $title }}</a>
             <ul>
                 <li>{{ $lessons }} Lessons</li>
                 <li>{{ $students }} Students</li>
             </ul>
             <a class="author" href="#">
                 <div class="img">
                     <img src={{ asset($instructor->image) }} alt="Author" - class="img-fluid">
                 </div>
                 <h4>{{ $instructor->name }}</h4>
             </a>
         </div>
         <div class="wsus__single_courses_3_footer">
             <a class="common_btn add_to_cart" href="javascript:;" data-course-id={{ $id }}>Add To Cart <i
                     class="far fa-arrow-right"></i></a>
             @if ($discount > 0)
                 <p><del>${{ $price }}</del> ${{ $discount }}</p>
             @else
                 <p>${{ $price }}</p>
             @endif
         </div>
     </div>
 </div>
 </div>
