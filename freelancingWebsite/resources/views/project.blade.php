
@extends('layouts.app')



@section('style')
<style>
    a,a:hover ,a:focus{
        text-decoration: none; /* no underline */

    }

h3 {
    font-size: 16px;
}
.text-navy {
    color: #1ab394;
}
.cart-product-imitation {
  text-align: center;
  padding-top: 30px;
  height: 80px;
  width: 80px;
  background-color: #f8f8f9;
}

table.shoping-cart-table {
  margin-bottom: 0;
}
table.shoping-cart-table tr td {
  border: none;
  text-align: right;
}
table.shoping-cart-table tr td.desc,
table.shoping-cart-table tr td:first-child {
  text-align: left;
}
table.shoping-cart-table tr td:last-child {
  width: 80px;
}
    .ibox {
  clear: both;
  margin-bottom: 25px;
  margin-top: 0;
  padding: 0;
}
.ibox.collapsed .ibox-content {
  display: none;
}
.ibox:after,
.ibox:before {
  display: table;
}
.ibox-title {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #ffffff;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 3px 0 0;
  color: inherit;
  margin-bottom: 0;
  padding: 14px 15px 7px;
  min-height: 48px;
}
.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}
.ibox-footer {
  color: inherit;
  border-top: 1px solid #e7eaec;
  font-size: 90%;
  background: #ffffff;
  padding: 10px 15px;
}
.star-rating {
  display: flex;
  align-items: center;
  width: 160px;
  flex-direction: row-reverse;
  justify-content: space-between;
  margin: 40px auto;
  position: relative;
}
/* hide the inputs */
.star-rating input {
  display: none;
}
/* set properties of all labels */
.star-rating > label {
  width: 30px;
  height: 30px;
  font-family: Arial;
  font-size: 30px;
  transition: 0.2s ease;
  color: orange;
}
/* give label a hover state */
.star-rating label:hover {
  color: #ff69b4;
  transition: 0.2s ease;
}
.star-rating label:active::before {
  transform:scale(1.1);
}

