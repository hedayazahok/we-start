@extends('layouts.app')
@section('title',' Portfolios')
@section('content')
@endsection
<div id="carouselExampleIndicators" class=" row mt-4 carousel slide" data-ride="carousel" >

    <div class="carousel-inner  col-lg-12">
      <div class="carousel-item active">
        <img class="d-block w-50"  src="{{asset($portfolio->image->path)}}" alt="First slide">
      </div>
      @foreach($portfolio->files as $file)

      <div class="carousel-item">
        <img class="d-block w-50" src="{{asset($file->path)}}" alt="Second slide">
      </div>

    </div>
    @endforeach
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
