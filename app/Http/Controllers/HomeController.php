<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $reservationCount = Reservation::count();
        return view('home.index', ['reservationCount' => $reservationCount]);
    }

    public function room()
    {
        return view('home.room');
    }

    public function searchRoom()
    {
        return view('home.search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'stay_type' => 'required|in:day tour,overnight',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $rooms = Room::where('stay_type', $request->stay_type)
            ->where(function ($query) use ($request) {
                $query->doesntHave('reservations')
                    ->orWhereDoesntHave('reservations', function ($query) use ($request) {
                        $query->where(function ($query) use ($request) {
                            $query->whereBetween('check_in', [$request->start, $request->end])
                                ->orWhereBetween('check_out', [$request->start, $request->end])
                                ->orWhere(function ($query) use ($request) {
                                    $query->where('check_in', '<', $request->start)
                                        ->where('check_out', '>', $request->end);
                                });
                        });
                    });
            })
            ->get();

        return response()->json([
            'rooms' => $rooms,
        ]);
    }
}
