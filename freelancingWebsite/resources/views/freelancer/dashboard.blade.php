
@extends('layouts.app')
@section('title','dashboard')
@section('style')
<style>
    a,a:hover ,a:focus{
        text-decoration: none; /* no underline */

    }
</style>
@section('content')
<div class="container mt-5">
    <div class="main-body">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>

      </ol>
    </nav>
    <!-- /Breadcrumb -->


          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">

                    @if($freelancer->image!=null)
                    <img src="{{asset($freelancer->image->path)}}" alt="Admin" class="rounded-circle" width="150">
                    @else
                    <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="rounded-circle" width="150">
                    @endif
                    <div class="mt-3">
                      <h4>{{$freelancer->name}}</h4>
                      <p class="text-muted font-size-sm"><img src="{{asset('assets/flags/'.$freelancer->country.'.svg')}}" alt="Admin"  width="40" height="20"> {{$freelancer->country}}</p>
                      <a class="btn btn-primary" href="{{route('freelancer.profile.settingForm')}}">Edit Profile</a>


                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item  align-items-center">
                    <h6 style="text-align:center">New Messages</h6>
                  </li>
                  <li class="list-group-item   align-items-center ">
                    <h4 style="text-align:center">0</h4>
                  </li>
                  <li class="list-group-item   align-items-center ">
                      <div style="display: flex;justify-content:space-between">
                        <h6 style="text-align:left">incoming :0</h6>
                        <h6 style="text-align:left">outgoing :0</h6>
                    </div>
                  </li>

                </ul>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item  align-items-center">
                    <a href="{{Route('freelancer.portfolios.index',$freelancer->id)}}"><h6 style="text-align:center">Portfolios</h6></a>
                  </li>
                  <li class="list-group-item   align-items-center ">
                    <h4 style="text-align:center">{{$portfolios_count}}</h4>
                  </li>
                  <li class="list-group-item   align-items-center ">
                      <div style="text-align:center">
                        <a href="{{Route('freelancer.portfolios.create',$freelancer->id)}}" style><i class="fa fa-plus"></i> Add portfolio </a>
                    </div>
                  </li>

                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">

                <div>
                    <h6 style="color:#17a2b8;text-align:center;font-family:'Dancing Script', cursive" class="text-center"> Withdrawable balance</h6>
                    <h2 style="color:#17a2b8;text-align:center;">${{$freelancer->wallet}}</h2>
                    <div style="text-align:center;">
                        <form role="form" action="{{ route('payout') }}" method="post" class="validation"
                        data-cc-on-file="false"
                       data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                       id="payment-form">
@csrf

                        <button type="submit" class="btn btn-success launch" data-toggle="modal" data-target="#staticBackdrop"> <i class="fa fa-rocket"></i> withdraw </button>
                        </div>
                </div>




                </div>




              </div>
          <!-- propsals -->

              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                        <div class="card-header mb-3">
                     <h6 class="d-flex align-items-center mb-3">Proposals <i class="material-icons text-info ml-2">{{$proposals_count}}</i></h6>
                     <a class="btn btn-primary" href="{{route('freelancer.proposal.index')}}" >My proposal</a>

                    </div>
                      <small>Processing ({{($proposals_count!=0)?($processing_count/$proposals_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($proposals_count!=0)?($processing_count/$proposals_count)*100:0}}%" aria-valuenow="{{($proposals_count!=0)?($processing_count/$proposals_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <small>completed ({{($proposals_count!=0)?($completed_count/$proposals_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($proposals_count!=0)?($completed_count/$proposals_count)*100:0}}%" aria-valuenow="{{($proposals_count!=0)?($completed_count/$proposals_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <small>cancled ({{($proposals_count!=0)?($cancled_count/$proposals_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($proposals_count!=0)?($cancled_count/$proposals_count)*100:0}}%" aria-valuenow="{{($proposals_count!=0)?($cancled_count/$proposals_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>under Review ({{($proposals_count!=0)?($waiting_count/$proposals_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($proposals_count!=0)?($waiting_count/$proposals_count)*100:0}}%" aria-valuenow="{{($proposals_count!=0)?($waiting_count/$proposals_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <hr>
                      <div class="align-items-center  " >
                        <div style="display: flex;justify-content:space-between">
                          <h6 style="text-align:left">bids :{{$bids}}</h6>
                          <h6 style="text-align:left">Avaliable bid :{{$bids_avaliable}}</h6>
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
