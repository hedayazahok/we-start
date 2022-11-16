
@extends('master')


@section('title','Bills')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }




</style>

@stop



@section('content')

<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bills</h4>
                <div class="table-responsive">

                    <table class="table user-table no-wrap" id="billTable">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Invoice #</th>
                                <th class="border-top-0">Bill By</th>
                                <th class="border-top-0">Bill TO</th>
                                <th class="border-top-0">total_cost</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($bills!=null)

                            @foreach ($bills as $bill)
                            <tr id="bill_{{$bill->id}}">
                                <td>{{$bill->id}}</td>
                                <td>{{$bill->invoice_no}}</td>
                                <td>{{$bill->user->name ?? 'None'}}</td>
                                <td>{{$bill->cust_name}}</td>
                                <td>{{$bill->total_cost}}</td>
                                <td>
                                    <a class='btn btn-info showBill' id='showBill' href="{{route('admin.bills.show',$bill->id)}}"><i class="fas fa-eye" ></i></a>


<button type="button" onclick="removeBill({{$bill->id}})" class="btn btn-danger removeBill" id="removeBill"><i class="fas fa-close" ></i> </button>

</td>
                            </tr>
                            @endforeach
                            @else
                            <tr style="text-align:center">
                                <td colspan="6">No invoices entered</td>
                            </tr>

                            @endif



                        </tbody>

                    </table>
                    {{ $bills->appends($_GET)->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
</div>

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
function  removeBill(id) {

    swal({
            toast: true,
            title: "Are you sure you want to delete this bill?",
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
           url:" http://127.0.0.1:8000/admin/bills/"+id,
           success:function(data){
               $('#bill_'+id).remove();
               toastr.success(data.success);


            }
        });

}
});

}






</script>

@endsection
