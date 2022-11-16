
<!DOCTYPE html>
<html dir="ltr" lang="en">


<body >
<section class="main-pd-wrapper" style="width: 450px; margin: auto" id="billPage">
    <div style="
                text-align: center;
                margin: auto;
                line-height: 1.5;
                font-size: 14px;
                color: #4a4a4a;
              ">
              <svg width="220" height="73" viewBox="0 0 272 73" fill="none" xmlns="http://www.w3.org/2000/svg">

              </svg>

              <p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 18px;">
                Tax Invoice/Bill Of Supply DJT Retailers<br> Private Limited
              </p>
              <p style="margin: 15px auto;">
                A2, Test Street <br>
                Test Area Bangaluru 560001, Karnataka
              </p>
              <p>
                <b>Invoice Code:</b> Invoice{{$bill->invoice_no}}
              </p>
              <p>
                <b>Custom name:</b> {{$bill->cust_name}}
              </p>

              <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
            </div>
            <table style="width: 100%; table-layout: fixed;text-align:center">
              <thead>
                <tr>
                  <th>Sn.</th>
                  <th>Item Name</th>
                  <th>QTY</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($items as $item)

                <tr class="invoice-items">
                  <td>{{$item->id}}</td>
                  <td >{{$item->item_name}}</td>
                  <td>{{$item->quantity}}</td>
                  <td >$ {{$item->cost}}</td>
                </tr>
                @endforeach


              </tbody>
              <tfoot style="width: 100%;
              background: #fcbd024f;
              border-radius: 4px">
<tr>
    <th colspan="2">Total</th>

    <th style="text-align: center;">Item ({{$items->count()}})</th>
    <th style="text-align: right;">$ {{$bill->total_cost}}</th>

  </tr>
              </tfoot>
            </table>


        </body>
</html>
