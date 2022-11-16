<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $item=Item::create([
            'bill_id'=>$request->bill_id,
            'item_name'=>$request->item_name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'cost'=>$request->cost,

        ]);
        $total  = Item::where('bill_id',$request->bill_id)->sum('cost');
      Bill::where('id',$request->bill_id) ->update([
            'total_cost' => $total,
        ]);
        $bill=Bill::find($request->bill_id);
        $items=Item::where('bill_id',$request->bill_id)->get();

        return response()->json(['bill'=>$bill,'item'=>$item,'success'=>'item created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Item::find($id);
        $bill=Bill::where('id',$item->bill_id)->first();
        $total=$bill->total_cost - $item->cost;
        $bill->total_cost = $total;
        $bill->save();





        Item::destroy($id);

        return response()->json(['id'=>$id,'success'=>'item deleted successfully!','bill'=>$bill]);
    }
}
