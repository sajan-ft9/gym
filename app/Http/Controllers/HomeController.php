<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Services\CourseRecommendationService;

class HomeController extends Controller
{
    public function index(CourseRecommendationService $courseRecommendationService)
    {
        $categories = Category::with('courses')->get()->take(8);
        $courses = Course::with('users')->get()->take(6);

        if(Auth::check()){
            $user = Auth::user();
            $recommendedCourses = $courseRecommendationService->recommendCourses($user);
            return view('website.home', compact('categories', 'courses', 'recommendedCourses'));
        }

        return view('website.home', compact('categories', 'courses'));
    }

    public function about()
    {
        return view('website.about');  // Return the 'about' view
    }

    public function contact()
    {
        return view('website.contact');  // Return the 'contact' view
    }


    public function category()
    {
        $categories = Category::with('courses')->get();
        return view('website.categories.index', compact('categories'));  // Return the 'category' view
    }
    public function categoryShow(Category $cat)
    {
        $courses = Course::with('category')->where('category_id',$cat->id)->get();
        return view('website.categories.show', compact('courses','cat'));  // Return the 'courses' view
    }
}
