@extends('master')
@php

$title=(empty($bill))? "Create Invoice":"Invoice-$bill->id";

@endphp

@section('title', $title)

@section('styles')
		<style>
			/*.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}*/

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}

            .warrper{
                display:flex;
                justify-content:space-between;
                border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
                background-color: #fff;
            }

            .invoice-box{
                width:70%;
                padding: 30px;


            }

            .addItem{
                width:30%;
                padding: 30px;
                border: 1px solid #eee;
                background-color: #eee

            }
            #itemsTable{
                text-align: center;
                align-items: center;
            }
		</style>
        @endsection
	@section('content')

@if(empty($bill))


           <form id="createForm">
        @csrf
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Custom name:</label>
        <input type="text" class="form-control" name="cust_name" id="cust_name">
      </div>
      <button class="btn btn-success btn-submit" type="submit">Submit</button>


    </form>
    @endif
@if (!empty($bill))
    <div class="warrper" id="invoice" >
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0" id="itemsTable">
            <tr class="top">
                <td colspan="2">
                    <table >
                        <tr>
                            <td>
                                Invoice #: <span id="invoice_no">{{$bill->id}}</span> <br />
                                custome name: <span id="invoice_cust_name">{{$bill->cust_name}}</span> <br />
                                Created: <span id="invoice_created"> {{$bill->created_at}} </span> <br />


                            </td>
                            <td class="title">
                                <img src="{{asset('assets/images/logo.jpg')}}" width="200px" height="200px" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>





            <tr class="heading">
                <td>Item</td>

                <td>quntity</td>

                <td>cost</td>
                <td>Actions</td>
            </tr>
            <tbody>

                @forelse ($items as $item )
                <tr id="item_{{$item->id}}">

                    <td>{{$item->item_name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->cost}}</td>
                    <td><button class='btn btn-danger' onclick='deleteItem({{$item->id}})' > <i class='fas fa-trash'></i></button> </td>


                </tr>
                @empty
                <tr id="intial">
                    <td colspan="3">no item</td>
                 </tr>
                @endforelse





                </tbody>



            <tr class="total" id="total">
                <td></td>

                <td>Total: <span id="totalCost">{{$bill->total_cost}}</span></td>
            </tr>
        </table>
    </div>
    <div class="addItem" id="addItem">
        <h5>Add Product Item</h5>

        <form id="addItemForm">
            @csrf
           <!-- Text input-->
           <div class="form-group row">
            <label for="inputItemName" class="col-sm-10 col-form-label">product name:</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="inputItemName" placeholder="Product name">
            </div>
          </div>
          <input type="hidden" name="bill_id" class="form-control" id="bill_id" value="{{$bill->id}}">


          <div class="form-group row">
            <label for="inputItemPrice" class="col-sm-10 col-form-label">Price:</label>
            <div class="col-sm-10">
              <input type="text" name="price" class="form-control" id="inputItemPrice" >
            </div>
          </div>
          <div class="form-group row">
            <label for="inputItemQuantity" class="col-sm-10 col-form-label">Quantity:</label>
            <div class="col-sm-10">
              <input type="number" min="1" name="quantity" class="form-control" id="inputItemQuantity" >
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              <button id="addBtn" type="submit" class="btn btn-primary">Add Item</button>
            </div>
            </div>

        </form>



        <a type="button" class="btn btn-success"  href="http://127.0.0.1:8000/admin/bills/{{$bill->id}}"       data-whatever="@mdo">Save Invoice</a>


    </div>
    @else
    <div class="warrper" id="invoice" style="visibility: hidden">
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0" id="itemsTable">
                <tr class="top">
                    <td colspan="2">
                        <table >
                            <tr>


                                <td>
                                    Invoice #: <span id="invoice_no">invoice_no</span> <br />
                                    custome name: <span id="invoice_cust_name">cust_name</span> <br />
                                    Created: <span id="invoice_created"> Created </span> <br />


                                </td>
                                <td class="title">
                                    <img src="{{asset('assets/images/logo.jpg')}}" width="200px" height="200px" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>






                <tr class="heading">
                    <td>Item</td>

                    <td>quntity</td>

                    <td>cost</td>
                </tr>
                <tbody>
                    <tr id="intial">
                        <td colspan="3">no item</td>
                     </tr>
                </tbody>



                <tr class="total" id="total">
                    <td></td>

                    <td>Total: <span id="totalCost">0.0</span></td>
                </tr>
            </table>
        </div>
        <div class="addItem" id="addItem">
            <h5>Add Product Item</h5>

            <form id="addItemForm">
                @csrf
               <!-- Text input-->
               <div class="form-group row">
                <label for="inputItemName" class="col-sm-10 col-form-label">product name:</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="inputItemName" placeholder="Product name">
                </div>
              </div>
              <input type="hidden" name="bill_id" class="form-control" id="bill_id" >


              <div class="form-group row">
                <label for="inputItemPrice" class="col-sm-10 col-form-label">Price:</label>
                <div class="col-sm-10">
                  <input type="text" name="price" class="form-control" id="inputItemPrice" >
                </div>
              </div>
              <div class="form-group row">
                <label for="inputItemQuantity" class="col-sm-10 col-form-label">Quantity:</label>
                <div class="col-sm-10">
                  <input type="number" min="1" name="quantity" class="form-control" id="inputItemQuantity" >
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-10">
                  <button id="addBtn" type="submit" class="btn btn-primary">Add Item</button>
                </div>
                </div>

            </form>



            <a type="button"  class="btn btn-success"  id="saveInvoice" data-whatever="@mdo">Save Invoice</a>


        </div>
    @endif
