<?php

namespace App\Http\Controllers;

use App\Fragment;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $imagesWithoutStory = Image::imagesWithoutStory();
        $storiesWithoutImage = Image::storiesWithoutImage();

        return view('app.home', ['imagesWithoutStory' => $imagesWithoutStory, 'storiesWithoutImage' => $storiesWithoutImage]);
    }

    /**
     * Show stories with images only
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stories()
    {
        $fragments = Fragment::whereNotNull('image_id')->get();
        return view('app.home', ['fragments' => $fragments]);
    }

}
