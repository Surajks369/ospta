<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemoBooking;
use App\Models\Course;
use Illuminate\Http\Request;

class DemoBookingController extends Controller
{
    public function index()
    {
        $demoBookings = DemoBooking::with('course')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.demo-bookings.index', compact('demoBookings'));
    }

    public function create()
    {
        $courses = Course::active()->orderBy('title')->get();
        $users = \App\Models\UserRegistration::active()->orderBy('name')->get();
        return view('admin.demo-bookings.create', compact('courses', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'course_id' => 'nullable|exists:courses,id',
            'school_name' => 'nullable|string|max:255',
            'school_address' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_designation' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        DemoBooking::create($request->all());

        return redirect()->route('admin.demo-bookings.index')
            ->with('success', 'Demo booking created successfully.');
    }

    public function show(DemoBooking $demoBooking)
    {
        $demoBooking->load('course');
        return view('admin.demo-bookings.show', compact('demoBooking'));
    }

    public function edit(DemoBooking $demoBooking)
    {
        $courses = Course::active()->orderBy('title')->get();
        $users = \App\Models\UserRegistration::active()->orderBy('name')->get();
        return view('admin.demo-bookings.edit', compact('demoBooking', 'courses', 'users'));
    }

    public function update(Request $request, DemoBooking $demoBooking)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'course_id' => 'nullable|exists:courses,id',
            'school_name' => 'nullable|string|max:255',
            'school_address' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_designation' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        $demoBooking->update($request->all());

        return redirect()->route('admin.demo-bookings.index')
            ->with('success', 'Demo booking updated successfully.');
    }

    public function destroy(DemoBooking $demoBooking)
    {
        $demoBooking->delete();

        return redirect()->route('admin.demo-bookings.index')
            ->with('success', 'Demo booking deleted successfully.');
    }

    public function updateStatus(Request $request, DemoBooking $demoBooking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        $demoBooking->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }
}
