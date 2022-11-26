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
	          <li class="nav-item active"><a href="{{ url("index.html") }}" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="{{ url("rooms.html") }}" class="nav-link">Rooms</a></li>
	          <li class="nav-item"><a href="{{ url("restaurant.html") }}" class="nav-link">Restaurant</a></li>
	          <li class="nav-item"><a href="{{ url("about.html") }}" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="{{ url("blog.html") }}" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="{{ url("contact.html") }}" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image:url({{asset('assets/images/bg_1.jpg')}});">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-12 ftco-animate text-center">
          	<div class="text mb-5 pb-3">
	            <h1 class="mb-3">Welcome To Deluxe</h1>
	            <h2>Hotels &amp; Resorts</h2>
            </div>
          </div>
        </div>
        </div>
      </div>

      <div class="slider-item" style="background-image:url('assets/images/bg_2.jpg');">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-12 ftco-animate text-center">
          	<div class="text mb-5 pb-3">
	            <h1 class="mb-3">Enjoy A Luxury Experience</h1>
	            <h2>Join With Us</h2>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>

    <section class="ftco-booking">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-12">
    				<form method="post" action="{{route('filter')}}" class="booking-form">
                        @csrf
	        		<div class="row">
	        			<div class="col-md-3 d-flex">
	        				<div class="form-group p-4 align-self-stretch d-flex align-items-end">
	        					<div class="wrap">
				    					<label for="#">Check-in Date</label>
				    					<input type="text" name="checkIndate" class="form-control checkin_date" placeholder="Check-in date">
			    					</div>
			    				</div>
	        			</div>
	        			<div class="col-md-3 d-flex">
	        				<div class="form-group p-4 align-self-stretch d-flex align-items-end">
	        					<div class="wrap">
				    					<label for="#">Check-out Date</label>
				    					<input type="text" name="checkOutDate" class="form-control checkout_date" placeholder="Check-out date">
			    				</div>
			    				</div>
	        			</div>

	        			<div class="col-md d-flex">
	        				<div class="form-group p-4 align-self-stretch d-flex align-items-end">
	        					<div class="wrap">
			      					<label for="#">Address</label>
			      					<div class="form-field">
			        					<div class="select-wrap">
			                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
			                    <select name="address" id="" class="form-control">
                                    <option value="all"  selected>all</option>

                                    @foreach ($chalets as $chalet )
                                    <option value="{{$chalet->address}}" >{{$chalet->address}}</option>
                                    @endforeach

			                    </select>
			                  </div>
				              </div>
				            </div>
		              </div>
	        			</div>
	        			<div class="col-md d-flex">
	        				<div class="form-group d-flex align-self-stretch">
			              <input type="submit" value="Check Availability" class="btn btn-primary py-3 px-4 align-self-stretch">
			            </div>
	        			</div>
	        		</div>
	        	</form>
	    		</div>
    		</div>
    	</div>
    </section>




    <section class="ftco-section bg-light">
    	<div class="container">
				<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Our Chalets</h2>
          </div>
        </div>
    		<div class="row">

                @foreach ($chalets as $chalet )
                    @php
                    $paths=[];
                foreach($chalet->images as $img){
                $paths[]=$img->path;
                }
                @endphp
                <div class="col-sm col-md-6 col-lg-4 ftco-animate">
    				<div class="room">
    					<a href="{{ route('chalet.show',$chalet->id) }}" class="img d-flex justify-content-center align-items-center" style="background-image: url({{asset($paths[0])}});">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-search2"></span>
    						</div>
    					</a>
    					<div class="text p-3 text-center">
    						<h3 class="mb-3"><a href="{{ route('chalet.show',$chalet->id) }}">{{$chalet->name}}</a></h3>
    						<p><span class="price mr-2">${{$chalet->price}}</span> <span class="per">per day</span></p>@if($chalet->status==1)<span class="badge bg-danger">reserved now</span>@endif
    						<hr>
    						<p class="pt-1"><a href="{{ route('chalet.show',$chalet->id) }}" class="btn btn-info">Book now <span class="icon-long-arrow-right"></span></a></p>
    					</div>
    				</div>
    			</div>
                @endforeach



    		</div>
    	</div>
    </section>








  @include('footer')
