@extends('layouts.app')
@section('title','Project  Delivery')
@section('style')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
/>

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
    .rating-box {
  padding: 25px 50px;
  background-color: #f1f1f1;
  border-radius: 25px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
  text-align: center;
}
.rating-box h3 {
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 20px;
}
.rating-box .stars {
  display: flex;
  align-items: center;
  gap: 25px;
}
.stars i {
  font-size: 35px;
  color: #b5b8b1;
  transition: all 0.2s;
  cursor: pointer;
}
.stars i.active {
  color: #ffb851;
  transform: scale(1.2);
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
        <li class="breadcrumb-item"><a href="{{route('contractPage',$proposal->id)}}">Discussion Contract</a></li>
        <li class="breadcrumb-item active" aria-current="page">Delivery Project</li>

      </ol>
    </nav>
    <!-- /Breadcrumb -->
    <div class="row gutters">


            <div class="card-body">
                @if(Auth::check()&&$proposal->status=='completed'&&$proposal->contract->status!="completed")

                <h2 class="text-center"> The project has been delivered</h2>
                <div class="row gutters mb-5" >
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2" >

                            <a  href="{{route('file.download',$proposal->id)}}" class="btn btn-primary text-center " style="display:block;margin:0 auto;padding:10px;border-radius:2%" ><i class="fa-solid fa-file-arrow-down"></i></i>  download upload files for project </a>


                   </div>

               </div>
               @else
               <h2 class="text-center"> No file  has been delivered</h2>
               @endif
               @if(Auth::guard('freelancer')->check()&&$proposal->contract->status!="completed")

             <form action="{{route('freelancer.proposal.complete',$proposal->id)}}" method="post" enctype="multipart/form-data">


                         @csrf


                 <div class="row gutters">
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                         <h6 class="mt-3 mb-2 text-primary">For Upload more files:</h6>
                     </div>
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                         <input type="file" name="uploads[]" class="form-control" >



                         </div>
                 </div>

                 <div class="row gutters mt-4">
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                         <div class="text-right">

                             <button type="submit" id="submit" name="submit" class="btn btn-success">project deliver </button>
                         </div>
                     </div>
                 </div>

                 </form>

@endif

@if(auth()->guard('web')->check()&&$proposal->project->user_id==Auth::id())


@if($proposal->contract->status!="completed")
<div class="row gutters mt-4">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="text-left">
            <h4>You have to confirm receipt of the project to complete the contract, and if receipt is not confirmed after 7 days, it will be confirmed directly by the admin  </h4>

 <a class="btn btn-success" href="{{route('client.contract.complete',$proposal->contract->id )}}" ><i class="fa-solid fa-check"></i> confirm the Receipt </a>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="text-left">
            <h4>if you want to reject receipt of the project   </h4>

 <a class="btn btn-danger" href="{{route('client.contract.reject',$proposal->id )}}" ><i class="fa-solid fa-close"></i> Reject the Receipt </a>
        </div>
    </div>
</div>

@endif

@endif

@if($proposal->contract->status=="completed" && Auth::check())
<div class="row gutters mt-4">
    <div class="col-12">
        <div class="text-center">
            <h2><i class="fa-solid fa-check"></i> The project has been received  </h2>
            <div class="rating-box">
                <h3>rating freelancer</h3>
                <div class="stars">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
              </div>


        </div>
    </div>
</div>
@endif


            </div>

</div>
@endsection


@section('scripts')

<script>
    // ---- ---- Const ---- ---- //
const stars = document.querySelectorAll('.stars i');
const starsNone = document.querySelector('.rating-box');

// ---- ---- Stars ---- ---- //
stars.forEach((star, index1) => {
  star.addEventListener('click', () => {
    stars.forEach((star, index2) => {
      // ---- ---- Active Star ---- ---- //
      index1 >= index2
        ? star.classList.add('active')
        : star.classList.remove('active');
    });
  });
});
</script>
@endsection

