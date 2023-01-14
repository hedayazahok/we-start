@extends('layouts.app')
@section('title','myProjects')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>

<style type="text/css">
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
<div class="container mt-5">
    <div class="main-body">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('client.profile')}}">profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Post project</li>

      </ol>
    </nav>
    <!-- /Breadcrumb -->
<div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="account-settings">
                <div class="user-profile mb-3 mt-3">

                    <h5 class="user-name" style="font-family: 'Dancing Script', cursive;">Start completing your project</h5>
                    <hr>
                </div>
                <div class="about">
                    <p>You can complete your project in the way you want through a freelancer. Enter the project details, budget, and expected duration to be reviewed and published for free. After that, it will appear to the freelancers on the projects page and submit their offers on it. You choose the most suitable offer for you and the freelancer starts implementing the project..</p>
                </div>
            </div>
        </div>
    </div>
    </div>



    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <form action="{{route('client.project.store')}}" method="post">

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Post Project</h6>
                </div>
                    @csrf
                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fullName">Project title</label>
                        <input type="text"  name="title" class="form-control @error('title') is-invalid @enderror" id="fullName" placeholder="Enter full name"  >
                    </div>
                    @error('title')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>
                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}" > {{$category->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                          </div>
                </div>


                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="fullName">Skills required</label>
                        <input type="text"  class="form-control  @error('skills') is-invalid @enderror" data-role="tagsinput" name="skills" >

                    </div>
                    @error('skills')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>
                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="fullName">Details</label>
                        <textarea  name="desc" class="form-control  @error('desc') is-invalid @enderror" rows="10" ></textarea>

                    </div>
                    @error('desc')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="Days">Expected duration</label>
                    <div class="input-group mb-3">
                          <div class="input-group-append">
                            <span class="input-group-text">days</span>
                          </div>
                          <input type="number" class="form-control @error('duration') is-invalid @enderror" aria-label="days" name="duration" >
                    </div>
                    @error('duration')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                 </div>

                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="Days">Expected Budget</label>
                    <div class="input-group mb-3">
                        <select class="custom-select  @error('budget') is-invalid @enderror" id="inputGroupSelect" name="budget" >
                          <option selected disabled>Choose...</option>
                          <option value="25-50">$ 25-50</option>
                          <option value="50-100">$ 50-100</option>
                          <option value="100-250">$ 100-250</option>
                          <option value="250-500">$ 250-500</option>
                          <option value="500-1000">$ 500-1000</option>
                          <option value="1000-2500">$ 1000-2500</option>
                          <option value="2500-5000">$ 2500-5000</option>
                          <option value="5000-10000">$ 5000-10000</option>
                        </select>
                     </div>
                     @error('budget')
                     <div class="danger">{{ $message }}</div>
                      @enderror
                 </div>
                </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Upload files</h6>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="dropzone" id="gallery">
                        <div class="dz-message">
                            Upload Files
                        </div>
                    </div>


                        <div class="gallery-wrapper"></div>
                    </div>
            </div>







            <div class="row gutters mt-4">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">

                        <button type="submit" id="submit" name="submit" class="btn btn-success">Post Project</button>
                    </div>
                </div>
            </div>

            </form>

        </div>
    </div>
    </div>
    </div>

</div>

</div>
@endsection


@section('scripts')
<script type="text/javascript">

var uploadedDocumentMap = {}
    Dropzone.autoDiscover = false;
    let myDropzone = new Dropzone("div#gallery", {
        url: "{{ route('client.fileUpload') }}",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        addRemoveLinks: true,
        success: function(file, response) {
            let img = `<input type="hidden" name="uploads[]" value="${response}" />`
            document.querySelector('.gallery-wrapper').insertAdjacentHTML("beforeend", img );
            uploadedDocumentMap[file.name] = response
        },
        removedfile: function(file)
            {
				if (this.options.dictRemoveFile) {
				  return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
					if(file.previewElement.id != ""){
						var name = uploadedDocumentMap[file.name];
					}else{
						var name = uploadedDocumentMap[file.name];
					}
					console.log(name);
					$.ajax({
						headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
							  },
						type: 'POST',
						url:"{{ route('client.fileDestroy') }}",
						data: {filename: name},
						success: function (data){
							alert(data.success +" File has been successfully removed!");
						},
						error: function(e) {
							console.log(e);
						}
                    });
						var fileRef;
						return (fileRef = file.previewElement) != null ?
						fileRef.parentNode.removeChild(file.previewElement) : void 0;
				   });
			    }
            },

    });
</script>
@endsection

