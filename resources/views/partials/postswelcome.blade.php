@foreach($postsajax as $post)
  <div class="col-12">
    <!-- div for small screens -->
    <div class="row post-body my-5 d-block d-sm-block d-md-none"  onclick="window.location.href='/tournaments'">
      <div class="col-12">
        <div class="thumbnail thumbnail-rect-smscreen">
          <img class="mt-3" src="{{$post->banner}}">
        </div>
      </div>
      <div class="col-12 mt-3">
        <a class="post-link" href="">
          <h3 class="post-title mt-3">{{$post->title}}</h3>
        </a>
        <p>{{$post->created_at}}</p>
        <p>{{$post->excerpt}}</p>
      </div>
      <div class="col-12 mt-3">
        <div class="btn-dgl-contaianer btn-dgl-container-gray">
          <a href="" class="btn btn-lg btn-dgl">Read More</a>
        </div>
      </div>
    </div>
    <!-- div for medium screens -->
    <div class="row post-body mb-5 d-none d-md-flex d-lg-none" onclick="window.location.href='/tournaments'">
      <div class="col-4">
        <div class="thumbnail thumbnail-sq-lg">
          <img class="mt-3" src="{{$post->banner}}">
        </div>
      </div>
      <div class="col-8 col-lg-7">
        <a class="post-link" href="">
          <h2 class="post-title mt-3">{{$post->title}}</h2>
        </a>
        <p>{{$post->created_at}}</p>
        <p>{{$post->excerpt}}</p>
        <div class="col-12 mt-3">
          <div class="btn-dgl-contaianer btn-dgl-container-gray">
            <a href="" class="btn btn-lg btn-dgl">Read More</a>
          </div>
        </div>
      </div>
    </div>
    <!-- div for large screens -->
    <div class="row post-body post-body-hover mb-5 d-none d-lg-flex ml-xl-1" onclick="window.location.href='#'">
      <div class="col-4">
        <div class="thumbnail thumbnail-rect">
          <img class="mt-3" src="{{$post->banner}}">
        </div>
      </div>
      <div class="col-8 col-lg-7">
        <a class="post-link" href="">
          <h2 class="post-title mt-3">{{$post->title}}</h2>
        </a>
        <p>{{$post->created_at->diffForHumans(Carbon\Carbon::now(), true)}} ago</p>
        <p>{{$post->excerpt}}</p>
      </div>
    </div>
  </div>
@endforeach