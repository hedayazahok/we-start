<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Item;
use Illuminate\Http\Request;
use  PDF;
class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills=Bill::orderByDesc('created_at')->paginate(10);
        return view('bill.index')->with('bills',$bills);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=-1)
    {

$items=[];
$bill=[];

        if($id!=-1){
            $bill=Bill::find($id);
            $items=Item::where('bill_id',$bill->id)->get();
            return view('bill.create')->with(['bill'=>$bill,'items'=>$items]);


        }else{

        }

        return view('bill.create')->with(['bill'=>$bill,'items'=>$items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validated = $request->validate([
            'cust_name' => 'required|max:255',
        ]

    );
    if ($validated->fails()) {
        return response()->json([
                    'error' => $validated->errors()->all()
                ]);
    }*/

    $bill=Bill::create([
        'user_by'=>1,
        'cust_name'=>$request->cust_name,
        'invoice_no'=>'dsf',
        'total_cost'=>0.0,
        'status'=>'new'

    ]);
    $date=$bill->dateformate();

   $bill->invoice_no=$bill->invoiceNo($bill->id);

    $bill->save();


$bills=Bill::orderByDesc('created_at')->paginate(10);
$items=Item::where('bill_id',$request->bill_id)->get();


    return response()->json(['items'=>$items,'id'=>$bill->id,'bill'=>$bill,'success'=>'bill created successfully!','date'=>$date]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill=Bill::find($id);
        $items=Item::where('bill_id',$id)->get();
        return view('bill.show')->with(['bill'=>$bill,'items'=>$items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function getBill(Request $request,$id=-1)
    {

$items=[];

        if($id!=-1){
            $bill=Bill::find($id);
            $items=Item::where('bill_id',$bill->id)->get();
             return view('bill.create')->with(['bill'=>$bill,'items'=>$items]);


        }else{
            $bill=Bill::find($request->id);

        }

        return view('bill.create')->with(['bill'=>$bill,'items'=>$items]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $bill= Bill::find($id);
       $bill->items()->delete();
       $bill->delete();


       return response()->json(['bill'=>$bill,'success'=>'bill deleted successfully!']);

    }
    public function generatePDF($id)
    {

        $bill=Bill::find($id);
        $items=Item::where('bill_id',$id)->get();
        $data = [
            'items' => $items,
            'bill' =>  $bill
        ];

        $pdf = PDF::loadView('bill.showBill', $data);

        return $pdf->download('invoice.pdf');
    }
}
