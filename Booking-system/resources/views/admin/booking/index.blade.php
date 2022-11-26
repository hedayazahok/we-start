
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
                         Client Name
                    </th>
                    <th style="width: 8%">
                        Client phone
                    </th>
                    <th style="width: 1%">
                        Booking price
                    </th>
                    <th style="width: 20%">
                        arrival date
                    </th>
                    <th style="width: 20%">
                        departure date
                    </th>
                    <th style="width: 18%">
                        chalet name
                    </th>
                    <th style="width: 1%">
                        No. of Adults
                    </th>


                    <th style="width: 1%" class="text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $resv)


                <tr id="res-{{$resv->id}}">
                    <td>
                        {{$loop->iteration }}
                    </td>
                    <td>
                        <a>
                            {{$resv->name}}

                        </a>
                        <br/>
                        <small>
                            {{ ($resv->created_at)->format('d-m-Y') }}


                        </small>
                    </td>
                    <td>
                        {{$resv->phone }}
                    </td>


                    <td class="project-state">
                        <span class="badge badge-success">{{$resv->price}}</span>
                    </td>

                    <td>
                        {{$resv->arrival_date }}
                    </td>
                    <td>
                        {{ $resv->departure_date}}
                    </td>
                    <td>
                        {{$resv->chalet->name}}
                    </td>

                    <td>
                        {{$resv->num_adult }}
                    </td>


                    <td class="project-actions text-right">


                        <button type="button" class="btn btn-danger btn-sm" onclick="removeChalet({{$resv->id }})">
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
      {{$reservations->links()}}
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
            title: "Are you sure you want to delete this booking?",
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
           url:" http://127.0.0.1:8000/dashboard/booking/"+id,
           success:function(data){
               $('#res-'+id).remove();
               toastr.success(data.success);


            }
        });

}
});

}






</script>

@endsection
