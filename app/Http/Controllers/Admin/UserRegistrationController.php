<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserRegistrationController extends Controller
{
    public function index()
    {
        $users = UserRegistration::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user-registrations.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user-registrations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_registrations',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',
            'qualification' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('users', 'public');
        }

        UserRegistration::create($data);

        return redirect()->route('admin.user-registrations.index')
            ->with('success', 'User registration created successfully.');
    }

    public function show(UserRegistration $userRegistration)
    {
        $userRegistration->load('enrollments.course');
        return view('admin.user-registrations.show', compact('userRegistration'));
    }

    public function edit(UserRegistration $userRegistration)
    {
        return view('admin.user-registrations.edit', compact('userRegistration'));
    }

    public function update(Request $request, UserRegistration $userRegistration)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_registrations,email,' . $userRegistration->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',
            'qualification' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($userRegistration->image) {
                Storage::disk('public')->delete($userRegistration->image);
            }
            $data['image'] = $request->file('image')->store('users', 'public');
        }

        $userRegistration->update($data);

        return redirect()->route('admin.user-registrations.index')
            ->with('success', 'User registration updated successfully.');
    }

    public function destroy(UserRegistration $userRegistration)
    {
        if ($userRegistration->image) {
            Storage::disk('public')->delete($userRegistration->image);
        }

        $userRegistration->delete();

        return redirect()->route('admin.user-registrations.index')
            ->with('success', 'User registration deleted successfully.');
    }
}
