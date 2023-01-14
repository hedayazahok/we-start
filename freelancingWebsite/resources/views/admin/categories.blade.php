@extends('admin.layout')
@section('title','Categories')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="card">

    <div class="card-header pb-5 mr-3" style="position:relative">
        <button class="btn btn-success"  style="position:absolute;right:0" id="addButton" data-toggle="modal" data-target="#addModalCenter"  > <i class="fa fa-plus"></i>Add Category</button>
    </div>


    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
          <tr>
            <th>#</th>
            <th>CategoryName</th>
            <th>#no.Projects</th>
            <th>ACTIONS</th>
          </tr>
          </thead>
          <tbody>
              @if($categories!=null)
              @foreach($categories as $category)
              <tr>
              <td>  {{ $categories->firstItem() + $loop->index }} </td>
              <td>{{$category->name}}</td>
              <td>{{$category->projects()->count()}}</td>

            <td>

  <button class="btn btn-warning" id="editButton"onclick="editModalShow({{$category->id}},'{{$category->name}}')" data-toggle="modal" data-target="#editModalCenter"> <i class="fa fa-pen"></i>Edit</button>


                <form class="d-inline" action="{{ route('admin.category.delete', $category->id) }}"
                 method="post">
                        @csrf
                    @method('delete')
        <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn btn-danger btn-flat show-alert-delete-box " data-toggle="tooltip" title='Delete'><i class="fas fa-trash"></i>Delete</button>

                </form>

            </td>
          </tr>
          @endforeach
          @else
          <tr>
          <td colspan="8" class="text-center">no categories </td>
        </tr>
        @endif

          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix" >

        {{$categories->links()}}

    </div>
    <!-- /.card-footer -->
  </div>
<!-- Button trigger modal -->


  <!-- Edit Modal -->
  <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLongTitle">Edit Catgeory</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.category.update')}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" class="form-control" id="category-id" name="id">

              <div class="form-group">
                <label for="category-name" class="col-form-label">Category Name:</label>
                <input type="text" class="form-control" id="category-name-edit" name="name">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>


      </div>
    </div>
  </div>
<!-- Add Modal -->

 <div class="modal fade" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLongTitle">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.category.store')}}" method="post">
                @csrf

              <div class="form-group">
                <label for="category-name" class="col-form-label">Category Name:</label>
                <input type="text" class="form-control" id="category-name" name="name">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>


      </div>
    </div>
  </div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<script>
    function editModalShow (id ,name){

        $('#category-name-edit').val(name);
        $('#category-id').val(id);
      }
    </script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this category?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>


@endsection
