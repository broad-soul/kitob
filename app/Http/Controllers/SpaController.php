<?php

namespace App\Http\Controllers;

use App\Model\Contacts;
use App\Model\ExtraClasses;
use App\Model\Faq;
use App\Model\Files;
use App\Model\Gallery;
use App\Model\MainPage\MainPageAboutUs;
use App\Model\MainPage\MainPageEvent;
use App\Model\MainPage\MainPagePartners;
use App\Model\Teachers;
use App\Model\Titles\Logo;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index()
    {
        return view('app');
    }

    public function main_get()
    {
        return [
            'about_us' => MainPageAboutUs::all(),
            'teachers' => Teachers::where('is_visible', 'true')->take(4)->orderBy('created_at', 'asc')->get(),
            'event' => MainPageEvent::all(),
            'extra_classes' => ExtraClasses::all()->take(10),
            'partners' => MainPagePartners::all(),
            'gallery' => Gallery::all('name')->take(6),
            'questions' => Faq::all()->take(10),
            'contacts' => Contacts::all(),
        ];
    }

    public function destroy(Request $request)
    {
        $res = Files::remove($request->all(), 'temporary/');
        if ($res) return response()->json(["message" => "Deleted temporary files"], 200);
        return response()->json(["message" => "Error"], 400);
    }

    public function get_titles()
    {
        return [ 'logo' => Logo::all()[0] ];
    }

    public function get_logo()
    {
        return Logo::all();
    }
}
