<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fragment extends Model
{

    /**
     * Get the image record associated with the fragment.
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /**
     * Get first image
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|null|object
     */
    public function getFirstImageAttribute() {
        return $this->images()->first();
    }

    /**
     * Get fragment items
     * @param $perPage
     * @param string $orderBy
     * @param string $orderDirection
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getItems($perPage = false, $orderBy = 'id', $orderDirection = 'desc')
    {
        // filter all
        $query = Fragment::query();

        // filter by search query
        if ($q = request('q')) {
            $query = Fragment::where('name', 'like', '%' . $q . '%')
                ->orWhere('course', 'like', '%' . $q . '%')
                ->orWhere('living_location', 'like', '%' . $q . '%')
                ->orWhere('story', 'like', '%' . $q . '%');
        }

        $query->orderBy($orderBy, $orderDirection);

        if ($perPage > 0) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    /**
     * Find fragment by author name
     * @param $authorName
     * @return bool
     */
    public static function findMatchByAuthorName($authorName, $matchPercent = 85)
    {
        $fragments = Fragment::where('image_sync', '=', false)->get();

        if (count($fragments) < 1) {
            return false;
        }

        foreach ($fragments as $fragment) {
            $fragmentAuthor = replaceLVChars(str_replace(',',  '', $fragment->name) . ' ' . str_replace('.', '', $fragment->course));
            similar_text($authorName, $fragmentAuthor, $perc);
            if ($perc > $matchPercent) {
                return $fragment;
            }
        }

        return false;
    }

    /**
     * Relation relocation (replacement)
     * Running only when migration executed
     */
    public static function replaceRelationIds()
    {
        $fragments = Fragment::whereNotNull('image_id')->get();

        if ($fragments) {
            foreach($fragments as $fragment) {
                $fragmentId = $fragment->id;
                $imageId = $fragment->image_id;

                $image = Image::find($imageId);
                $image->fragment_id = $fragmentId;
                $image->save();

                $fragment->image_id = NULL;
                $fragment->save();
            }
        }
    }
    
}
