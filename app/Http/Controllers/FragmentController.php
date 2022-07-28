<?php

namespace App\Http\Controllers;

use App\Fragment;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FragmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Fragment::getItems(50);

        if (request('noimages') === "true") {
            $items = Fragment::doesntHave('images')->paginate(50);
        }

        return view('app.fragments.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Fragment();
        return view('app.fragments.form', [
            'item' => $item,
            'submitRoute' => 'fragments-store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fragment = new Fragment();
        return $this->update($request, $fragment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function show(Fragment $fragment)
    {
        //
        return redirect()->route('fragments');
        //return view('app.fragments.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function edit(Fragment $fragment)
    {
        return view('app.fragments.form', [
            'item' => $fragment,
            'submitRoute' => 'fragments-update',
            'images' => Image::where('fragment_id', '=', $fragment->id)->get(),
            'imagesNotAttached' => Image::whereNull('fragment_id')->get()->toJson()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fragment $fragment)
    {
        $post = request()->all();

        if (Auth::user()->group === 'user') {
            // validation
            $this->validate($request, [
                'name' => 'bail|required',
                'course' => 'bail|required',
                'story' => 'bail|required',
            ]);
        }

        $fragment->name = $post['name'];
        $fragment->course = $post['course'];
        $fragment->living_location = $post['living_location'];
        $fragment->story = $post['story'];
        $fragment->active = isset($post['active']) && $post['active'] === '1' ? 1 : 0;
        $fragment->anonymous = isset($post['anonymous']) && $post['active'] === '1' ? 1 : 0;

        // set the author
        if (!$fragment->id) {
            $fragment->active = 1;
            $fragment->user_id = Auth::user()->id;
        }

        $saveResult = $fragment->save();

        if ($saveResult) {
            request()->session()->flash('alert-success', 'Dati saglabāti datu bāzē');
        } else {
            request()->session()->flash('alert-error', 'Atvainojiet, bet dati nav saglabāti datu bāzē, jo ir notikusi kļūda sistēmā');
        }

        return redirect()->route('fragments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fragment $fragment)
    {
        //
    }

    /**
     * Remove fragment from image
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fragmentImageRemove(Image $image)
    {
        $image = Image::find($image->id);
        $fragmentId = $image->fragment_id;
        $image->fragment_id = null;
        $image->save();

        $images = Image::where('fragment_id', '=', $fragmentId)->get();

        if (count($images) === 0) {
            $fragment = Fragment::find($fragmentId);
            $fragment->image_sync = false;
            $fragment->save();
        }

        return redirect()->route('fragments-edit', ['fragment' => $fragmentId]);
    }

    /**
     * Attach image to fragment
     * @param Fragment $fragment
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fragmentImageAttach(Fragment $fragment, Image $image)
    {
        $image = Image::find($image->id);
        $image->fragment_id = $fragment->id;
        $image->save();
        return redirect()->route('fragments-edit', ['fragment' => $fragment->id]);
    }


}
