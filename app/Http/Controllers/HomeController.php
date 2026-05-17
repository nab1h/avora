<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\HomeContent;
use App\Models\Faq;
use App\Models\Media;
use App\Models\Statistic;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting= Setting::first();
        $content = HomeContent::firstOrCreate(['id' => 1]);
        $faqs = Faq::where('is_active', true)->get();
        $heroVideo = Media::where('type', 'hero_video')->where('is_active', true)->first();
        $heroImage = Media::where('type', 'hero_image')->where('is_active', true)->first();
        $galleryImages = Media::where('type', 'gallery_image')->where('is_active', true)->ordered()->get();
        $stats = Statistic::orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)
            ->latest()
            ->get();

        return view('welcome',compact('setting', 'stats', 'content', 'faqs',  'heroVideo', 'heroImage', 'galleryImages', 'testimonials'));
    }
}
