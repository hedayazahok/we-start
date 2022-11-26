@include('header')

  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{ url("index.html") }}">Deluxe</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="{{ url("index.html") }}" class="nav-link">Home</a></li>
	          <li class="nav-item active"><a href="{{ url("rooms.html") }}" class="nav-link">Rooms</a></li>
	          <li class="nav-item"><a href="{{ url("restaurant.html") }}" class="nav-link">Restaurant</a></li>
	          <li class="nav-item"><a href="{{ url("about.html") }}" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="{{ url("blog.html") }}" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="{{ url("contact.html") }}" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <div class="hero-wrap" style="background-image: url({{asset('assets/images/bg_1.jpg')}});">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">

	            <h1 class="mb-4 bread">{{$chalet->name}}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          	<div class="row">
          		<div class="col-md-12 ftco-animate">
          			<h2 class="mb-4">{{$chalet->name}}</h2>
          			<div class="single-slider owl-carousel">
                          @foreach ($images as $img )

          				<div class="item">
          					<div class="room-img" style="background-image: url({{asset($img['path'])}});"></div>
          				</div>
                          @endforeach

          			</div>
          		</div>
          		<div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
    						<p>{{$chalet->details}}.</p>

          		</div>



          	</div>
          </div> <!-- .col-md-8 -->
          <div class="col-md-6 sidebar ftco-animate">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
                @php
                    Session::forget('error');
                @endphp
            </div>
        @endif


                        <h3>Booking </h3>
                        <form action="{{route('chalet.booking',$chalet->id)}}" method="post"   enctype="multipart/form-data">
                            @csrf
                      <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Your Name">
                      </div>
                      @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                      <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Your phone">
                      </div>
                      @if ($errors->has('phone'))
                      <span class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
                      <div class="form-group">
                        <input type="text" class="form-control checkin_date"  name="arrival_date" placeholder="Arrival date" min="<?php Carbon\Carbon::now()->format('Y-m-d'); ?>">
                      </div>
                      @if ($errors->has('arrival_date'))
                      <span class="text-danger">{{ $errors->first('arrival_date') }}</span>
                  @endif
                      <div class="form-group">
                        <input type="text" class="form-control checkout_date"   placeholder="Departure date"  name="departure_date" min="<?php echo Carbon\Carbon::now()->format('Y-m-d'); ?>">
                       </div>
                       @if ($errors->has('departure_date'))
                      <span class="text-danger">{{ $errors->first('departure_date') }}</span>
                  @endif
                       <div class="form-group">
                        <input type="number" class="form-control"   placeholder="no. of Adult"  name="num_adult">
                       </div>
                       @if ($errors->has('num_adult'))
                       <span class="text-danger">{{ $errors->first('num_adult') }}</span>
                   @endif

                      <div class="form-group">
                        <button type="submit" class="btn btn-info" style="width: 100%;height:60%; border-radius:0%">Booking  Now</button>
                      </div>
                    </form>

                  </div>



      </div>
    </section> <!-- .section -->



   @include('footer')
