
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Invite card || learningrobo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper" style=" display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;height: 100vh;width:100%
">
	<div class="container" style="width:100%;height:100vh">
		<div class="columns form_container" style=" border-radius: 20px;width: 100%;">
			<div class="column is-half spooky_bg2" style=" display: none;background: url(https://cdn.thetealmango.com/wp-content/uploads/2021/10/squiddd.jpg);background-size: cover;border-top-right-radius: 20px;border-bottom-right-radius: 20px;">
			</div>
			<div class="column is-half input_container" style="padding: 4em;position: relative;color: #0a0a0a;margin: 0 auto;-webkit-box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;">
<div id="invt" style="width: 100%;background-color: #12192c;margin: 0;padding: 0;"><h1 style="font-size: 30px;text-align: center;color: #fff;margin-bottom: 20px;"> Invitation</h1> </div>
<h2 style="margin-bottom: 20px;">{{$conference->name}}</h2>

                <div id="content" style="display: flex;justify-content: flex;">

                <div id="details" style="width: 60%;">
                <h5 style="margin-bottom: 20px;">in {{$conference->doe}}</h5>

				<p style="margin-bottom: 20px;">{!!$conference->bio!!}. </p>
                </div>

                <div id="sponsor_comps" style="width: 35%;">
                    <div id="logo">
                        @foreach ($logo as $image )
                        <img src="{{asset($image)}}" width="60px" height="60px" style="border-radius: 50%">
                        @endforeach
                    </div>

                </div>





                </div>

                <div>
                    {!! QrCode::size(100)->generate('http://127.0.0.1:8000/conference/'.$conference->id) !!}
                </div>


<a class="btn btn-success" href="{{route('generate_image',$conference->id)}}">Generate as Image </a>



		</div>
	</div>
</div>
</body>
</html>
