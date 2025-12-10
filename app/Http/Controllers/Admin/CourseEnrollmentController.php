<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\Course;
use App\Models\UserRegistration;
use Illuminate\Http\Request;

class CourseEnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = CourseEnrollment::with('course')
            ->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.course-enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $courses = Course::active()->orderBy('title')->get();
        $users = UserRegistration::active()->orderBy('name')->get();
        return view('admin.course-enrollments.create', compact('courses', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_registration_id' => 'nullable|exists:user_registrations,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
            'qualification' => 'nullable|string|max:255',
            'current_school' => 'nullable|string|max:255',
            'school_grade' => 'nullable|string|max:50',
            'school_board' => 'nullable|string|max:100',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'parent_occupation' => 'nullable|string|max:255',
            'enrollment_date' => 'required|date',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
            'payment_reference' => 'nullable|string',
            'payment_status' => 'required|in:pending,completed,failed,refunded',
            'enrollment_status' => 'required|in:active,completed,cancelled,suspended,inactive',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'notes' => 'nullable|string'
        ]);

        CourseEnrollment::create($request->all());

        return redirect()->route('admin.course-enrollments.index')
            ->with('success', 'Course enrollment created successfully.');
    }

    public function show(CourseEnrollment $courseEnrollment)
    {
        $courseEnrollment->load('course');
        return view('admin.course-enrollments.show', compact('courseEnrollment'));
    }

    public function edit(CourseEnrollment $courseEnrollment)
    {
        $courses = Course::active()->orderBy('title')->get();
        $users = UserRegistration::active()->orderBy('name')->get();
        return view('admin.course-enrollments.edit', compact('courseEnrollment', 'courses', 'users'));
    }

    public function update(Request $request, CourseEnrollment $courseEnrollment)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_registration_id' => 'nullable|exists:user_registrations,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
            'qualification' => 'nullable|string|max:255',
            'current_school' => 'nullable|string|max:255',
            'school_grade' => 'nullable|string|max:50',
            'school_board' => 'nullable|string|max:100',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'parent_occupation' => 'nullable|string|max:255',
            'enrollment_date' => 'required|date',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
            'payment_reference' => 'nullable|string',
            'payment_status' => 'required|in:pending,completed,failed,refunded',
            'enrollment_status' => 'required|in:active,completed,cancelled,suspended,inactive',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'notes' => 'nullable|string'
        ]);

        $courseEnrollment->update($request->all());

        return redirect()->route('admin.course-enrollments.index')
            ->with('success', 'Course enrollment updated successfully.');
    }

    public function destroy(CourseEnrollment $courseEnrollment)
    {
        $courseEnrollment->delete();

        return redirect()->route('admin.course-enrollments.index')
            ->with('success', 'Course enrollment deleted successfully.');
    }
}
