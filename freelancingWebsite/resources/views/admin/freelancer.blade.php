@extends('admin.layout')
@section('title','Freelancers')
@section('content')
<div class="card">

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
          <tr>
            <th>#</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>COUNTRY</th>
            <th>WALLET</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
          </tr>
          </thead>
          <tbody>
              @if($freelancers!=null)
              @foreach($freelancers as $freelancer)
              <tr>
              <td>  {{ $freelancers->firstItem() + $loop->index }} </td>
            <td><a href="{{route('client.profile')}}">{{$freelancer->name}}</a></td>
            <td>{{$freelancer->email}}</td>
            <td>{{$freelancer->country}}</td>
            <td>${{$freelancer->wallet}}</td>
            @if($freelancer->status=='open')
            <td><span class="badge badge-success">{{$freelancer->status}}</span></td>
            @elseif($freelancer->status=='suspend')
            <td><span class="badge badge-warning">{{$freelancer->status}}</span></td>

            @else
            <td><span class="badge badge-danger">{{$freelancer->status}}</span></td>

            @endif
            <td>
                <form action="{{route('admin.changeStatus')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$freelancer->id}}" name="id">
                    <input type="hidden" value="freelancer" name="type">
                @if($freelancer->status=='suspend')
                <button  class="btn btn-success" type="submit" name="status" value="open"> Unsuspend</button>

                @endif
                @if($freelancer->status=='open')
                <button class="btn btn-warning" type="submit" name="status" value="suspend" > Suspend</button>
                @endif



            </form>

          </tr>
          @endforeach
          @else
          <tr>
          <td colspan="7" class="text-center">no freelancers </td>
        </tr>
        @endif

          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix" >

        {{$freelancers->links()}}

    </div>
    <!-- /.card-footer -->
  </div>

@endsection
