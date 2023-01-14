
@extends('layouts.app')
@section('title','Portfolio')
@section('style')
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
<style type="text/css">

.tag-skills{
    color: #fff;
    display: inline-block;
    border-radius: 2px;
    padding: 0.25em 0.5em;
    font-size: 12px;
    background-color: #2386c8
}
h2{
    font-family: 'Dancing Script', "cursive"
}
p{
    font-family: 'Times New Roman';
    line-height: 1.7em;
}
h1,h2,h3,h4,h5,h6{
    font-family: 'Monospace'


}
a,span{
    font-family: 'sans-serif'

}

.carousel-inner{
  width:328px;
  max-height: 500px !important;
}
.carousel-inner img{
    object-fit: contain;


}

</style>

@endsection
@section('content')
<div class="container mt-5">
       <!-- Breadcrumb -->
       <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('freelancer.profile',$freelancer->id)}}">{{Str::limit($freelancer->name,10);}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$portfolio->title}}</li>

        </ol>
      </nav>
      <!-- /Breadcrumb -->

    <!-- ======= Portfolio Details Section ======= -->
    <div class="title" style="width: 100%">
        <h4 style="padding: 0 14px;line-height: 38px;">{{$portfolio->title}}</h4>


    </div>

    </div>
    <div class="row gutters" style="width: 100%">
        <div class="col-md-9" style="width: 100%">
            <!-- project Details -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="row" style="border: solid #eaeaea;border-width: 0 0 1px;display: flex; padding: 14px 21px;align-items: center;">
                <div class="col-12 heas" style="display: flex; padding: 14px 21px;align-items: center;" >
                  <h2 class="mb-0 head-title">Portfolio Details</h2>
                  @if(auth()->guard('freelancer')->check()&&auth()->guard('freelancer')->user()->id==$portfolio->freelancer_id)
                  <a href="{{route('freelancer.portfolios.edit',$portfolio->id)}}" class="btn btn-primary" style="color:white;position:absolute;right:10pc;"><i class="fa fa-pen">Edit</i>  </a>
                  <a href="{{route('freelancer.portfolios.destroy',$portfolio->id)}}" class="btn btn-danger" style="color:white;position:absolute;right:2pc;"><i class="fa fa-trash">Delete</i>  </a>
                  @endif
                </div>
              </div>



              <div id="carouselExampleIndicators" class=" row mt-4 carousel slide" data-ride="carousel" >

                <div class="carousel-inner  col-lg-12">
                  <div class="carousel-item ">
                    <img class="d-block w-100"  src="{{asset($portfolio->image->path)}}" alt="First slide">
                  </div>
                  @foreach($portfolio->files as $file)

                  <div class="carousel-item  @if($loop->first) active @endif">
                    <img class="d-block w-100" src="{{asset($file->path)}}" alt="Second slide">
                  </div>

                </div>
                @endforeach
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>





              <div class="card mb-3">
                <div class="card-body">

              <div class="row">
                <p style="padding: 15px;line-height: 1.4;"> {{$portfolio->desc}}</p>
              </div>

            </div>

        </div>




          <div class="card mb-3">
            <div class="card-body">
              <div class="row gutters">
                <div class="col-md-9">
                  <h6 class="mb-0">Skills required</h6>
                </div>

              </div>
              <hr>
              <div class="row">
               <div class="card-body">
                <div class="inline-block">
                    @php
                      $skills=explode(',',$portfolio->skills);
                     @endphp
                                                @foreach($skills as $skill)
                                                <a class="text-black mr-2 tag-skills" href="#"><i class="fa fa-fw fa-tag"></i>{{$skill}}</a>
                                                @endforeach
                </div>


            </div>


              </div>


            </div>

          </div>



  <!-- project info -->

</div>

  <div class="col-md-3 mb-4">
    <div class="card ">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap borderless">
          <h4 class="mb-0">Portfolio Card</h4>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap borderless"  style="border: none">
          <h5 class="mb-0">project category </h5>

          <small class="badge badge-primary ">{{Str::limit($portfolio->category->name,30);}}</small>

        </li>
        <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
          <h5 class="mb-0">project execution date</h5>
          <span class="text-secondary">{{$portfolio->exec_date}}</span>
        </li>
        <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
          <h5 class="mb-0">project link </h5>
          <input class="form-control" readonly="" value="{{$portfolio->urls}}" dir="ltr" data-action="selectOnFocus">
        </li>
      </ul>
    </div>




    <div class="card border-top mt-3 ">
      <div class="card-body">

          <h4 class="mb-0">Share the project:</h4>
          <hr>
          <div class="panel-body">
              <input class="form-control" readonly="" value="{{url()->current()}}" dir="ltr" data-action="selectOnFocus">
          </div>
          <div class="d-xl-inline-flex justify-content-center" >
              <div  class="mt-3 mr-3">
                  <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{url()->current()}}&pubid=USERNAME&ct=1&title={{$portfolio->title}}&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/>

               </div>
             <div class="mt-3 mr-3">
              <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{url()->current()}}&title={{$portfolio->title}}&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>

            </div>
            <div class="mt-3">
              <a href="https://www.linkedin.com/sharing/share-offsite/?url={{url()->current()}}" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="linkedin"/></a>

            </div>

          </div>
        </div>
    </div>
  </div>
</div></div>

</div>


@endsection

@section('scripts')

@endsection
