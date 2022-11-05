@extends('admin.master')
@section('title', 'All Posts | ' . env('APP_NAME'))
@section('styles')
 <script src="https://cdn.tailwindcss.com"></script>

<style>
    .table th,
    .table td {
        vertical-align: middle
    }

    #btn-save{
        width: 100%;
        background-color: #17a2b8;
        color:aliceblue;
        text-align: center;
        border:1px solid #17a2b8;
        padding:10px;
        transform: all .3s ease;

    }
    #btn-save:hover{
        background-color: #fff;
        color:#17a2b8;

    }
    .swal-footer {
text-align: center;
}




</style>

@stop
@section('title', 'All Posts | ' . env('APP_NAME'))

@section('content')



<table class="table table-bordered table-hover table-striped">
    <tr class="bg-dark text-white">
        <th>ID</th>
        <th>Title</th>
        <th>Image</th>
        <th>Author</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>

    @forelse ($posts as $post)
    @php
    $id= 'post_'.$post->id;
    $i=$post->id;
    $postCount=10;
    @endphp
        <tr id="{{$id}}">
            <td id="td_id_".{{$i}}>{{ $post->id }}</td>
            <td id="td_title_".{{$i}}>{{ $post->title }}</td>
            <td id="td_img_".{{$i}}><img width="100" src="{{ asset($post->image )}}" alt=""></td>
            <td id="td_user_id_".{{$i}}>{{ $post->user_id }}</td>
            <td id="td_created_at_".{{$i}}>{{ $post->created_at }}</td>
            <td id="td_updated_at_".{{$i}}>{{ $post->updated_at }}</td>
            <td>
                {{-- <div class="btn-group"> --}}
                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-primary btn-sm " onclick="editmodel({{$post->id}})"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" id="deletebtn" name="{{$post->id}}" onclick="deletepost({{$post->id}})"><i class="fas fa-trash"></i></a>
                {{-- </div> --}}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">No Data Found</td>
        </tr>
    @endforelse




</table>

{{ $posts->links() }}
{{--
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header" style="background-color: #17a2b8;color:aliceblue;font-weight:bold;">
            <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">×</span></button>

        </div>
        <div class="modal-body">
        <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
            <div class="card-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" class="form-control"  id="title" placeholder="Enter title of the post">
                </div>


               <div class="card-body">

                <div class="form-group">
                    <textarea class="ckeditor form-control" name="content"></textarea>
                </div>

        </div>

        <div class="form-group">
            <label for="image">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" onchange="loadFile(event)" id="image" name="image">
                <label class="custom-file-label" for="image">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div>
          <div><img id="output" width="200" height="200" src="https://via.placeholder.com/200" style="margin:0 auto;"/></div>
        </form>
        </div>
        <div class="modal-footer" >
        <button type="button" class="btn btn-info" id="btn-save" value="edit">Save changes</button>
        <input type="hidden" id="product_id" name="id" value="0">
        </div>
    </div>
  </div>
</div>
--}}
</div>
@stop
@section('headerTitle')
All Posts
@endsection

@section('currentpage')
    All posts
    @endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js" integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    </script>
<script>
//let deletebtn=document.querySelector("#deletebtn");


function  deletepost($id) {
    //e.preventDefault();

    swal({
            title: "Are you sure you want to delete this post?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#d11506',
            cancelButtonColor: '#d11506',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                axios.post('/admin/posts/'+$id, {
  _method: 'DELETE'
})
.then( response => {
    document.getElementById("post_"+$id).remove();





})
.catch( error => {
   console.log(error);
})
            }
        });




}


function editmodel($id){

    $('#myModal').modal('show');

    axios.post('/admin/posts/'+$id+'/edit', {
  _method: 'PUT'
})
.then( response => {
    //document.getElementById("post_"+$id).






})
.catch( error => {
   console.log(error);
})


}
$(document).on('click','.open_modal',function(){
        var url = "domain.com/yoururl";
        var tour_id= $(this).val();
        $.get(url + '/' + tour_id, function (data) {
            //success data
            console.log(data);
            $('#tour_id').val(data.id);
            $('#name').val(data.name);
            $('#details').val(data.details);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        })
    });


</script>
@endsection
