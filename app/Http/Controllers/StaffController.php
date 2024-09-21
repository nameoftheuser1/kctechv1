<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $staff = Staff::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('salary', 'like', "%{$search}%")
                    ->orWhere('payout_date', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('salaries.index', ['staff' => $staff]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'salary' => ['required', 'numeric'],
            'payout_date' => ['required', 'date'],
        ]);

        Staff::create($fields);

        return redirect()->route('staff.index')->with('success', 'The staff has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', ['staff' => $staff]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'salary' => ['required', 'numeric'],
            'payout_date' => ['required', 'date'],
        ]);

        $staff->update($fields);

        return redirect()->route('staff.index')->with('success', 'The room has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index')->with('deleted', 'Staff member deleted successfully.');
    }
}
