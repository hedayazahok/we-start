
@extends('layouts.app')
@section('title','Profile')
@section('style')
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" integrity="sha512-RWhcC19d8A3vE7kpXq6Ze4GcPfGe3DQWuenhXAbcGiZOaqGojLtWwit1eeM9jLGHFv8hnwpX3blJKGjTsf2HxQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--head-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js" integrity="sha512-9CWGXFSJ+/X0LWzSRCZFsOPhSfm6jbnL+Mpqo0o8Ke2SYr8rCTqb4/wGm+9n13HtDE1NQpAEOrMecDZw4FXQGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>

.sidebar-item.active, .sidebar-item:hover {
  background-color: #fff;
  border: 1px solid #e6e7e9;
  border-right: 0;
  margin-right: -1px;
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
section{
    margin: 0px

}
.tag-skills{
    color: #fff;
    display: inline-block;
    border-radius: 2px;
    padding: 0.25em 0.5em;
    font-size: 12px;
    background-color: #2386c8
}
.item-box {
  position: relative;
  overflow: hidden;
  display: block;
}

.item-box a {
  display: inline-block;
}

.item-box .item-mask {
  background: none repeat scroll 0 0 rgba(255, 255, 255, 0.9);
  position: absolute;
  transition: all 0.5s ease-in-out 0s;
  -moz-transition: all 0.5s ease-in-out 0s;
  -webkit-transition: all 0.5s ease-in-out 0s;
  -o-transition: all 0.5s ease-in-out 0s;
  top: 10px;
  left: 10px;
  bottom: 10px;
  right: 10px;
  opacity: 0;
  visibility: hidden;
  overflow: hidden;
  text-align: center;
}
.item-box{
    width:306px;
    height:200px;
}
 .item-mask .item-caption {
  position: absolute;
  width: 100%;
  bottom: 10px;
  opacity: 0;
}

.item-box:hover .item-mask {
  opacity: 1;
  visibility: visible;
  cursor: pointer !important;
}

.item-box:hover .item-caption {
  opacity: 1;
}

.item-box:hover .item-container {
  width: 100%;
}

.services-box {
  padding: 45px 25px 45px 25px;
}
#img_portfolio{
    object-fit: cover;
    object-position: center;
    max-width: 100%;
        max-height: 100%;
        display: block; /* remove extra space below image */
}
#testimonials{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width:100%;
}
.testimonial-heading{
    letter-spacing: 1px;
    margin: 30px 0px;
    padding: 10px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.testimonial-heading span{
    font-size: 1.3rem;
    color: #252525;
    margin-bottom: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
}
.testimonial-box-container{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    width:100%;
}
.testimonial-box{
    width:500px;
    box-shadow: 2px 2px 30px rgba(0,0,0,0.1);
    background-color: #ffffff;
    padding: 20px;
    margin: 15px;
    cursor: pointer;
}
.profile-img{
    width:50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
}
.profile-img img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
.profile{
    display: flex;
    align-items: center;
}
.name-user{
    display: flex;
    flex-direction: column;
}
.name-user strong{
    color: #3d3d3d;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
}
.name-user span{
    color: #979797;
    font-size: 0.8rem;
}
.reviews{
    color: #f9d71c;
}
.box-top{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.client-comment p{
    font-size: 0.9rem;
    color: #4b4b4b;
}
.testimonial-box:hover{
    transform: translateY(-10px);
    transition: all ease 0.3s;
}

@media(max-width:1060px){
    .testimonial-box{
        width:45%;
        padding: 10px;
    }
}
@media(max-width:790px){
    .testimonial-box{
        width:100%;
    }
    .testimonial-heading h1{
        font-size: 1.4rem;
    }
}
@media(max-width:340px){
    .box-top{
        flex-wrap: wrap;
        margin-bottom: 10px;
    }
    .reviews{
        margin-top: 10px;
    }
}
::selection{
    color: #ffffff;
    background-color: #252525;
}
</style>
@endsection
@section('header')
<header class=" mt-5 mr-0 " >
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="display: block">
                   <div class="profiles p-3 my-4 rounded text-center" style="margin:0 auto;margin-left:10px">
                        <div class="avatars">
                            @if($freelancer->image!=null)
                            <img src="{{asset($freelancer->image->path)}}" alt="Admin" class="avatar-lg rounded-circle img-fluid" width="150">
                            @else
                            <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="rounded-circle" width="150">
                            @endif

                        </div>
                        <div class="names">
                            <h3 class="title text-light">@jenifer</h3>
                            <i class="fa fa-user" aria-hidden="true" style="color:#6c757d"></i>
                            <span style="color:#6c757d; padding:5px">{{$freelancer->name}}</span>

                           @if($freelancer->major!=null)
                           <i class="fa fa-briefcase" aria-hidden="true" style="color:#6c757d"></i>
                           <a href="#" style="color:#6c757d; padding:5px;text-decoration:none">{{$freelancer->major}}</a>
                           @endif
                           <i class="fa fa-map-marker" aria-hidden="true" style="color:#6c757d"></i>
                           <span  style="color:#6c757d; padding:5px">{{$freelancer->country}}</span>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 ">
                                <div class="row">
                                    <div class="col-12">
                                        <a class="position-absolute ml-3 mt-3 text-white" href="setting.html" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit cover images"><i class="fas fa-cog"></i></a>

                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin:0 auto;padding:0;display:flex;">
                        <div class="col-6">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                <li class="nav-item" style="display:flex;justify-content:space-between" >
                              <a class="nav-link active show" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true"><i class="fa fa-user" aria-hidden="true" ></i> Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home"  role="tab" aria-controls="pills-home" aria-selected="false"><i class="fa fa-star" aria-hidden="true" style="color:#faa33d"></i> Reviews</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-briefcase" aria-hidden="true" ></i> portofilo</a>
                                </li>
                            </ul>
                            <!---->
            </div>

            @if(auth()->guard('freelancer')->check()&&Auth::guard('freelancer')->user()->id==$freelancer->id)
            <div class="col-6" style="align-item:right;position:relative;">
                <a href="{{route('freelancer.portfolios.create',$freelancer->id)}}" class="btn btn-success" style="color:white;position: absolute;right: 2"><i class="fa fa-plus"></i> Add Portfolio </a>
                <a href="{{route('freelancer.profile.settingForm')}}" class="btn btn-primary" style="color:white;position: absolute;right:150px"><i class="fa fa-pen"></i> Edit Profile </a>

            </div>
            @endif

    </nav>
</header>

        <div class="container mt-5 ml-0">
            <div class="row">

                <!--Content-->
                <div class="col-md-9">
                    <div class="dashboard-area" style="width:100%">

                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content " id="pills-tabContent">
                                    <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="testimonial-heading">
                                            <span>Comments</span>
                                        </div>
                                        <!--testimonials-box-container------>
                                        <div class="testimonial-box-container">
                                            @foreach ($freelancer->reviews as $review )
                                            <!--BOX-1-------------->
                                            <div class="testimonial-box">
                                                <!--top------------------------->
                                                <div class="box-top">
                                                    <!--profile----->
                                                    <div class="profile">
                                                        <!--img---->

                                                        <div class="profile-img">
                                                            @if($review->user->image!=null)
                                                            <img src="{{asset($review->user->image->path)}}" />
                                                            @else
                                                            <img src="https://avatars.hsoubcdn.com/default?s=128" >
                                                            @endif
                                                        </div>
                                                        <!--name-and-username-->
                                                        <div class="name-user">
                                                            <strong>{{$review->name}}</strong>
                                                        </div>
                                                    </div>
                                                    <!--reviews------>
                                                    <div class="reviews">
                                                        @php
        $rating =App\Models\Review::where('freelancer_id',auth()->guard('freelancer')->id())->where('user_id',$review->user->id)->pluck('star')->avg();

                                                        @endphp

                                                        @foreach(range(1,5) as $i)
                                                            <span class="fa-stack" style="width:1em">
                                                                <i class="far fa-star fa-stack-1x"></i>

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
                                                <!--Comments---------------------------------------->
                                                <div class="client-comment">
                                                    <p>{{$review->comment}}</p>
                                                </div>
                                            </div>

                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="p-3 border mb-3 bg-light">


                                            <a class="position-absolute" style="right: 25px" href="setting.html" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit profile"><i class="fas fa-cog"></i></a>
                                            <h3 style="border: solid #eaeaea;border-width: 0 0 1px;padding:5px">About me</h3>
                                            @if($freelancer->bio!=null)
                                            <p class="p-3" >{{$freelancer->bio}}</p>
                                            @else
                                            <p> ...</p>
                                            @endif

                                        </div>
                                        <div class="p-3 border mt-3 bg-light ">
                                            <a class="position-absolute" style="right: 25px" href="setting.html" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit profile"><i class="fas fa-cog"></i></a>
                                            <h3 style="border: solid #eaeaea;border-width: 0 0 1px;padding:5px">skills</h3>
                                            @if($skills!=null)
                                            <div class="text-sm opacity-50">
                                                @php
                                                $skills=explode(',',$skills);
                                                @endphp
                                                @foreach($skills as $skill)
                                                <a class="text-black mr-2 tag-skills" href="#"><i class="fa fa-fw fa-tag"></i>{{$skill}}</a>
                                                @endforeach
                                            </div>
                                            @else
                                            <p>no skills </p>
                                            @endif
                                          </div>

                                        </div>



                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <div class=" p-3 border mb-3 bg-light">

          <div class="row portfolio-container " data-aos="fade-up" data-aos-delay="200">

            <div class="port portfolio-masonry mt-4">
                <div class="portfolioContainer row photo">
                    @if($freelancer->portfolios()->count()!=0)
                    @foreach ($portfolios as $portfolio )

                    <div class="col-lg-5 p-4 ">
                        <div class="item-box">
                            <a class="mfp-image" href="{{route('freelancer.portfolios.show',$portfolio->id)}}" title="Project Name">
                                <img class="item-container img-fluid" src="{{asset($portfolio->image->path)}}" alt="work-img" id="img_portfolio">
                                <div class="item-mask">
                                    <div class="item-caption">
                                        <p class="text-dark mb-0">{{$portfolio->title}}</p>
                                        <h6 class="text-dark mt-1 text-uppercase">{{$portfolio->category->name}}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                    @else
                    <div class="col-12 pl-5"style="text-align: center;align-item:center">
                        <div >
                    <p > no portfolio add</p>
                </div>
                    </div>
                    @endif


                </div>
            </div>
          </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!--right sidebar-->
                  <div class="col-md-3 mr-0" id="sidebar">
                    <div class="card ">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                          <h5  style="border-bottom: 1px solid #e6e7e9;width:100%;padding:10px 5px" class="mb-0">Statictics</h5>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap borderless"  style="border: none">
                          <h6 class="mb-0">Reviews</h6>
                        <span style="color: #6c757d">
                            @php $rating = $freelancer->getRating();
                            @endphp

                            @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em;color: #faa33d">
                                    <i class="far fa-star fa-stack-1x" ></i>

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
                            ({{$freelancer->getCountRating()}})
                        </span>

                        </li>
                        <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                          <h6 class="mb-0">Project completion rate</h6>
                          <span class="text-secondary">%{{$completion_rate}}</span>
                        </li>
                        <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                          <h6 class="mb-0">Rehiring rate</h6>
                          <span class="text-secondary">%{{$Rehiring_rate}}</span>
                        </li>
                        <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                          <h6 class="mb-0">completed project</h6>
                          <span class="text-secondary">  {{$completed_count}}</span>
                        </li>
                        <li class="list-group-item  borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                          <h6 class="mb-0">Register Date</h6>
                          <span class="text-secondary"> {{$freelancer->created_at}} </span>
                        </li>



                      </ul>
                    </div>



                  </div>
                </div>


        </div>


