<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Validator;  //この1行だけ追加！

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'asc')->get();
        return view('reservations', [
            'reservations' => $reservations
        ]);
        // 🔽 編集
          $reservations = Reservation::getAllOrderByUpdated_at();
          return response()->view('reservation.index',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // バリデーション
        $validator = Validator::make($request->all(), [
            'reservation_datetime' => 'required|date',
            'visit_time' => 'required|date',
            'customer_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // 予約情報を保存
        $reservation = new Reservation();
        $reservation->reservation_datetime = $request->reservation_datetime;
        $reservation->visit_time = $request->visit_time;
        $reservation->customer_id = $request->customer_id;
        $reservation->staff_id = $request->staff_id;
        $reservation->status = $request->status;
        $reservation->save();

        return redirect('/');
        
        // 予約確認画面にリダイレクト
        return redirect()->route('reservation.confirm');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
         $reservation->delete();       //追加
         return redirect('/');  //追加
    }
    
    public function confirm($id)
    {
        // 予約データを取得して予約確認ビューに渡す
        $reservation = Reservation::findOrFail($id);
        return view('reservation.confirm', compact('reservation'));
    }

}

