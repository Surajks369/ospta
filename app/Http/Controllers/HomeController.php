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
            'course_id' => 'required|exists:courses,id',
            'message' => 'nullable|string',
        ];

        // Additional validation based on registration type
        if ($request->registration_type === 'demo') {
            // demo booking required fields: name, course_id already required in base
            $rules['school_name'] = 'required|string|max:255';
            $rules['school_address'] = 'nullable|string';
            $rules['contact_person'] = 'required|string|max:255';
            $rules['contact_designation'] = 'nullable|string|max:255';
            $rules['contact_phone'] = 'required|string|max:20';
            $rules['contact_email'] = 'required|email';
            $rules['preferred_date'] = 'required|date|after:today';
            $rules['preferred_time'] = 'required|string';
        } elseif ($request->registration_type === 'enrollment') {
            // For enrollment we will save all submitted fields into course_enrollments directly
            $rules['email'] = 'required|email';
            $rules['phone'] = 'required|string|max:20';
            $rules['date_of_birth'] = 'nullable|date';
            $rules['gender'] = 'nullable|in:male,female,other';
            $rules['address'] = 'nullable|string';
            $rules['city'] = 'nullable|string|max:100';
            $rules['state'] = 'nullable|string|max:100';
            $rules['pincode'] = 'nullable|string|max:10';
            $rules['qualification'] = 'nullable|string|max:255';

            // School Details
            $rules['current_school'] = 'nullable|string|max:255';
            $rules['school_grade'] = 'nullable|string|max:50';
            $rules['school_board'] = 'nullable|string|max:50';

            // Parent Details
            $rules['parent_name'] = 'nullable|string|max:255';
            $rules['parent_phone'] = 'nullable|string|max:20';
            $rules['parent_email'] = 'nullable|email';
            $rules['parent_occupation'] = 'nullable|string|max:255';
        }

        $request->validate($rules);

        try {
            // Log request payload for debugging demo/enrollment submissions
            Log::info('joinSubmit payload', $request->all());
            if ($request->registration_type === 'demo') {
                // Convert preferred_time from 12-hour to 24-hour format if provided
                $preferredTime = null;
                if ($request->filled('preferred_time')) {
                    try {
                        $preferredTime = \Carbon\Carbon::createFromFormat('h:i A', $request->preferred_time)->format('H:i:s');
                    } catch (\Exception $e) {
                        // If parsing fails, leave it null
                        $preferredTime = null;
                    }
                }

                // Prepare demo booking data
                $demoData = [
                    'name' => $request->name,
                    'school_name' => $request->school_name,
                    'school_address' => $request->school_address,
                    'contact_person' => $request->contact_person,
                    'contact_designation' => $request->contact_designation,
                    // populate email/phone columns from contact fields for admin convenience
                    'email' => $request->contact_email ?? null,
                    'phone' => $request->contact_phone ?? null,
                    'contact_phone' => $request->contact_phone,
                    'contact_email' => $request->contact_email,
                    'course_id' => $request->course_id,
                    'preferred_date' => $request->filled('preferred_date') ? $request->preferred_date : null,
                    'preferred_time' => $preferredTime,
                    'message' => $request->message,
                    'status' => 'pending',
                ];

                $demo = DemoBooking::create($demoData);
                Log::info('DemoBooking created', ['id' => $demo->id, 'data' => $demoData]);

                $successMessage = 'Demo booking submitted successfully! We will contact you soon to confirm your demo session.';
            } else {
                // Create course enrollment directly with submitted user details (no user_registrations row)
                $enrollmentData = [
                    'course_id' => $request->course_id,
                    'user_registration_id' => null,
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
                    // School details
                    'current_school' => $request->current_school,
                    'school_grade' => $request->school_grade,
                    'school_board' => $request->school_board,
                    // Parent details
                    'parent_name' => $request->parent_name,
                    'parent_phone' => $request->parent_phone,
                    'parent_email' => $request->parent_email,
                    'parent_occupation' => $request->parent_occupation,
                    // Enrollment/payment fields
                        'enrollment_date' => now(),
                        // New requirement: mark enrollments as inactive on submission
                        'enrollment_status' => 'inactive',
                        // Set amount_paid from selected course (prefer discounted_price)
                        'amount_paid' => (function() use ($request) {
                            $course = \App\Models\Course::find($request->course_id);
                            if (!$course) return 0.00;
                            return $course->discounted_price ? $course->discounted_price : $course->price;
                        })(),
                    'payment_status' => 'pending',
                    'notes' => $request->message,
                ];

                $enrollment = CourseEnrollment::create($enrollmentData);
                Log::info('CourseEnrollment created', ['id' => $enrollment->id, 'data' => $enrollmentData]);

                $successMessage = 'Course enrollment submitted successfully! We will contact you soon with payment details and course information.';
            }

            return redirect()->back()->with('success', $successMessage);
        } catch (\Exception $e) {
            // Log exception and payload for troubleshooting
            Log::error('joinSubmit exception: ' . $e->getMessage(), [
                'payload' => $request->all(),
                'exception' => $e,
            ]);
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

            // Resolve admin email from environment (use test address as default)
            $adminEmail = env('ADMIN_EMAIL', 'surajks123@gmail.com');

            // Prepare mailable and set From to the app mail from address (keeps reply-to as sender)
            $mailable = new ContactFormMail($contactData);
            $fromAddress = config('mail.from.address', 'no-reply@ospta.com');
            $fromName = config('mail.from.name', 'OSPTA');
            $mailable->from($fromAddress, $fromName);

            // Send to admin (test) address
            Mail::to($adminEmail)->send($mailable);

            return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            Log::error('Contact form email failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Sorry, there was an error sending your message. Please try again later.')->withInput();
        }
    }
}
