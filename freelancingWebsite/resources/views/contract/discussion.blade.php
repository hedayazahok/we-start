
@extends('layouts.app')
@section('title','Discussion Contract ')


@section('style')
<style>.content-item {
    padding:30px 0;
	background-color:#FFFFFF;
}

.content-item.grey {
	background-color:#F0F0F0;
	padding:50px 0;
	height:100%;
}

.content-item h2 {
	font-weight:700;
	font-size:35px;
	line-height:45px;
	text-transform:uppercase;
	margin:20px 0;
}

.content-item h3 {
	font-weight:400;
	font-size:20px;
	color:#555555;
	margin:10px 0 15px;
	padding:0;
}

.content-headline {
	height:1px;
	text-align:center;
	margin:20px 0 70px;
}

.content-headline h2 {
	background-color:#FFFFFF;
	display:inline-block;
	margin:-20px auto 0;
	padding:0 20px;
}

.grey .content-headline h2 {
	background-color:#F0F0F0;
}

.content-headline h3 {
	font-size:14px;
	color:#AAAAAA;
	display:block;
}


#comments {
    box-shadow: 0 -1px 6px 1px rgba(0,0,0,0.1);
	background-color:#FFFFFF;
}

#comments form {
	margin-bottom:30px;
}

#comments .btn {
	margin-top:7px;
}

#comments form fieldset {
	clear:both;
}

#comments form textarea {
	height:100px;
}

#comments .media {
	border-top:1px dashed #DDDDDD;
	padding:20px 0;
	margin:0;
}

#comments .media > .pull-left {
    margin-right:20px;
}

#comments .media img {
	max-width:100px;
}

#comments .media h4 {
	margin:0 0 10px;
}

#comments .media h4 span {
	font-size:14px;
	float:right;
	color:#999999;
}

#comments .media p {
	margin-bottom:15px;
	text-align:justify;
}

#comments .media-detail {
	margin:0;
}

#comments .media-detail li {
	color:#AAAAAA;
	font-size:12px;
	padding-right: 10px;
	font-weight:600;
}

#comments .media-detail a:hover {
	text-decoration:underline;
}

#comments .media-detail li:last-child {
	padding-right:0;
}

#comments .media-detail li i {
	color:#666666;
	font-size:15px;
	margin-right:10px;
}

</style>

@endsection


