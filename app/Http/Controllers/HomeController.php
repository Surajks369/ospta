<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\DemoBooking;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Offer;
use App\Models\Faq;
use App\Models\UserRegistration;
use App\Models\TeamMember;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured content for home page
        $categories = Category::where('status', true)->orderBy('sort_order')->take(6)->get();
        $courses = Course::where('status', true)
            ->with('category')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $gallery = Gallery::where('status', true)->orderBy('sort_order')->take(8)->get();
        $testimonials = Testimonial::where('status', true)->orderBy('sort_order')->take(6)->get();
        $offers = Offer::where('status', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->orderBy('sort_order')
            ->take(3)
            ->get();
        $faqs = Faq::where('status', true)->orderBy('sort_order')->take(5)->get();
        $teamMembers = TeamMember::where('status', true)->orderBy('sort_order')->take(4)->get();

        // Get the first active offer for countdown section
        $activeOffer = $offers->first();

        return view('home', compact(
            'categories', 
            'courses', 
            'gallery', 
            'testimonials', 
            'offers', 
            'faqs',
            'activeOffer',
            'teamMembers'
        ));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function courses(Request $request)
    {
        $categories = Category::where('status', true)->withCount('courses')->orderBy('name')->get();
        
        $query = Course::where('status', true)->with('category');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('instructor', 'LIKE', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->get('category'));
        }
        
        // Level filter
        if ($request->filled('level')) {
            $query->where('level', $request->get('level'));
        }
        
        // Always apply sort_order first
        $query->orderBy('sort_order', 'asc');

        // Additional sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('created_at', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $courses = $query->paginate(12);
        
        return view('courses', compact('courses', 'categories'));
    }

    public function courseDetails($id)
    {
        $course = Course::where('id', $id)->where('status', true)->with('category')->firstOrFail();
        $relatedCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->where('status', true)
            ->take(4)
            ->get();
        
        return view('course-details', compact('course', 'relatedCourses'));
    }

    public function gallery()
    {
        $gallery = Gallery::where('status', true)->orderBy('sort_order')->paginate(16);
        return view('gallery', compact('gallery'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('status', true)->orderBy('sort_order')->paginate(12);
        return view('testimonials', compact('testimonials'));
    }

    public function faq()
    {
        $faqs = Faq::where('status', true)
                   ->orderBy('sort_order')
                   ->orderBy('created_at', 'desc')
                   ->get()
                   ->groupBy('category');
        return view('faq', compact('faqs'));
    }

    public function join()
    {
        $categories = Category::where('status', true)->orderBy('name')->get();
        $courses = Course::where('status', true)->orderBy('title')->get();
        return view('join', compact('categories', 'courses'));
    }

    public function joinSubmit(Request $request)
    {
        // Base validation rules
        $rules = [
            'registration_type' => 'required|in:demo,enrollment',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'message' => 'nullable|string',
        ];

        // Additional validation based on registration type
        if ($request->registration_type === 'demo') {
            $rules['preferred_date'] = 'nullable|date|after:today';
            $rules['preferred_time'] = 'nullable|string';
        } elseif ($request->registration_type === 'enrollment') {
            $rules['email'] = 'required|email|unique:user_registrations,email';
            $rules['date_of_birth'] = 'required|date';
            $rules['gender'] = 'required|in:male,female,other';
            $rules['address'] = 'required|string';
            $rules['city'] = 'required|string|max:100';
            $rules['state'] = 'required|string|max:100';
            $rules['pincode'] = 'required|string|max:10';
            $rules['qualification'] = 'nullable|string|max:255';
            
            // School Details
            $rules['current_school'] = 'required|string|max:255';
            $rules['school_grade'] = 'required|string|max:50';
            $rules['school_board'] = 'required|string|max:50';
            
            // Parent Details
            $rules['parent_name'] = 'required|string|max:255';
            $rules['parent_phone'] = 'required|string|max:20';
            $rules['parent_email'] = 'required|email';
            $rules['parent_occupation'] = 'required|string|max:255';
            $rules['date_of_birth'] = 'nullable|date';
            $rules['gender'] = 'nullable|in:male,female,other';
            $rules['address'] = 'nullable|string';
            $rules['city'] = 'nullable|string|max:100';
            $rules['state'] = 'nullable|string|max:100';
            $rules['pincode'] = 'nullable|string|max:10';
            $rules['qualification'] = 'nullable|string|max:255';
        }

        $request->validate($rules);

        try {
            if ($request->registration_type === 'demo') {
                // Create demo booking
                DemoBooking::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'course_id' => $request->course_id,
                    'preferred_date' => $request->preferred_date,
                    'preferred_time' => $request->preferred_time,
                    'message' => $request->message,
                    'status' => 'pending',
                ]);

                $successMessage = 'Demo booking submitted successfully! We will contact you soon to confirm your demo session.';
            } else {
                // Create user registration first
                $userRegistration = UserRegistration::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pincode' => $request->pincode,
                    'qualification' => $request->qualification,
                    'notes' => $request->message,
                    'status' => 'pending',
                ]);

                // Create course enrollment
                CourseEnrollment::create([
                    'course_id' => $request->course_id,
                    'user_registration_id' => $userRegistration->id,
                    'enrollment_date' => now(),
                    'enrollment_status' => 'pending',
                    'payment_status' => 'pending',
                    'notes' => $request->message,
                ]);

                $successMessage = 'Course enrollment submitted successfully! We will contact you soon with payment details and course information.';
            }

            return redirect()->back()->with('success', $successMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }

    public function offers()
    {
        $offers = Offer::where('status', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('offers', compact('offers'));
    }

    public function offerDetails($id)
    {
        $offer = Offer::where('status', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->findOrFail($id);
            
        return view('offer-details', compact('offer'));
    }

    public function team()
    {
        $teamMembers = TeamMember::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('team', compact('teamMembers'));
    }

    public function teamMember($id)
    {
        $member = TeamMember::where('status', true)->findOrFail($id);
        return view('team-member', compact('member'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        try {
            // Prepare contact data
            $contactData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            // Send email to the specified email address
            Mail::to('surajks123@gmail.com')->send(new ContactFormMail($contactData));

            return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            Log::error('Contact form email failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Sorry, there was an error sending your message. Please try again later.')->withInput();
        }
    }
}
