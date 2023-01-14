<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- FontAwesome 5 -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <style type="text/css">
        body{
            margin-top:20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }
        /* NavbarTop */
        .navbar-top {
            background-color: #17a2b8;
            color: #e2e8f0;
            box-shadow: 0px 4px 8px 0px #17a2b8;
            height: 70px;
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            z-index:100;

        }

        .title {
            padding-left: 12px;
            display: flex;


        }
        .title h4{
            font-family: 'Dancing Script', cursive;
            padding-top: 15px;


        }

        .title a{
               margin-left: 20px;
               color: #e2e8f0;
               text-decoration: none;
               padding-top: 20px;
               font-size: 14px;


        }



        .navbar-top ul {
            float: right;
            list-style-type: none;
            margin: 0;
            overflow: hidden;
            padding: 18px 50px 0 40px;
            font-size: 12px;
        }

        .navbar-top ul li {
            float: left;
        }

        .navbar-top ul li a {
            color: #e2e8f0;
            padding: 14px 16px;
            text-align: center;
            text-decoration: none;
        }

        .icon-count {
            background-color: #ff0000;
            color: #fff;
            float: right;
            font-size: 8px;
            left: -25px;
            padding: 2px;
            position: relative;
            border-radius: 50%;
        }

        /* End */

        .main-body {
            padding: 15px;
        }
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-header{
            display: flex;
            justify-content: space-between;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }
        .h-100 {
            height: 100%!important;
        }
        .shadow-none {
            box-shadow: none!important;
        }
        ul{
            list-style: none;
        }

     body{
        font-family: 'Cairo', sans-serif;

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


        </style>

    @yield('style')

       <!-- Scripts -->


    <!-- This makes the current user's id available in javascript -->

    </head>
    @yield('header')


<body>


<div class="container">
           <!-- Navbar top -->
           <div class="navbar-top">
            <div class="title">

                <h4>FreeLance</h4>
                <a href="{{route('freelancers')}}">Hire Frellancers</a>
                <a href="{{route('browseProject')}}">Browse Project</a>
                @if(auth()->guard('web')->check())

                <a href="{{route('client.project.index')}}">My projects</a>

                <a href="{{route('client.profile')}}">My Dashboard</a>
                <a href="{{route('client.project.create')}}">Post Project</a>
                @endif

                @if(auth()->guard('freelancer')->check())

                <a href="{{Route('freelancer.profile',Auth::guard('freelancer')->user()->id)}}"> My profile</a>

                <a href="{{Route('freelancer.dashboard',Auth::guard('freelancer')->user()->id)}}"> My Dashboard</a>
                @endif
            </div>

            <!-- Navbar -->

<div>

                    @if(auth()->guard('freelancer')->check())

              <a href="{{route('freelancer.logout')}}"  style="color: #e2e8f0;font-size:14px;margin-left: 20px;color: #e2e8f0; text-decoration: none;
              font-size: 14px;margin:20px;display:block" >
                logout
                </a>

                @elseif(auth()->guard('web')->check())
                    <a href="{{route('client.logout')}}"  style="color: #e2e8f0;font-size:14px;margin-left: 20px;color: #e2e8f0; text-decoration: none;padding-top: 20px;
                    font-size: 14px;margin:20px" >
                        logout
                    </a>

                @else
                <div style="display:flex;justify-content:space-between;margin-top:2;padding-right: 12px;
                ">
                <a href="{{route('login')}}" style="color: #e2e8f0;font-size:14px;margin-left: 20px;color: #e2e8f0; text-decoration: none;padding-top: 20px;
                font-size: 14px;" >Login as PlaceHolder</a>
                  <a href="{{route('login.freelancer')}}" style="color: #e2e8f0;font-size:14px;margin-left: 20px;color: #e2e8f0; text-decoration: none;padding-top: 20px;
                  font-size: 14px;" >Login as freelancer</a>
                <a href="{{route('register')}}" style="color: #e2e8f0;font-size:14px;margin-left: 20px;color: #e2e8f0; text-decoration: none;padding-top: 20px;
                font-size: 14px;">
                    Register
                </a>
            </div>
                @endif
            </div>
            <!-- End -->
        </div>
                <!-- End -->
     <div class="container">
        <div class="main-body ">

        @yield('content')
        </div>
    </div>

<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>



<script>$(document).ready(function() {
@if(Session::has('message'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
toastr.success("{{ session('message') }}");
@endif

@if(Session::has('error'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
toastr.error("{{ session('error') }}");
@endif

@if(Session::has('info'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
toastr.info("{{ session('info') }}");
@endif

@if(Session::has('warning'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
toastr.warning("{{ session('warning') }}");
@endif
});
</script>
@yield('scripts')
<script>
    $(document).ready(function() {
  $(".notification-drop .item").on('click',function() {
    $(this).find('ul').toggle();
  });
});
</script>
<script>

    const userId="{{Auth::guard('freelancer')->id()}}";
</script>
@vite(['resources/js/app.js'])
    </body>
    </html>
