<?php

namespace App\Http\Controllers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Http\Request;
use App\Image;
use App\Fragment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{



    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List of images + upload form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $images = Image::all();
        return view('app.images.index', ['images' => $images]);
    }

    /**
     * Generate fragment item for images without fragment item
     */
    public function generateFragments()
    {
        $imagesWithoutStory = Image::imagesWithoutStory();

        if (count($imagesWithoutStory) > 0) {
            foreach($imagesWithoutStory as $item) {
                $fragment = new Fragment();
                $fragment->name = $item->image_filename_ori;
                $fragment->course = $item->image_filename_ori;
                $fragment->living_location = 'Ogre';
                $fragment->story = 'Stāsts nav pieejams.';
                $fragment->image_sync = true;
                $fragment->user_id = Auth::user()->id;
                $fragment->save();

                $image = Image::find($item->image_id);
                $image->fragment_id = $fragment->id;
                $image->save();
            }
        }

        return redirect()->route('fragments');
    }

    /**
     * Image sync with stories
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sync()
    {
        /**
         * Select all images which are not manually synced with stories
         */
        $images = Image::whereHas('fragment', function ($query) {
            $query->where('image_sync', '=', false);
        })->get();

        return view('app.images.sync', ['images' => $images]);
    }

    public function apply()
    {
        $images = Image::whereNull('fragment_id')->get();

        if (count($images) < 1) {
            return redirect()->route('images');
        }

        $found = 0;

        foreach($images as $image) {
            $fragmentAuthor = getNameFromFileName($image->filename_ori);
            $fragmentMatched = Fragment::findMatchByAuthorName($fragmentAuthor);

            if ($fragmentMatched) {
                $image->fragment_id = $fragmentMatched->id;
                $image->save();
                $found++;
            }
        }

        return $found > 0 ? redirect()->route('sync') : redirect()->route('images');
    }

    /**
     * Sync Image Fragment
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncImageFragment(Request $request)
    {
        $fragment = Fragment::find($request->post('fragment'));

        if ($fragment) {

            $fragment->image_sync = true;
            $fragment->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    /**
     * Save images to database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $postFiles = $request->file();
        $files = $postFiles['files'];

        if (!$files) {
            return response()->json(['error' => true]);
        }

        if (is_array($files) && count($files) < 1) {
            return response()->json(['error' => true]);
        }

        foreach($files as $file) {

            $hashFilename = $file->hashName();
            $originalFilename = $file->getClientOriginalName();

            if ($file->move(storage_path('app/images'), $hashFilename)) {

                $image = Image::firstOrNew(['filename_ori' => $originalFilename]);

                // remove old file form server
                if ($image->filename) {
                    self::removeOldImage(storage_path('app/images/') . $image->filename);
                }

                // RGB image to Hex
                $rgbHEX = averageImageHexColor(storage_path('app/images/') . $hashFilename);

                $image->filename = $hashFilename;
                $image->filename_ori = $originalFilename;
                $image->background_hex = $rgbHEX;
                $image->save();

                // Attach image to fragment story, if possible.
                $fragmentAuthor = getNameFromFileName($image->filename_ori);
                $fragmentMatched = Fragment::findMatchByAuthorName($fragmentAuthor);

                // Attach image to story
                if ($fragmentMatched) {
                    $image->fragment_id = $fragmentMatched->id;
                    $image->save();
                }

            }

        }

        // do some upload insert in db return json OK in the end
        return response()->json(['success' => true]);
    }

    /**
     * Remove old files from server
     * @param $pathToFile
     */
    public static function removeOldImage($pathToFile)
    {
        unlink($pathToFile);
    }

}
