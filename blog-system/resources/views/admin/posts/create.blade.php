@extends('admin.master')

@section('title', 'Add Post | ' . env('APP_NAME'))
@section('styles')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')

<div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Add new Post</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data" >
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control" id="title" placeholder="Enter title of the post">
        </div>

            <!-- /.card-header -->


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
                  <div><img id="output" width="200" height="200" src="https://via.placeholder.com/200"/></div>



      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>



@section('script')
<!-- Summernote -->

<<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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


@endsection




@endsection
@section('headerTitle')
Add Post
@endsection
@section('currentpage')
Add Post
@endsection


