<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $rooms = Room::query()
            ->when($search, function ($query, $search) {
                $query->where('room_number', 'like', "%{$search}%")
                    ->orWhere('price', 'like', "%{$search}%")
                    ->orWhere('pax', 'like', "%{$search}%")
                    ->orWhere('stay_type', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('rooms.index', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('rooms.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'room_number' => ['required', 'string', 'max:50'],
            'category_name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric'],
            'pax' => ['required', 'integer'],
            'stay_type' => ['required', 'string', 'max:50'],
        ]);

        $category = Category::firstOrCreate([
            'name' => $fields['category_name'],
        ]);

        $fields['category_id'] = $category->id;

        Room::create($fields);

        return redirect()->route('rooms.index')->with('success', 'The room has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $categories = Category::all();
        return view('rooms.edit', ['room' => $room, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $fields = $request->validate([
            'room_number' => ['required', 'string', 'max:50'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric'],
            'pax' => ['required', 'integer'],
            'stay_type' => ['required', 'string', 'max:50'],
        ]);

        $room->update($fields);

        return redirect()->route('rooms.index')->with('success', 'The room has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if ($room->reservations()->exists()) {
            return redirect()->route('rooms.index')
                ->with('error', 'Cannot delete room with active reservations.');
        }

        try {
            $room->delete();
            return redirect()->route('rooms.index')
                ->with('deleted', 'Room deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('rooms.index')
                ->with('error', 'Error occurred while trying to delete the room.');
        }
    }
}
