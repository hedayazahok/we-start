<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Chalet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chalets=Chalet::orderby('created_at','desc')->limit(9)->get();


        return view('welcome',compact(['chalets']));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booking(BookingRequest $request,$id)
    {

        $chalet=Chalet::find($id);
        $doa = \Carbon\Carbon::parse($request->arrival_date);
        $dod = \Carbon\Carbon::parse($request->departure_date);
        /*if($dod<$doa){
            return back()->with('error', 'Your depature date is before your arrival date ');

        }*/


       /* $isBooked = Booking::where('chalet_id', $id)
        ->whereDate('arrival_date', '<=', $doa)
        ->whereDate('departure_date', '>=', $dod )
        ->exists();*/

        $isBooked = $chalet->bookings()
    ->whereBetween('arrival_date', [$doa, $dod])
    ->orWhereBetween('departure_date' ,[$doa,$dod])
    //->orWhere(fn ($q) => $q->where('arrival_date', '<', $doa)->where('departure_date', '>', $dod))
    ->exists();

if(!$isBooked){
        $diff =  $doa->diffInDays($dod);



        Booking::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'price'=>$chalet->price*$diff,
            'arrival_date'=> $doa,
            'departure_date'=> $dod,
            'chalet_id'=>$id,
            'num_adult'=>$request->num_adult,
        ]);


        return back()->with('success', 'Booking created successfully.');
    }
    return back()->with('error', 'the chalet booking in this period.');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chalet=Chalet::find($id);
        $images=$chalet->images;
        return view('single',compact(['chalet','images']));
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
    public function filter(Request $request)
    {
        $time_from =Carbon::parse($request->input('checkIndate'))->format('Y-m-d');
        $time_to =Carbon::parse($request->input('checkOutDate'))->format('Y-m-d');
        $address = $request->input('address');
        $chaletBooking = Chalet::query();
        if(!empty($address)){
            $chaletBooking->where('address',$address);
        }

        if(!empty($time_to)){
            $chaletBooking->whereDoesntHave('bookings', function ($q) use ($time_to) {

                $q->whereDate('departure_date','>=',$time_to)
                ->orWhereDate('arrival_date','<=',$time_to);
            })->orWhereDoesntHave('bookings');
        }

        if(!empty($time_from)){
            $chaletBooking->whereHas('bookings', function ($q) use ($time_from) {

                $q->whereDate('departure_date','>=',$time_from)
                ->orWhereDate('arrival_date','<=',$time_from);



            })->orWhereDoesntHave('bookings');
        }

        $chalets=$chaletBooking->get();

            return view('welcome',compact(['chalets']));
    }
    }
