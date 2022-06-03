<?php
use App\Comment;

?>

<div class="row special_package">
    @foreach ($posts as $item)
        
    <div class="col-sm-4 portfolio-item">
      <div class="single_package"> <a href="{{ route('post.detail', $item->url) }}">
        <figure class="pkg-img"> <img src="{{asset($item->image)}}"> 
          <!--<div class="box_caption">
          <h3>Everest B.C &amp; Gokyo Lakes</h3>
        </div>--> 
          
        </figure>
        </a>
        <figcaption class="expedition_caption">
          <div class="expedition_wrapper">
            {{-- <h4 class="collection">Collection</h4> --}}
            <h4 class="pkg-title">{{$item->title}}</h4>
            <p>{{$item->details}}</p>
            <?php 
              $rating_sum = Comment::where(['post_id'=>$item->id])->sum('star');
              $rating_count = Comment::where(['post_id'=>$item->id])->count();
              if ($rating_count >0) {
                  $avag_rating = round($rating_sum/$rating_count, 2);
                  $avag_star_rating = round($rating_sum/$rating_count);        
              } else{
                  $avag_rating = 0;
                  $avag_star_rating = 0; 
              }
            ?>
            <div class="tour-review"> 
              <span class="reviews-stars"> 
                <?php
                $x = $avag_star_rating;
                
                while($x > 0) {
                echo '<i class="fa fa-star" aria-hidden="true"></i>';
                $x--;
                }
                $y = 5-$avag_star_rating;
                  // echo $;
                  while($y > 0) {
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  $y--;
                }
            ?>
          </span> 
          <span class="reviews-count">({{$avag_rating}})</span> 
        </div>
            <span class="pkg-price">Rs. {{$item->price}}</span> </div>
        </figcaption>
      </div>
    </div>
    @endforeach

  </div>