@section('content')
<div class="container mt-5">
    <div class="main-body">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Discussion Contract</li>

      </ol>
    </nav>

    <div class="title" style="width: 100%">
        <h4 style="padding: 0 14px;line-height: 38px;">{{$project->title}}</h4>

    </div>

    <div class="row gutters-sm">
        <div class="col-md-8">
            <!-- project Details -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Project Details</h6>
                </div>

              </div>
              <hr>
              <div class="row">
                <p style="padding: 15px;line-height: 1.4;"> {{$project->desc}}</p>
            @if($contract->proposal->status == 'completed')
                <a  href="{{route('proposal.delivery',$contract->proposal->id)}}"  class="btn btn-success pull-right ml-3"><i class="fa-solid fa-check"></i> Project completed</a>

            @else
            <a  href="{{route('proposal.delivery',$contract->proposal->id)}}"  class="btn btn-success pull-right ml-3"><i class="fa-solid fa-ship"></i> Project delivery</a>
            @endif
              </div>


            </div>

          </div>

          <div class="card mb-3">
            <div class="card-body">

                <section class="content-item" id="comments">
                    @if($contract->status!='completed')
                    <div class="container">
                                <form action="{{route('message')}}" method="post">
                                    @csrf
                                    <h3 class="pull-left">New Comment</h3>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-2 hidden-xs">
                                                @if(Auth::check())
                                                <img class="media-object" width="100px" height="100px"  src="{{asset(Auth::user()->image->path)}}" alt="">
                                                <input type="hidden" value="client" name="type">
                                                <input type="hidden" value="{{Auth::id()}}" name="user_id">
                                                @endif
                                                @if(Auth::guard('freelancer')->check())
                                                <img class="media-object"  width="100px" height="100px"    src="{{asset(Auth::guard('freelancer')->user()->image->path)}}" alt="">
                                                <input type="hidden" value="freelancer" name="type">
                                                <input type="hidden" value="{{Auth::guard('freelancer')->id()}}" name="user_id">
                                                @endif
                                                <input type="hidden" value="{{$project->id}}" name="project_id">

                                            </div>
                                            <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                                <textarea class="form-control" id="message" placeholder="Your message"  name="message" required="" required></textarea>
                                            </div>

                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-success pull-right">Submit</button>

                                </form>

                        @if($messages !=null)
                        @foreach($messages as $message)

                                <!-- COMMENT  - START -->
                                <div class="media">
                                    @if ($message->type=='client')

                                    <a class="pull-left" href="{{route('client.profile')}}">

                                    @if($message->user->image!=null)
                    <img src="{{asset($message->user->image->path)}}" alt="Admin" class="media-object">
                    @else
                    <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="media-object">
                    @endif
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$message->user->name}}</h4>
                                        @endif

                                        @if($message->type=='freelancer')

                                        <a class="pull-left" href="{{route('freelancer.profile',$message->freelancer->id)}}">

                                        @if($message->freelancer->image!=null)
                        <img src="{{asset($message->freelancer->image->path)}}" alt="Admin" class="media-object">
                        @else
                        <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="media-object">
                        @endif
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$message->freelancer->name}}</h4>
                                            @endif





                                        <p>{{$message->message}}</p>
                                        <ul class="list-unstyled list-inline media-detail pull-left">
                                            <li><i class="fa fa-calendar"></i>{{$message->created_at}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- COMMENT  - END -->
                        @endforeach
                        @else
                        <h3>no messages yet</h3>
                        @endif

                            </div>
                            @else
                            <h3>The project has been delivered</h3>

                            @endif
                        </section>
                        </div>
                    </div></div>




<!-- project info -->
<div class="col-md-4 mb-3">
<div class="card ">
  <ul class="list-group list-group-flush">
    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap borderless">
      <h6 class="mb-0">Project Card</h6>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap borderless"  style="border: none">
      <h6 class="mb-0">Status</h6>
      @if($project->status=='open')
      <span class="badge badge-success">{{$project->status}}</span>
      @elseif ($project->status=='closed'||$project->status=='cancled')
      <span class="badge badge-danger">{{$project->status}}</span>
      @else
      <span class="badge badge-primary">{{$project->status}}</span>

      @endif

    </li>
    <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
        <h6 class="mb-0">Budget</h6>
        <span class="text-secondary">${{$project->budget_from}}-{{$project->budget_to}}</span>
      </li>




    <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
      <h6 class="mb-0">implementation period</h6>
      <span class="text-secondary"> {{$duration}} days</span>
    </li>

    <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
        <h6 class="mb-0">Execution appeared</h6>
        <span class="text-secondary">{{$duration}}</span>
      </li>
    <li class="list-group-item  borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
      <h6 class="mb-0">date of cotract</h6>
      <span class="text-secondary"> {{$from_date}} </span>
    </li>
    <li class="list-group-item  borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
        <h6 class="mb-0">Contract expiry date</h6>
        <span class="text-secondary"> {{$to_date}} </span>
      </li>


  </ul>
</div>


<div class="card border-top ">
  <ul class="list-group list-group-flush mt-3 mb-3">
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap"  style="border: none">
          <h6 class="mb-0"><i class="bi bi-check-circle-fill"></i>  Bids receiving stage</h6>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap"  style="border: none">
          <h6 class="mb-0"><i class="bi bi-record-circle-fill"></i> Implementation stage</h6>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap"  style="border: none">
          <h6 class="mb-0"><i class="bi bi-record-circle-fill"></i>  delivery stage</h6>
        </li>

  </ul>
</div>
<div class="card border-top ">
  <div class="card-body">
      <h6 class="mb-0">Client:</h6>

      <div class="d-xl-inline-flex" >
          <div  class="mt-3 mr-3">
        @if($project->user->image!=null)
        <img src="{{asset($project->user->image->path)}}" alt="Admin" class="rounded-circle" width="64" height="64">
        @else
        <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="rounded-circle" width="64" height="64">
        @endif
      </div>
        <div class="mt-3">
          <h6>{{$contract->user->name}}</h6>
          <p class="text-muted font-size-sm"><img src="{{asset('assets/flags/'.$project->user->country.'.svg')}}" alt="Admin"  width="15" height="15"> {{$project->user->country}}</p>

        </div>
      </div>
    </div>
    <div class="card-body">
        <h6 class="mb-0">Freelancer:</h6>

        <div class="d-xl-inline-flex" >
            <div  class="mt-3 mr-3">
          @if($contract->freelancer->image!=null)
          <img src="{{asset($contract->freelancer->image->path)}}" alt="Admin" class="rounded-circle" width="64" height="64">
          @else
          <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="rounded-circle" width="64" height="64">
          @endif
        </div>
          <div class="mt-3">
            <h6>{{$contract->freelancer->name}}</h6>
            <p class="text-muted font-size-sm"><img src="{{asset('assets/flags/'.$contract->freelancer->country.'.svg')}}" alt="Admin"  width="15" height="15"> {{$contract->freelancer->country}}</p>

          </div>
        </div>
      </div>
</div>

</div>

</div>






          @endsection
