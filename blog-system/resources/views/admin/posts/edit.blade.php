@extends('admin.master')

@section('title', 'Edit Post | ' . env('APP_NAME'))
@section('styles')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Edit Post</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('admin.posts.update',$post)}}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control"  value="{{$post->title}}" id="title" placeholder="Enter title of the post">
        </div>

            <!-- /.card-header -->


                <div class="card-body">

                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="content">{!! $post->content !!}</textarea>
                        </div>

                </div>

                <div class="form-group">
                    <label for="image">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="loadFile(event)" id="image" name="image">
                        <label class="custom-file-label" for="image" >Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div><img id="output" width="200" height="200" src="{{asset($post->image)}}"/></div>



      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-info">Submit</button>
      </div>
    </form>
  </div>



@section('script')
<!-- Summernote -->

<!--<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js" integrity="sha512-tofxIFo8lTkPN/ggZgV89daDZkgh1DunsMYBq41usfs3HbxMRVHWFAjSi/MXrT+Vw5XElng9vAfMmOWdLg0YbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
   /* $(document).ready(function () {
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


@endsection




@endsection
@section('headerTitle')
Edit Post
@endsection
@section('currentpage')
Edit Post
@endsection


