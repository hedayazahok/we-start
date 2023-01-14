@extends('layouts.app')


@section('style')
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
    <div class="main-body">


<div class="row gutters">
       <!-- Sidebar content -->
       <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
        <div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;"></div><div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 85px;"><div class="sticky-inner">
          <div class="bg-white mb-3">
            <h4 class="px-3 py-4 opacity-50 m-0">
              Filter by:
            </h4>
            <hr class="m-0">
            <div class="pos-relative px-3 py-3">

              <div class="col-xl-12">
                <label for="Days"> Budget</label>
                <div class="input-group mb-3">
                    <select class="custom-select  @error('budget') is-invalid @enderror" id="inputGroupSelect" name="budget" onselect=filterBudget() >
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
            <hr class="m-0">
            <div class="pos-relative px-3 py-3">

                <div class="col-xl-12">
                  <label for="Days"> All Durations</label>
                  <div class="input-group mb-3">
                      <select class="custom-select  @error('duration') is-invalid @enderror" id="duration" name="duration">
                        <option selected disabled>All Durations...</option>
                        <option value="l">Less than 1 week</option>
                        <option value="2">1 week to 4 weeks</option>
                        <option value="3">1 month to 3 months</option>
                        <option value="4">3 months to 6 months</option>
                        <option value="5">Over 6 months / Ongoing</option>
                      </select>
                   </div>
                   @error('budget')
                   <div class="danger">{{ $message }}</div>
                    @enderror
               </div>
              </div>

          </div>

        </div></div>
      </div>
        <!-- Main content -->
        <div class="col-lg-9 mb-3">
            @foreach ($projects as $project )


          <!-- start of project 1 -->

          <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-topacity-0 border-right-0 border-bottom-0 rounded-0" id="project-{{$project->id}}">
            <div class="row align-items-center">
              <div class="col-md-9 mb-3 mb-sm-0">
                <h5>
                  <a href="{{route('showProject',$project->slug)}}" class="text-primary">{{$project->title}}</a>
                </h5>

                <p class="text-sm" style="font-size:14px"><span class="opacity-60" style="color:#8f8a8a;">Posted</span>
                    @php
                     $from_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$project->created_at);
                    $diff = $from_date->diffForHumans();
                    @endphp
                    {{$diff}} <span class="opacity-60"  style="color:#8f8a8a;"> by</span> {{$project->user->name}}</p>
                    <div class="text-lg ">
                        <p>{{Str::limit($project->desc,300)}}</p>
                    </div>

                <div class="text-sm opacity-50">
                    @php
                    $skills=explode(',',$project->skills);
                    @endphp
                    @foreach($skills as $skill)
                    <a class="text-black mr-2" href="{{route('showProjectByTag',$skill)}}">#{{$skill}}</a>
                    @endforeach
                    </div>
              </div>
              <div class="col-md-2 opacity-70">
                <div class="row text-center opacity-70">
                  <div class="col px-6"><p class="d-block  fw-bold" style="font-weight: bold">$ {{$project->budget_from}}-{{$project->budget_to}}</p> </div>
                  <div class="col px-4"><span class="d-block text-sm">{{$project->proposals()->count()}} bids</span> </div>
                  <div class="col px-6 mt-1"><a href="{{route('showProject',$project->slug)}}" class="btn btn-success btn-sm" style="color:#fff"> Bid now </a></div>

                </div>
              </div>
            </div>
          </div>
          <!-- /End of project 1 -->
          @endforeach

        </div>

      </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).on('change', '[name="duration"]', function () {
        const data = {
           'duration' : $(this).val()
       }
        axios.post('/filter', data)
        .then(function (response) {


           projects = response.data.projects;
           $('.card').hide();

            projects.forEach(el => {
                console.log(el.id);
               $('#project-'+el.id).show();

            });



         });
    });
</script>
<script>
    $(document).on('change', '[name="budget"]', function () {
        const data = {
           'budget' : $(this).val()
       }
        axios.post('/filter', data)
        .then(function (response) {


           projects = response.data.projects;
           $('.card').hide();

            projects.forEach(el => {
                console.log(el.id);
               $('#project-'+el.id).show();

            });



         });
    });
</script>
@endsection
