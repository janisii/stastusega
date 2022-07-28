<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Frame;
use App\Image;

class FrameController extends Controller
{
    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Frames manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manager(Frame $frame)
    {
        $frames = Frame::all();
        $notAttachedImages = Image::doesntHave('cell')->get();

        return view('app.frames.manager', [
            'frames' => $frames,
            'currentFrame' => $frame,
            'notAttachedImages' => $notAttachedImages
        ]);
    }

    /**
     * Attach Image to frame cell
     */
    public function attachImageFrame()
    {
        $data = request()->all();

        $query = array( 'row' => $data['row'], 'col' => $data['col'], 'frame_id' => $data['frame_id'] );
        Cell::where($query)->first() ? Cell::where($query)->first()->delete() : null;

        $cell = new Cell();
        $cell->row = $data['row'];
        $cell->col = $data['col'];
        $cell->frame_id = $data['frame_id'];
        $cell->image_id = $data['image_id'];
        $cell->save();

        return redirect()->route('frame-manager', ['frame' => $data['frame_id']]);
    }

    /**
     * Remove Image from frame cell
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImageFrame()
    {
        $data = request()->all();
        Cell::where('frame_id', '=', $data['frame_id'])->where('image_id', '=', $data['image_id'])->where('row', '=', $data['row'])->where('col', '=', $data['col'])->first()->delete();
        return redirect()->route('frame-manager', ['frame' => $data['frame_id']]);
    }

}
