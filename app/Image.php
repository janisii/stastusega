<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    // mass assignment
    protected $fillable = array('filename_ori');

    /**
     * Get the fragment that owns the image.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragment()
    {
        return $this->belongsTo('App\Fragment');
    }

    /**
     * Image belongs to cell
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cell()
    {
        return $this->hasOne('App\Cell');
    }

    /**
     * Select all image items with related data for ReactJS
     * components
     */
    public static function allImageItemsJson()
    {
        return DB::table('images')
            ->leftJoin('fragments', 'fragments.id', '=', 'images.fragment_id')
            ->join('cells', 'cells.image_id', '=', 'images.id')
            ->join('frames', 'frames.id', '=', 'cells.frame_id')
            ->select('images.id as image_id',
                'images.filename as image_filename',
                'images.filename_ori as image_filename_ori',
                'images.background_hex as image_background_hex',
                'fragments.id as fragment_id',
                'fragments.name as fragment_name',
                'fragments.course as fragment_course',
                'fragments.living_location as fragment_location',
                'fragments.story as fragment_story',
                'frames.id as frame_id',
                'frames.title as frame_title',
                'cells.row as cell_row',
                'cells.col as cell_col'
            )->get()->toJson();
    }

    /**
     * Filter all images without stories
     * @return string
     */
    public static function imagesWithoutStory()
    {
        return DB::table('images')
            ->leftJoin('fragments', 'fragments.id', '=', 'images.fragment_id')
            ->whereNull('fragments.id')
            ->select('images.id as image_id',
                'images.filename as image_filename',
                'images.filename_ori as image_filename_ori',
                'images.background_hex as image_background_hex',
                'fragments.id as fragment_id',
                'fragments.name as fragment_name',
                'fragments.course as fragment_course',
                'fragments.living_location as fragment_location',
                'fragments.story as fragment_story'
            )->get();
    }

    /**
     * Filter all images without stories
     * @return string
     */
    public static function storiesWithoutImage()
    {
        return DB::table('fragments')
            ->leftJoin('images', 'fragments.id', '=', 'images.fragment_id')
            ->whereNull('images.id')
            ->select('images.id as image_id',
                'images.filename as image_filename',
                'images.filename_ori as image_filename_ori',
                'images.background_hex as image_background_hex',
                'fragments.id as fragment_id',
                'fragments.name as fragment_name',
                'fragments.course as fragment_course',
                'fragments.living_location as fragment_location',
                'fragments.story as fragment_story'
            )->get();
    }

}
