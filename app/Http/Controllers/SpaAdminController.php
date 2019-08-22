<?php

namespace App\Http\Controllers;


use App\Model\AboutUs;
use App\Model\Events;
use App\Model\Exports\NonResidentsExport;
use App\Model\Faq;
use App\Model\Files;
use App\Model\Gallery;
use App\Model\MainPage\MainPageAboutUs;
use App\Model\MainPage\MainPageEvent;
use App\Model\MainPage\MainPagePartners;
use App\Model\NonResidents;
use App\Model\Residents;
use App\Model\Titles\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpaAdminController extends Controller
{

    public function get_main()
    {
        return [
            'about_us' => MainPageAboutUs::all(),
            'event' => MainPageEvent::all(),
            'partners' => MainPagePartners::get()
        ];
    }

    public function main_store(Request $request)
    {
        $aboutUs = MainPageAboutUs::find($request->about_us['id']);
        if($aboutUs) $aboutUs->edit($request->about_us);
        else MainPageAboutUs::add($request->about_us);

        $event = MainPageEvent::find($request->event['id']);
        if ($event) $event->edit($request->event);
        else MainPageEvent::add($request->event);

        $partners = MainPagePartners::find($request->partners['id']);
        if ($partners) $partners->edit($request->partners);
        else MainPagePartners::add($request->partners);

        return $this->get_main();
    }

    public function titles_store(Request $request)
    {
        Logo::add($request->all());
        return ['logo' => Logo::all()];
    }

    public function download_file(Request $request)
    {
        return Storage::download('public/' . $request->file_name);
    }
}
