@extends('admin.layout')
@section('title','Projects')
@section('content')
<div class="card">

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
          <tr>
            <th>#</th>
            <th>Client Name</th>
            <th>Title</th>
            <th>Budget</th>
            <th>Duration</th>
            <th>CategoryName</th>
            <th>ACTIONS</th>
          </tr>
          </thead>
          <tbody>
              @if($projects!=null)
              @foreach($projects as $project)
              <tr>
              <td>  {{ $projects->firstItem() + $loop->index }} </td>
            <td>{{$project->user->name}}</td>
            <td>{{$project->title}}</td>
            <td>${{$project->budget_from}}-{{$project->budget_to}}</td>
            <td>{{$project->duration}} days</td>
            <td>{{$project->category->name}}</td>

            <td>

  <a  class="btn btn-success" href="{{route('admin.openProject',$project->id)}}" > <i class="fa fa-check"></i>Open</a>
                <a  class="btn btn-info" href="{{route('showProject',$project->slug)}}" ><i class="fa fa-eye"></i> show</a>

            </td>
          </tr>
          @endforeach
          @else
          <tr>
          <td colspan="8" class="text-center">no projects </td>
        </tr>
        @endif

          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix" >

        {{$projects->links()}}

    </div>
    <!-- /.card-footer -->
  </div>

@endsection
