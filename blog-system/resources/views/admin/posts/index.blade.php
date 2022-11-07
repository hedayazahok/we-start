@extends('admin.master')
@section('title', 'All Posts | ' . env('APP_NAME'))
@section('styles')
 <script src="https://cdn.tailwindcss.com"></script>
 <meta name="csrf-token" content="{{ csrf_token() }}">

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

#dropdown-toggle{
opacity:1;
}




</style>

@stop
@section('title', 'All Posts | ' . env('APP_NAME'))

@section('content')
<form id="search-form" action="{{route('admin.posts.index')}}" method="GET">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search here.." name="search" id="search" value="{{ request()->search }}">
        <select name="count" id="count">
            <option @selected(request()->count == 10) value="10">10</option>
            <option @selected(request()->count == 15) value="15">15</option>
            <option @selected(request()->count == 20) value="20">20</option>
            <option @selected(request()->count == $posts->total()) value="{{ $posts->total() }}">All</option>
        </select>
        <div class="input-group-append">
          <button class="btn btn-dark px-4" id="button-addon2">Button</button>
        </div>
      </div>
</form>
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
            <td id="td_img_".{{$i}}><img width="100" src="{{asset($post->image)}}" alt=""></td>
            <td id="td_user_id_".{{$i}}>{{ $post->user_id }}</td>
            <td id="td_created_at_".{{$i}}>{{ $post->created_at }}</td>
            <td id="td_updated_at_".{{$i}}>{{ $post->updated_at }}</td>
            <td>
                    <a href="{{route('admin.posts.show',$post->id)}}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>

         <a href="#myModal" class="btn btn-primary btn-sm open_modal" data-toggle="modal" data-id="{{$post->id}}" data-title="{{$post->title}}" data-content="{{$post->content}}" data-image="{{$post->image}}" >
                        <i class="fas fa-edit"  ></i></a>
                    <a href="#" class="btn btn-danger btn-sm" id="deletebtn" name="{{$post->id}}" onclick="deletepost({{$post->id}})"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">No Data Found</td>
        </tr>
    @endforelse




</table>

{{ $posts->appends($_GET)->links() }}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header" style="background-color: #17a2b8;color:aliceblue;font-weight:bold;">
            <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">×</span></button>

        </div>
        <div class="modal-body">
 <form id="EditForm"  action="{{route('admin.posts.updatePost')}}" method="POST" enctype="multipart/form-data"  >
                @csrf
				@method('PUT')

            <div class="card-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" class="form-control"  id="title" placeholder="Enter title of the post"  value="">
                </div>

                <input type="hidden"   id="postId" name="id" class="form-control"  value="" >

               <div class="card-body">

                <div class="form-group">
                    <textarea class="ckeditor form-control" name="content" id="content">"</textarea>
                </div>

        </div>

        <div class="form-group">
            <label for="image">File input</label>
            <div class="input-group">
              <div class="custom-file">
              <input type="file"  name="image" id="image" class="custom-file-input" onchange="loadFile(event)" >
                <label class="custom-file-label" for="image">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div>
          <div><img id="output" width="200" height="200" src="" style="margin:0 auto;"/></div>

        </div>
        <div class="modal-footer" >
           <button type="submit"  class="btn btn-info" > update</button>
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="cancel">

        </div>
    </form>
    </div>
  </div>
</div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js" integrity="sha512-tofxIFo8lTkPN/ggZgV89daDZkgh1DunsMYBq41usfs3HbxMRVHWFAjSi/MXrT+Vw5XElng9vAfMmOWdLg0YbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    /*$(document).ready(function () {
        $('.ckeditor').ckeditor();
    });*/
    tinymce.init({
  selector: 'textarea',  // change this value according to your HTML
  plugins: 'a_tinymce_plugin',
  a_plugin_option: true,
  a_configuration_option: 400
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

function countPosts(){

}









$(document).on('click','.open_modal',function(){

    var Postid= $(this).data('id');
    var title= $(this).data('title');
    var content= $(this).data('content');
    var image= $(this).data('image');
    var post= $(this).data('post');
   $('#title').val(title);

    $('#postId').val(Postid);

if($('#wp-content-wrap').hasClass('html-active')){ // We are in text mode
    $('#content').val(content); // Update the textarea's content
} else { // We are in tinyMCE mode
    var activeEditor = tinyMCE.get('content');
    if(activeEditor!==null){ // Make sure we're not calling setContent on null
        activeEditor.setContent(content); // Update tinyMCE's content
    }
}
if (isValidUrl(image)) {
    $("#output").attr("src",image);
    $("#image").val(image);
            }else{
                var imageURL = '{{ URL::asset('') }}';
                $("#output").attr("src", imageURL+image);
                $("#image").val(imageURL+image);

            }
});






    function isValidUrl(string) {
  try {
    new URL(string);
    return true;
  } catch (err) {
    return false;
  }}
</script>
@endsection
