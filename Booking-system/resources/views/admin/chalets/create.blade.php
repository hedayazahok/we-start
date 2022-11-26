
@extends('admin.master')

@section('style')
<style>

#result{
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  padding: 10px 0;
}

.thumbnail {
  height: 192px;
}
</style>
@endsection
@section('content')
<section class="content">
    <div class="card card-primary  mt-5">
      <div class="card-body">
          <form @if($chalet !=null) action="{{route('admin.chalet.update',$chalet->id)}}" @else action="{{route('admin.chalet.store')}}" @endif method="POST" enctype="multipart/form-data">
            @csrf
            @if ($chalet !=null)
                @method('PUT')
            @endif
        <div class="form-group">
          <label for="inputName">Chalet Name</label>
          <input type="text" name="name" id="inputName" class="form-control"  @if ($chalet) value="{{$chalet->name}}" @endif>
        </div>
        <div class="form-group">
            <label for="inputName">Chalet Address</label>
            <input type="text" name="address" id="inputName" class="form-control"  @if ($chalet) value="{{$chalet->address}}" @endif>
          </div>
        <div class="form-group">
            <label for="inputName">Chalet price</label>
            <input type="number" name="price" id="inputName" class="form-control"  @if ($chalet) value="{{$chalet->price}}" @endif>
          </div>
        <div class="form-group">
          <label for="inputDescription">Chalet details</label>
          <textarea id="inputDescription" name="details" class="form-control" rows="4" > @if($chalet) {!!$chalet->details !!} @endif</textarea>
        </div>
        <div class="form-group">
            <label for="files">Select multiple image</label>
            <input id="files" type="file" name="images[]" multiple="multiple" accept="image/jpeg, image/png, image/jpg" @if ($images) value="{{$images}}" @endif>
            <output id="result">

@if ($images)
                    @foreach ($images as $image )
                    <div>
                    <img class="thumbnail" src="{{$image->path}}" />
                    </div>
                    @endforeach

                    @endif


        </div>
        <button class="btn btn-success" type="submit">@if ($chalet=null)Add @else Edit @endif </button>
    </form>
      </div>
      <!-- /.card-body -->
    </div>
</div>
</section>
@endsection

@section('scripts')
<script>
document.querySelector("#files").addEventListener("change", (e) => { //CHANGE EVENT FOR UPLOADING PHOTOS
    if (window.File && window.FileReader && window.FileList && window.Blob) { //CHECK IF FILE API IS SUPPORTED
        const files = e.target.files;

    //FILE LIST OBJECT CONTAINING UPLOADED FILES
      const output = document.querySelector("#result");
      output.innerHTML = "";
      for (let i = 0; i < files.length; i++) { // LOOP THROUGH THE FILE LIST OBJECT
          if (!files[i].type.match("image")) continue; // ONLY PHOTOS (SKIP CURRENT ITERATION IF NOT A PHOTO)
          const picReader = new FileReader(); // RETRIEVE DATA URI
          picReader.addEventListener("load", function (event) { // LOAD EVENT FOR DISPLAYING PHOTOS
            const picFile = event.target;
            const div = document.createElement("div");
            div.innerHTML = `<img class="thumbnail" src="${picFile.result}" title="${picFile.name}"/>`;
            output.appendChild(div);
          });
          picReader.readAsDataURL(files[i]); //READ THE IMAGE
      }
    } else {
      alert("Your browser does not support File API");
    }
  });
</script>
@endsection
