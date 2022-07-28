<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Cell extends Model
{

    /**
     * Cell belongs to Frame
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frame()
    {
        return $this->belongsTo('App\Frame');
    }

    /**
     * Cell has one Image
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    /**
     * Find cell image
     * @param $frameId
     * @param $row
     * @param $col
     * @return mixed
     */
    public static function getCellImage($frameId, $row, $col)
    {
        $cell = Cell::where('frame_id', '=', $frameId)->where('row', '=', $row)->where('col', '=', $col)->first();
        return isset($cell->image_id) ? Image::find($cell->image_id) : null;
    }

}