/* set shape of unselected label */
.star-rating label::before {
  content: '\2606';
  position: absolute;
  top: 0px;
  line-height: 26px;
  content:'\2605';
}
/* set full star shape for checked label and those that come after it */
.star-rating input:checked ~ label:before {

}

}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="container mt-5">
    <div class="main-body">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('browseProject')}}">Project</a></li>

        <li class="breadcrumb-item active" aria-current="page">{{$project->title}}</li>

      </ol>
    </nav>
    <!-- /Breadcrumb -->
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
                  </div>

                </div>

              </div>




              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Skills required</h6>
                    </div>

                  </div>
                  <hr>
                  <div class="row">
                   <div class="card-body">
                    <div class="inline-block">
                       @foreach ($skills as $skill )
                        <a href="{{route('showProjectByTag',$skill)}}" class="badge badge-primary"><i class="bi bi-tag">{{$skill}}</i></a>
                       @endforeach
                    </div>


                </div>

                  </div>

                </div>

              </div>
              @php
              if(Auth::guard('freelancer')->check()){
                  if(Auth::guard('freelancer')->user()->bids>0){
              $proposal=$project->proposals->where('freelancer_id',auth()->guard('freelancer')->id())->first();
                  }else{
                      $proposal="finshedBid";

                  }
              }else{
                $proposal='unAuthenticated';
              }

              @endphp
              @if( $proposal==null )
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                        <h6 class="mb-0"> Offer to work on this job now! </h6>
                      </div>



                  </div>
                  <hr>
                  <div class="row">
                   <div class="card-body">
                    <form action="{{route('freelancer.proposal.store')}}" method="post">
                        <input type="hidden" name="project_id" value="{{$project->id}}">

                        <div class="row gutters">

                                @csrf
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label for="Days"> Duration</label>
                                    <div class="input-group mb-3">
                                          <div class="input-group-append">
                                            <span class="input-group-text">days</span>
                                          </div>
                                          <input type="number" class="form-control @error('duration') is-invalid @enderror" aria-label="days" name="duration"  required>
                                    </div>
                                    @error('duration')
                                    <div class="danger">{{ $message }}</div>
                                     @enderror
                                 </div>
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label for="budget">Budget</label>
                                    <div class="input-group mb-3">
                                          <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                          </div>
                                          <input type="number" class="form-control @error('budget') is-invalid @enderror" aria-label="budget" name="budget" onkeyup="discountByPercent()" required>
                                    </div>
                                    @error('budget')
                                    <div class="danger">{{ $message }}</div>
                                     @enderror
                                 </div>
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label for="Dues">Dues</label>
                                    <div class="input-group mb-3">
                                          <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                          </div>
                                          <input type="text" class="form-control" aria-label="Dues" id="dues" name="Dues" disabled>
                                    </div>

                                 </div>


                            </div>


                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fullName">Details</label>
                                    <textarea  name="desc" class="form-control  @error('desc') is-invalid @enderror" rows="10" required></textarea>

                                </div>
                                @error('desc')
                                <div class="danger">{{ $message }}</div>
                                 @enderror
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

                                    <button type="submit" id="submit" name="submit" class="btn btn-success">Add Bid</button>
                                </div>
                            </div>
                        </div>

                        </form>


                </div>

                  </div>

                </div>

              </div>

              @elseif( $proposal=='unAuthenticated' && !Auth::check())
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                        <h6 class="mb-0"> Offer to work on this job now! </h6>
                      </div>
                      <a class="btn btn-primary" href="{{route('login.freelancer')}}"> Login to bid</a>



                  </div>
                  <hr>
                  <div class="row">
                   <div class="card-body">
                   </div></div>
                </div></div>
                @elseif( $proposal=='finshedBid')
                <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                        <h6 class="mb-0 text-center text-danger"> You finshed your bids! </h6>
                      </div>



                  </div>
                  <hr>
                  <div class="row">
                   <div class="card-body">
                   </div></div>
                </div></div>
                @else
                @endif
              <div class="card mb-3">
                <div class="card-body">
                @if($project->proposals()->count() !=0)

                  <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>{{$project->proposals()->count()}} freelancers are bidding on average  ${{floor($avgBid)}} for this job</h5>
                        </div>

                        <!-- Edit Book Modal -->


 <div class="modal fade mt-5" id="EditModalLabel" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true" style="z-index=500000">
    <div class="modal-dialog" role="document">
       <form data-parsley-validate class="form-horizontal form-label-left" action="{{ route('freelancer.proposal.update') }}" method="POST">
          @csrf
          <div class="modal-content">
             <div class="modal-header">
                 <h5> Edit Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body" >

                    <input type="hidden" name="proposalId" id="proposalId" value="">
                    <div class="row gutters mt-4">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <label for="Days"> Duration</label>
                        <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">days</span>
                              </div>
                              <input type="number" class="form-control" aria-label="days" name="duration" id="duration" required>
                        </div>

                     </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <label for="budget">Budget</label>
                        <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input type="number" class="form-control @error('budget') is-invalid @enderror" aria-label="budget" name="budget" id="budget" onkeyup="discountByPercent()" required>
                        </div>
                        @error('budget')
                        <div class="danger">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <label for="Dues">Dues</label>
                        <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input type="text" class="form-control" aria-label="Dues" id="dues" name="Dues" disabled>
                        </div>

                     </div>


                </div>
                <div class="row gutters mt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="desc">Details</label>
                            <textarea  name="desc" class="form-control   rows="10" id="desc" required>
                            </textarea>

                        </div>

                    </div>

                </div>
                <div class="row gutters mt-4">
                    <div class="col-12 mb-3">
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" name="uploads[]" type="file" id="formFile">
                      </div>
                </div>


             </div>
             <div class="modal-footer">
                <div class="col-md-6 col-sm-6 offset-md-5">
                   <button class="btn btn-danger" type="reset">Reset</button>
                   <button type="submit" class="btn btn-success">Update</button>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
                        @foreach ($project->proposals as $proposal )
                        <div class="ibox-content" id="proposal-{{$proposal->id}}">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <a href="{{route('freelancer.profile',$proposal->freelancer->id)}}" >
                                             @if($proposal->freelancer->image!=null)
                      <img src="{{asset($proposal->freelancer->image->path)}}" alt="Admin" class="rounded-circle" width="64" height="64">
                      @else
                      <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="rounded-circle" width="64" height="64">
                      @endif
                                            </a>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                            <a href="{{route('freelancer.profile',$proposal->freelancer->id)}}" class="text-navy">
                                                {{($proposal->freelancer->name)}}
                                            </a>



                                            </h3>





                                            <p class="small" >
                                                @php $rating = $proposal->freelancer->getRating();
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

                                            </p>

                                        </td>

                                        <td>
                                            <table class="border-none">
                                                <tr >
                                                <th>
                                                    duration

                                                </th>
                                                <th>
                                                    budget

                                                </th>
                                            </tr>
                                            <tr>
                                                <td>{{$proposal->duration}} days</td>
                                                <td> $ {{$proposal->budget}} </td>
                                            </tr>
                                            </table>

                                        </td>


                                    </tr>

                                    </tbody>

                                </table>
                                <tr>
                                    <dl class="small m-b-none">
                                        <dd>{{$proposal->desc}}</dd>
                                    </dl>

                                </tr>
                                @if(Auth::guard('freelancer')->id()==$proposal->freelancer_id)
                                <tr>
                                    <button type="button" data-toggle="modal" data-target="#EditModalLabel" value="{{ $proposal->id }}" class="btn btn-warning btn-xs editbtn " style="margin-right:5px;color:#fff">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                        </button>
                                </tr>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>

                </div>



                @else

                <div class="row pl-3">
                    <h6 class="mb-0">NO freelancers are bidding on  this job yet
                  </h6>

                </div>
                <hr>
                @endif




                </div>

              </div>


            </div>

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
                    <h6 class="mb-0">Posted date</h6>
                    <span class="text-secondary">{{$diff}}</span>
                  </li>
                  <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                    <h6 class="mb-0">Budget</h6>
                    <span class="text-secondary">${{$project->budget_from}}-{{$project->budget_to}}</span>
                  </li>
                  <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                    <h6 class="mb-0">implementation period</h6>
                    <span class="text-secondary"> {{$project->duration}} days</span>
                  </li>
                  <li class="list-group-item  borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                    <h6 class="mb-0">Avg of Bids</h6>
                    <span class="text-secondary"> ${{$avgBid}} </span>
                  </li>
                  <li class="list-group-item borderless d-flex justify-content-between align-items-center flex-wrap "  style="border: none">
                    <h6 class="mb-0">No.of Bids </h6>
                    <span class="text-secondary"> {{$project->proposals()->count()}} </span>
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
                    <h6 class="mb-0">About the Client:</h6>

                    <div class="d-xl-inline-flex" >
                        <div  class="mt-3 mr-3">
                      @if($project->user->image!=null)
                      <img src="{{asset($project->user->image->path)}}" alt="Admin" class="rounded-circle" width="64" height="64">
                      @else
                      <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="rounded-circle" width="64" height="64">
                      @endif
                    </div>
                      <div class="mt-3">
                        <h6>{{$project->user->name}}</h6>
                        <p class="text-muted font-size-sm"><img src="{{asset('assets/flags/'.$project->user->country.'.svg')}}" alt="Admin"  width="15" height="15"> {{$project->user->country}}</p>

                      </div>
                    </div>
                  </div>
              </div>
              <div class="card border-top mt-3 ">
                <div class="card-body">

                    <h6 class="mb-0">Share the project:</h6>
                    <hr>
                    <div class="panel-body">
                        <input class="form-control" readonly="" value="{{url()->current()}}" dir="ltr" data-action="selectOnFocus">
                    </div>
                    <div class="d-xl-inline-flex justify-content-center" >
                        <div  class="mt-3 mr-3">
                            <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{url()->current()}}&pubid=USERNAME&ct=1&title={{$project->title}}&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/>

                         </div>
                       <div class="mt-3 mr-3">
                        <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{url()->current()}}&title={{$project->title}}&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>

                      </div>
                      <div class="mt-3">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{url()->current()}}" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="linkedin"/></a>

                      </div>

                    </div>
                  </div>
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
                url: "{{ route('freelancer.fileUpload') }}",
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
                                url:"{{ route('freelancer.fileDestroy') }}",
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
        <script>
            function discountByPercent(e){
                let price= event.target.value;;
                axios.get('/dues/'+price)
  .then(function (response) {
      let dues= document.getElementById('dues');
    dues.value=response.data;
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });

            }
        </script>


<script>
$(document).ready(function(){
$(document).on('click','.editbtn',function(e){
  var book_id = $(this).val();
  e.preventDefault();
    $('#EditModalLabel').modal('show');
  $.ajax({
     type:"GET",
     url:"/freelancer/proposal-edit/"+book_id,
     success:function(response){
        $('#proposalId').val(response.proposal.id);
        $('#budget').val(response.proposal.budget);
        $('#duration').val(response.proposal.duration);
        $('#dues').val(response.proposal.dues);
        $('#desc').val(response.proposal.desc);
     }
  });
});
});
</script>

        @endsection