</div>



{{--@endif--}}

	@endsection


    @section('scripts')



    <script type="text/javascript">
var bill;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var bill_id=25;
        $(".btn-submit").click(function(e){
            e.preventDefault();
            var cust_name = $("#cust_name").val();

           $.ajax({
               type:'POST',
               url:"{{ route('admin.bills.store') }}",
               data:{cust_name:cust_name},
               success:function(response){
                   billId=response.bill.id;
                   //url="http://127.0.0.1:8000/admin/getBill/"+billId;
                   var cust_name = $("#createForm").css('display', 'none');
                $('#intial').css('display', 'none');

                bill_id=$("#bill_id").val(response.bill.id);
             $("#saveInvoice").attr("href", "http://127.0.0.1:8000/admin/bills/"+response.bill.id)

                $("#invoice").css('visibility', 'visible');
              $('#invoice_no').text(response.bill.id)
              $('#invoice_cust_name').text(response.bill.cust_name)
               $('#invoice_created').text(response.date)

                   /*axios.get(url,billId).then(function (data) {

                });*/


              //window.location.href= "http://127.0.0.1:8000/admin/getBill/"+ response.bill.id;


         /*$('#billTable tbody').prepend("<tr id='bill_"+data.bill.id+"'><td>" + data.bill.id + "</td><td>" + data.bill.invoice_no + "</td><td>" + data.bill.user_id + "</td><td>" + data.bill.cust_name + "</td><td>" + data.bill.total_cost + "</td><td><a class='btn btn-info showBill' id='showBill' href='{{route('admin.bills.show',"+data.bill.id+")}}'><i class='fas fa-eye' ></i></a><button type='button' class='btn btn-danger removeBill' id='removeBill'  onclick='removeBill("+data.bill.id+")'><i class='fas fa-close' ></i></button></td></tr>");
*/

               }
            });

        });

//add item
var total=0;
        $("#addBtn").click(function(e){
            e.preventDefault();
            var inputItemName = $("#inputItemName").val();
            var inputItemPrice = $("#inputItemPrice").val();
            var inputItemQuantity = $("#inputItemQuantity").val();
            var bill_idInput = $("#bill_id").val();

            var cost=inputItemPrice*inputItemQuantity;


           $.ajax({
               type:'POST',
               url:"{{ route('admin.items.store') }}",
               data:{
                item_name:inputItemName,
                price:inputItemPrice,
                quantity:inputItemQuantity,
                bill_id:bill_idInput,
                cost:cost,

                },
               success:function(data){
                total=data.bill.total_cost;
                   //total=bill_total+cost;

                   id=data.item.id;

     $('#itemsTable').append("<tr id='item_"+data.item.id+"'><td>" + data.item.item_name + "</td><td>" + data.item.quantity + "</td><td>" + data.item.cost + "</td><td><button class='btn btn-danger' onclick='deleteItem("+data.item.id+")' > <i class='fas fa-trash'></i></button> </td></tr>");
         $('#totalCost').text(total)



               }
            });

        });


        function deleteItem(id){
            $.ajax({
           type:'DELETE',
           url:"http://127.0.0.1:8000/admin/items/"+id,
           success:function(data){
               $('#item_'+id).remove();

               total=data.bill.total_cost;

               $('#totalCost').text(total)

            }
        });

        }



        window.addEventListener('load', (event) => {

});



    </script>
    @endsection
