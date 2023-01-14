@extends('layouts.app')
@section('title','Update Profile')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>

<style type="text/css">
    body {
        margin: 0;
        padding-top: 40px;
        color: #2e323c;
        background: #f5f6fa;
        position: relative;
        height: 100%;
    }
    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        text-align: center;
    }
    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }
    .account-settings .user-profile .user-avatar img {
        width: 90px;
        height: 90px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
        object-fit: cover;
        object-position: 80% 100%;


    }
    .account-settings .user-profile h5.user-name {
        margin: 0 0 0.5rem 0;
    }
    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 400;
        color: #9fa8b9;
    }
    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }
    .account-settings .about h5 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }
    .account-settings .about p {
        font-size: 0.825rem;
    }
    .form-control {
        border: 1px solid #cfd1d8;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        font-size: .825rem;
        background: #ffffff;
        color: #2e323c;
    }

    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }

    .bootstrap-tagsinput{
        width: 100%;
    }
    .label-info{
        background-color: #17a2b8;

    }
    .label {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,
        border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .danger{
        color:red;
        margin-right: 20px;
    }
    /*.is-invalid{
        border: 2px solid red;
    }*/


    </style>
@endsection

@section('content')
<div class="container">
    <div class="main-body">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item " ><a href="{{route('freelancer.profile',$freelancer->id)}}">profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Account sitting</li>


          </ol>
        </nav>
    <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <form method="post" action="{{route('freelancer.profile.setting',$freelancer->id)}}" enctype="multipart/form-data">
                @csrf

                @method('PUT')
            <div class="account-settings">
                <div class="user-profile">
                    <div class="user-avatar">
                        @if($freelancer->image!=null)
                        <input type="image" src="{{asset($freelancer->image->path)}}" class="rounded-circle"   width="150" height="150" >
                        @else
                        <input type="image" src="https://avatars.hsoubcdn.com/default?s=128" class="rounded-circle"   width="150" height="150"/>
                        @endif
                        <input type="file" id="inputImage" name="image" style="display: none;" />

                    </div>




                    <h5 class="user-name">{{$freelancer->name}}</h5>
                    <h6 class="user-email">{{$freelancer->email}}</h6>
                </div>

            </div>
        </div>
    </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Personal Details</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" name="name" class="form-control" id="fullName" placeholder="Enter full name" value="{{$freelancer->name}}">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="eMail">Email</label>
                        <input type="email"  name="email" class="form-control" id="eMail" placeholder="Enter email ID" value="{{$freelancer->email}}">
                    </div>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>


                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" class="form-control" required>
                            @foreach ($countries as $country )
                            <option value="{{$country->name}}" {{$freelancer->country == $country->name ? 'selected' : ''}}> {{$country->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                        <span class="text-danger">{{ $errors->first('country') }}</span>
                    @endif
                          </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}" @if($freelancer->category_id !=null) {{$freelancer->category_id == $category->id ? 'selected' : ''}} @endif> {{$category->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                          </div>
                </div>
                </div>
                <div class="row gutters">

                    <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                        <div class="form-group">
                            <label for="major">Major</label>
                            <input type="text"  name="major" class="form-control" id="major" placeholder="Enter Your major"  @if($freelancer->major !=null) value="{{$freelancer->major}}" @endif>
                        </div>
                        @if ($errors->has('major'))
                        <span class="text-danger">{{ $errors->first('major') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row gutters">

                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="fullName">Bio</label>
                        <textarea  name="bio" class="form-control  @error('bio') is-invalid @enderror" rows="10" >@if($freelancer->bio!=null){{$freelancer->bio}}@endif
                        </textarea>

                    </div>
                    @error('bio')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>
                </div>
                <div class="row gutters">

                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="fullName">Skills required</label>
                        <input type="text"  class="form-control  @error('skills') is-invalid @enderror" data-role="tagsinput" name="skills"  @if($skills!=null)value={{$skills}}@endif>

                    </div>
                    @error('skills')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>
        </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
    </div>
    </div>

    </div>

@endsection
@section('scripts')
<script>
$("input[type='image']").click(function(e) {
    e.preventDefault();
    $("input[id='inputImage']").click();
});
</script>
<script>
    let inputImage = document.querySelector('#inputImage');

inputImage.onchange = (e) => {
    e.preventDefault();
    let output = e.target.previousElementSibling;
    output.src = URL.createObjectURL(e.target.files[0]);

}
</script>
@endsection
