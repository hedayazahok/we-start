@extends('layouts.app')


@section('style')
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
    <div class="main-body">


<div class="row gutters ">

        <!-- Main content -->
        <div class="col-lg-10 mb-3">
            @foreach ($freelancers as $freelancer )


          <!-- start of freelancer 1 -->

          <div class="card row-hover pos-relative pl-3 py-3 px-3 mb-3 border-warning border-topacity-0 border-right-0 border-bottom-0 rounded-0">
            <div class="row align-items-center">
              <div class="col-md-8 mb-3 mb-sm-0" >
                <div style="display: flex;justify-content:space-between">
                <h5>
                  <a href="{{route('freelancer.profile',$freelancer->id)}}" class="text-primary">{{$freelancer->name}}</a>

                </h5>
                <div class="col px-4">
                    @foreach(range(1,5) as $i)
               <span class="fa-stack" style="width:1em">
                   <i class="far fa-star fa-stack-1x"></i>
                   @php $rating = $freelancer->getRating();
                   @endphp
                   @if($rating >0)
                       @if($rating >0.5)
                           <i class="fas fa-star fa-stack-1x"></i>
                       @else
                           <i class="fas fa-star-half fa-stack-1x"></i>
                       @endif
                   @endif
                   @php $rating--; @endphp
               </span>
           @endforeach
       </div>
              </div>


                <p class="text-sm" style="font-size:14px"><span class="opacity-60" style="color:#8f8a8a;">is</span>
                    <span class="opacity-60"  style="color:#8f8a8a;"> from</span> {{$freelancer->country}}</p>
                    <div class="text-lg ">
                        <p>{{Str::limit($freelancer->bio,300)}}</p>
                    </div>

                <div class="text-sm opacity-50">
                    @php
                    $skills=explode(',',$freelancer->skills);
                    @endphp
                    @if($skills !=null)
                    @foreach($skills as $skill)
                    <a class="text-black mr-2" href="#">#{{$skill}}</a>
                    @endforeach
                    @endif
                    </div>
              </div>
              <div class="col-md-3 opacity-70">
                <div class="row text-center opacity-70">
                  <div class="col px-8"><p class="d-block  fw-bold" style="font-weight: bold">{{$freelancer->created_at}}</p> </div>

                  <div class="col px-4 mt-1"><a href="{{route('freelancer.profile',$freelancer->id)}}" class="btn btn-success btn-sm" style="color:#fff"> profile </a></div>

                </div>
              </div>
            </div>
          </div>
          <!-- /End of freelancer 1 -->
          @endforeach

        </div>
        {{$freelancers->links()}}

      </div>
    </div>

@endsection
