
@extends('admin.master')

@section('style')
<style>
td,th{
    text-align: center;
    vertical-align: center;

}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')

<section class="content">
   <div class="card-body pb-2 ">
    <a href="{{route('admin.chalet.create')}}" class="btn btn-success float-right" >add new chalet</a>
   </div>


    <!-- Default box -->
    <div class="card">

      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>

                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        chalet Name
                    </th>
                    <th style="width: 30%">
                        images
                    </th>
                    <th style="width: 1%">
                        price
                    </th>

                    <th style="width: 20%">
                        Booking Progress
                    </th>
                    <th style="width: 20%" class="text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($chalets as $chalet)


                <tr id="chalet-{{$chalet->id}}">
                    <td>
                        {{$loop->iteration }}
                    </td>
                    <td>
                        <a>
                            {{$chalet->name}}

                        </a>
                        <br/>
                        <small>
                            {{ ($chalet->created_at)->format('d-m-Y') }}


                        </small>
                    </td>
                    <td>
                        <ul class="list-inline">
                            @foreach ($chalet->images as $img )

                            <li class="list-inline-item">
                               <img alt="Avatar" class="table-avatar" src="{{asset($img->path)}}">
                            </li>
                            @endforeach

                        </ul>
                    </td>

                    <td class="project-state">
                        <span class="badge badge-success">{{$chalet->price}}</span>
                    </td>

                    <td class="project-state">
                        <div class="progress progress-sm">
                   <div class="progress-bar bg-green" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:{{$chalet->bookings()->count()}}%">
                            </div>
                        </div>
                        <small>
                            {{$chalet->bookings()->count()}}% Complete
                        </small>
                    </td>
                    <td class="project-actions text-center">
                        <a class="btn btn-info btn-sm" href="{{route('admin.booking.show',$chalet->id)}}">
                            <i class="fas fa-eye">
                            </i>

                        </a>

                        <a class="btn btn-info btn-sm" href="{{route('admin.chalet.create',$chalet)}}">
                            <i class="fas fa-pencil-alt">
                            </i>

                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeChalet({{$chalet->id}})">
                            <i class="fas fa-trash">
                            </i>

                        </button>
                    </td>
                </tr>

                @empty
                <tr>
                <td colspan="6">
                   <h5 style="vertical-align: center;text-align:center">no chalets yet</h5>
                </td>
                </tr>
        @endforelse

            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
function removeChalet(id) {

    swal({
            toast: true,
            title: "Are you sure you want to delete this chalet?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#d11506',
            cancelButtonColor: '#d11506',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
           type:'DELETE',
           url:" http://127.0.0.1:8000/dashboard/chalet/"+id,
           success:function(data){
               $('#chalet-'+id).remove();
               toastr.success(data.success);


            }
        });

}
});

}






</script>

@endsection
