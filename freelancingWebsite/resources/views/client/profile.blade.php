@extends('layouts.app')
@section('title','Profile')
@section('style')
<style>
    a,a:hover ,a:focus{
        text-decoration: none; /* no underline */

    }
    .launch{height: 50px}.close{font-size: 21px;cursor: pointer}.modal-body{height: 450px}.nav-tabs{border:none !important}.nav-tabs .nav-link.active{color: #495057;background-color: #fff;border-color: #ffffff #ffffff #fff;border-top: 3px solid blue !important}.nav-tabs .nav-link{margin-bottom: -1px;border: 1px solid transparent;border-top-left-radius: 0rem;border-top-right-radius: 0rem;border-top: 3px solid #eee;font-size: 20px}.nav-tabs .nav-link:hover{border-color: #e9ecef #ffffff #ffffff}.nav-tabs{display: table !important;width: 100%}.nav-item{display: table-cell}.form-control{border-bottom: 1px solid #eee !important;border:none;font-weight: 600}.form-control:focus{color: #495057;background-color: #fff;border-color: #8bbafe;outline: 0;box-shadow: none}.inputbox{position: relative;margin-bottom: 20px;width: 100%}.inputbox span{position: absolute;top:7px;left: 11px;transition: 0.5s}.inputbox i{position: absolute;top: 13px;right: 8px;transition: 0.5s;color: #3F51B5}input::-webkit-outer-spin-button, input::-webkit-inner-spin-button{-webkit-appearance: none;margin: 0}.inputbox input:focus~span{transform: translateX(-0px) translateY(-15px);font-size: 12px}.inputbox input:valid~span{transform: translateX(-0px) translateY(-15px);font-size: 12px}.pay button{height: 47px;border-radius: 37px}
</style>
@section('content')
<div class="container mt-5">
    <div class="main-body">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">profile</li>

      </ol>
    </nav>
    <!-- /Breadcrumb -->


          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">

                    @if(Auth::user()->image!=null)
                    <img src="{{asset(Auth::user()->image->path)}}" alt="Admin" class="rounded-circle" width="150">
                    @else
                    <img src="https://avatars.hsoubcdn.com/default?s=128" alt="Admin" class="rounded-circle" width="150">
                    @endif
                    <div class="mt-3">
                      <h4>{{auth()->user()->name}}</h4>
                      <p class="text-muted font-size-sm"><img src="{{asset('assets/flags/'.auth()->user()->country.'.svg')}}" alt="Admin"  width="40" height="20"> {{auth()->user()->country}}</p>
                      <a class="btn btn-primary" href="{{route('client.profile.settingForm')}}">Edit Profile</a>
                      <a href="{{route('client.project.index')}}" class="btn btn-outline-primary">My Projects</a>

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
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                    <h6 style="color:#17a2b8;text-align:center;font-family:'Dancing Script', cursive">Total balance</h6>


                    <h2 style="color:#17a2b8;text-align:center;">${{Auth::user()->wallet}}</h2>
                   <div style="text-align:center;">

                     <button type="button" class="btn btn-success launch" data-toggle="modal" data-target="#staticBackdrop"> <i class="fa fa-rocket"></i> Charge the wallet</button>
                     </div>

                </div>
              </div>
          <!-- projects -->

              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                        <div class="card-header">
                      <a class="non-decoration"href="{{route('client.project.index')}}"><h6 class="d-flex align-items-center mb-3">Projects <i class="material-icons text-info ml-2">{{Auth::user()->projects()->count()}}</i></h6> </a> <a href="{{route('client.project.create')}}" class="btn btn-success">Post Project</a>

                    </div>
                      <small>Opened ({{($projects_count!=0)?($opened_count/$projects_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($projects_count!=0)?($opened_count/$projects_count)*100:0}}%" aria-valuenow="{{($projects_count!=0)?($opened_count/$projects_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <small>completed ({{($projects_count!=0)?($completed_count/$projects_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($projects_count!=0)?($completed_count/$projects_count)*100:0}}%" aria-valuenow="{{($projects_count!=0)?($completed_count/$projects_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <small>cancled ({{($projects_count!=0)?($cancled_count/$projects_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($projects_count!=0)?($cancled_count/$projects_count)*100:0}}%" aria-valuenow="{{($projects_count!=0)?($cancled_count/$projects_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>under Review ({{($projects_count!=0)?($underReview_count/$projects_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($projects_count!=0)?($underReview_count/$projects_count)*100:0}}%" aria-valuenow="{{($projects_count!=0)?($underReview_count/$projects_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>On going ({{($projects_count!=0)?($ongoing_count/$projects_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($projects_count!=0)?($ongoing_count/$projects_count)*100:0}}%" aria-valuenow="{{($projects_count!=0)?($ongoing_count/$projects_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Closed ({{($projects_count!=0)?($closed_count/$projects_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($projects_count!=0)?($closed_count/$projects_count)*100:0}}%" aria-valuenow="{{($projects_count!=0)?($closed_count/$projects_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Cansled ({{($projects_count!=0)?($cancled_count/$projects_count)*100:0}}%)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{($projects_count!=0)?($cancled_count/$projects_count)*100:0}}%" aria-valuenow="{{($projects_count!=0)?($cancled_count/$projects_count)*100:0}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>



            </div>
          </div>

        </div>
</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">

         <div class="modal-content">
            <div class="modal-header" style="background-color: #17a2b8;color: #fff;">
                <h5 class="modal-title" id="exampleModalLongTitle">Credit card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                  <div class="text-right">
                       <i class="fa fa-close close" data-dismiss="modal"></i>
                    </div>
                     <div class="tabs mt-3">

                                 <div class="tab-content" id="myTabContent">
                                     <div class="tab-pane fade show active" id="visa" role="tabpanel" aria-labelledby="visa-tab"> <div class="mt-4 mx-4">

                                               <div class="panel panel-default">

                                                <div class="panel-body">



   <form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation"
                                                                                     data-cc-on-file="false"
                                                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                                                    id="payment-form">
                                                        @csrf

                                                        <div class='form-row row'>
                                                            <div class='col-12 form-group required'>
                                                                <label class='control-label'>Card Balance </label> <input
                                                                class='form-control card-balnce'  type='number' name="amount">
                                                            </div>
                                                        </div>
                                                        <div class='form-row row'>

                                                            <div class='col-12 form-group  required'>
                                                                <label class='control-label'>Card Number</label> <input
                                                                    autocomplete='off' class='form-control card-num' size='20'
                                                                    type='text' name="cardno">
                                                            </div>
                                                        </div>

                                                        <div class='form-row row'>
                                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                                <label class='control-label'>CVC</label>
                                                                <input autocomplete='off' class='form-control' placeholder='e.g 415' size='4'
                                                                    type='text' name="cvc">
                                                            </div>
                                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                <label class='control-label'>Expiration Month</label> <input
                                                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                                                    type='text' name="expMonth">
                                                            </div>
                                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                <label class='control-label'>Expiration Year</label> <input
                                                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                                    type='text' name="expYear">
                                                            </div>
                                                        </div>

                                                        <div class='form-row row'>
                                                            <div class='col-md-12 hide error form-group'>
                                                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <button class="btn btn-primary  btn-lg btn-block" type="submit">Charge Now</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                          </div></div></div></div></div></div></div></div>





@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        //amount: $('.card-balnce').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }

  });

  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>



@endsection
