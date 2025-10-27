<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qualification' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'social_links' => 'nullable|array',
            'specializations' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->except(['photo', 'social_links']);
        
        // Handle social links
        $data['social_links'] = array_filter($request->social_links ?? []);
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member added successfully.');
    }

    public function show($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team.show', compact('member'));
    }

    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qualification' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'social_links' => 'nullable|array',
            'specializations' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->except(['photo', 'social_links']);
        
        // Handle social links
        $data['social_links'] = array_filter($request->social_links ?? []);

        $member = TeamMember::findOrFail($id);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $member->update($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy($id)
    {
        // Delete photo
        $member = TeamMember::findOrFail($id);
        
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }

        $member->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member deleted successfully.');
    }
}