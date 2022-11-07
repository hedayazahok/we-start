@extends('master')
@section('style')
<style>
.max-lines {
    display: block;/* or inline-block */
    text-overflow: ellipsis;
    word-wrap: break-word;
    overflow: hidden;
    max-height: 3.6em;
    line-height: 1.8em;
  }
</style>
  @endsection
@section('content')
      <div class="container">

          <div class="sidebar-box">
              <form method="GET" action="" role="search" class="search-form">
              @csrf
                <div class="form-group">
                  <input data-live-search="true" name="title" type="text" id="postSearch" class="form-control" placeholder="Type a keyword and hit enter"><span class="icon icon-search"></span>

                </div>

              </form>
            </div>  <br>



        <div class="row d-flex">
          @foreach($posts as $post)

          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry justify-content-end">
             <a href="{{route('post.show',$post->id)}}"><img src="{{ asset($post->image) }}" class="block-20">
              </a>
              <div class="text p-4 float-right d-block">
                <div class="topper d-flex align-items-center">
                  <div class="one py-2 pl-3 pr-1 align-self-stretch">

                    <span class="day">{{ Carbon\Carbon::parse($post->created_at)->format('d') }}</span>
                  </div>
                  <div class="two pl-0 pr-3 py-2 align-self-stretch">
                    <span class="yr">{{ Carbon\Carbon::parse($post->created_at)->format('y') }}</span>

                    <span class="mos">{{Carbon\Carbon::parse($post->created_at)->format('m') }}</span>
                      </div>
                      </div>
                <h3 class="heading mb-3" id="title"><a href="{{route('post.show',$post->id)}}" >{{$post->title}}</a></h3>
                <p class="max-lines">{!!  \Illuminate\Support\Str::limit(strip_tags($post->content), $limit =50, $end = '...') !!}

                </p>
                <p><a href="{{route('post.show',$post->id)}}" class="btn-custom"><span class="ion-ios-arrow-round-forward mr-3"></span>Read more</a></p>
              </div>
            </div>
                    </div>

                                             @endforeach

      </div>

      </div>
    </div>

    {{$posts->links()}}
@endsection
