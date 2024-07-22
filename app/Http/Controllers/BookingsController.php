<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $users = User::query();
        if (request()->user()->account_type_id === 1) {
            $bookings = Booking::query()
            ->where('patient_id', request()->user()->id)
            ->orderBy('id', 'asc')
            ->paginate(10);
        }
        elseif (request()->user()->account_type_id === 2) {
            $bookings = Booking::query()
            ->orderBy('bookings.id', 'asc')
            ->paginate(10);
        }
        return view('bookings.index', ['bookings' => $bookings, 'users' => $users]);
    }

    /**
     * Show the form for creating a new booking.
     * Only patients may perform this action.
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created booking in storage.
     * Only patients may perform this action.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_date' => ['bail', 'required', 'date'],
        ]);

        $data['patient_id'] = $request->user()->id;
        $booking = Booking::create($data);

        return to_route('bookings.show', $booking)->with('message', 'Booking was created');
    }

    /**
     * Display the specified booking.
     * 403 is returned if the booking's patient id does not match the current user's id AND they are a patient.
     * Meaning, staff may view this booking even with an id mismatch.
     */
    public function show(Booking $booking)
    {
        $users = User::query();
        if ($booking->patient_id !== request()->user()->id && request()->user()->account_type_id === 1) {
            abort(403);
        }
        return view('bookings.show', ['booking' => $booking, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified booking.
     * Patients and staff may edit and update bookings.
     */
    public function edit(Booking $booking)
    {
        $users = User::query();
        if ($booking->patient_id !== request()->user()->id && request()->user()->account_type_id === 1) {
            abort(403);
        }
        return view('bookings.edit', ['booking' => $booking, 'users' => $users]);
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        if ($booking->patient_id !== request()->user()->id && request()->user()->account_type_id === 1) {
            abort(403);
        }
        $data = $request->validate([
            'booking_date' => ['bail', 'required', 'date'],
            'staff_id' => ['integer'],
        ]);

        $booking->update($data);

        return to_route('bookings.show', $booking)->with('message', 'Booking was updated');
    }

    /**
     * Remove the specified booking from storage.
     * Only patients may perform this action.
     */
    public function destroy(Booking $booking)
    {
        if ($booking->patient_id !== request()->user()->id) {
            abort(403);
        }
        $booking->delete();

        return to_route('bookings.index')->with('message', 'Booking was deleted');
    }   
}
