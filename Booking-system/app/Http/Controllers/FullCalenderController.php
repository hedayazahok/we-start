<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Chalet;

class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request,$id)
    {


        if($request->ajax(


             return response()->json(['data'=>$data,'chalet'=>$chalet]);
        }

        return view('admin.chalets.fullcalender')->with('chalet');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        /*switch ($request->type) {
           case 'add':
              $Booking = Booking::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($Booking);
             break;

           case 'update':
              $Booking = Booking::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($Booking);
             break;

           case 'delete':
              $Booking = Booking::find($request->id)->delete();

              return response()->json($Booking);
             break;

           default:
             # code...
             break;
        }*/
    }
}
