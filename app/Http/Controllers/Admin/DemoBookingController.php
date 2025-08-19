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
            'user_registration_id' => 'nullable|exists:user_registrations,id',
            'name' => 'required_without:user_registration_id|string|max:255',
            'email' => 'required_without:user_registration_id|email',
            'phone' => 'required_without:user_registration_id|string|max:20',
            'course_id' => 'nullable|exists:courses,id',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        // If user_registration_id is provided, get user details
        if ($request->user_registration_id) {
            $user = \App\Models\UserRegistration::find($request->user_registration_id);
            $data = $request->all();
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            DemoBooking::create($data);
        } else {
            DemoBooking::create($request->all());
        }

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
            'user_registration_id' => 'nullable|exists:user_registrations,id',
            'name' => 'required_without:user_registration_id|string|max:255',
            'email' => 'required_without:user_registration_id|email',
            'phone' => 'required_without:user_registration_id|string|max:20',
            'course_id' => 'nullable|exists:courses,id',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string'
        ]);

        // If user_registration_id is provided, get user details
        if ($request->user_registration_id) {
            $user = \App\Models\UserRegistration::find($request->user_registration_id);
            $data = $request->all();
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            $demoBooking->update($data);
        } else {
            $demoBooking->update($request->all());
        }

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
