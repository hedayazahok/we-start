@extends('admin.layout')
@section('title','Users')
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
              @if($users!=null)
              @foreach($users as $user)
              <tr>
              <td>  {{ $users->firstItem() + $loop->index }} </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->country}}</td>
            <td>${{$user->wallet}}</td>
            @if($user->status=='open')
            <td><span class="badge badge-success">{{$user->status}}</span></td>
            @elseif($user->status=='suspend')
            <td><span class="badge badge-warning">{{$user->status}}</span></td>

            @else
            <td><span class="badge badge-danger">{{$user->status}}</span></td>

            @endif
            <td>
                <form action="{{route('admin.changeStatus')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="id">
                    <input type="hidden" value="user" name="type">
                @if($user->status=='suspend')
                <button  class="btn btn-success" type="submit" name="status" value="open"> Unsuspend</button>

                @endif
                @if($user->status=='open')
                <button class="btn btn-warning" type="submit" name="status" value="suspend" > Suspend</button>
                @endif



            </form>

          </tr>
          @endforeach
          @else
          <tr>
          <td colspan="7" class="text-center">no users </td>
        </tr>
        @endif

          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix" >

        {{$users->links()}}

    </div>
    <!-- /.card-footer -->
  </div>

@endsection
