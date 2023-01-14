@extends('layouts.app')
@section('title','Add Portfolio')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>


<style type="text/css">

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
        <li class="breadcrumb-item"><a href="{{route('freelancer.profile',$freelancer->id)}}">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create portfolio</li>

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
                    <p>Start building your portfolio
                        Add your previous work that you have implemented, adding business to the profile helps entrepreneurs know your skills and increases your chances of employment.</p>
                        <p>Your business demonstrates your skills and experience
                            Post high-quality work and keep it up-to-date with the new techniques and skills you acquire..</p>
                            <p>Don't have previous works?
                                Design a logo, translate an article, or create your own website, then use these works in your gallery. It is useful to see how the show business is built.</p>
                                <p>
                                    Turn your business into a source of income
Make a regular profit by converting your high-quality business into products and displaying them for sale in Baikalia, the Arab Digital Products Store
                                </p>
                </div>
            </div>
        </div>
    </div>
    </div>



    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <form action="{{route('freelancer.portfolios.store')}}" method="post" enctype="multipart/form-data">

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Add Portfolio</h6>
                </div>
                    @csrf
                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fullName">Portfolio title</label>
                        <input type="text"  name="title" class="form-control @error('title') is-invalid @enderror" id="fullName" placeholder="Enter full name"  required>
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
                <div class="col-12">
                    <div class="form-group">
                        <label for="inputImage">main photo</label>
                        <input type="file" name="image" class="form-control"
                            id="inputImage" required>
                        <img width="80" class="img-thumbnail" src="">
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="fullName">Details</label>
                        <textarea  name="desc" class="form-control  @error('desc') is-invalid @enderror" rows="10"  required>
                        </textarea>

                    </div>
                    @error('desc')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>

                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="fullName">Portfolio url</label>
                        <input type="url"  name="urls" class="form-control @error('urls') is-invalid @enderror" id="fullName" placeholder="Enter full name"  >
                    </div>
                    @error('title')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>

                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="fullName">Skills required</label>
                        <input type="text"  class="form-control" data-role="tagsinput" name="skills" >

                    </div>
                    @error('skills')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                </div>
                <div class="col-xl-12 col-lg-12 col-lg-12 col-lg-12 col-12">
                    <div class="form-group">
                        <label for="exec_date">Date of completion</label>
                        <input type="date"  name="exec_date" class="form-control @error('exec_date') is-invalid @enderror" id="exec_date" placeholder="Enter full name" required >
                    </div>
                    @error('exec_date')
                    <div class="danger">{{ $message }}</div>
                     @enderror
                 </div>


                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="dropzone" id="gallery">
                        <div class="dz-message">
                            Upload Files
                        </div>
                    </div>


                        <div class="gallery-wrapper"></div>
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
        url: "{{ route('freelancer.portfolios.fileUpload') }}",
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
                        url:"{{ route('freelancer.portfolios.fileDestroy') }}",
						data: {filename: name},
						success: function (data){
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
<script>
    let inputImage = document.querySelector('#inputImage');

inputImage.onchange = (e) => {
    let output = e.target.nextElementSibling;
    // console.log(output);
    output.src = URL.createObjectURL(e.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
}
</script>
@endsection

