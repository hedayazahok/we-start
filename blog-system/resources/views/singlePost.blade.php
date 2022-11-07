@extends('master')
@section('style')
<meta name="_token" content="{{csrf_token()}}" />
@endsection
@section('content')

      <div class="container">
        <div class="row" >
          <div class="col-lg-8 ftco-animate" id="post" data-id="{{ $post->id }}">
              <img src="{{ asset($post->image) }}" alt="" class="img-fluid">

            <div style="margin-top:30px;margin-bottom:30px;">
            <h1 class="mb-3" >{{$post->title}}</h1>
            </div>
            <p>{!! $post->content !!}</p>

        </div>
    </div>
      </div>

    @endsection

    @section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function(){
        $(".showhidereply").click(function(){
          var dataId =$(this).data("id");
            var id = "#replycomment-"+ dataId;
            if ($(id).css('display') === 'none')
                    { $(id).css("display","block"); }
          else{$(id).css("display","none")}
    });
     });
</script>

<script>

</script>
<script type="text/javascript">
function delete_(id){
$.ajax({
   type: "DELETE",
   url: "/comments/delete/"+id,
   data: "id="+id,
   success: function(){
   $(".tab-content-"+id).remove();
   }
 });
}
</script>

    @endsection
