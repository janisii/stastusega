<?php

use Illuminate\Database\Seeder;
use App\Frame;

class FramesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (count(Frame::where('title', 'Režģis 1')->get()) === 0) {
            $f = new Frame();
            $f->title = 'Režģis 1';
            $f->save();
        }
        if (count(Frame::where('title', 'Režģis 2')->get()) === 0) {
            $f = new Frame();
            $f->title = 'Režģis 2';
            $f->save();
        }
        if (count(Frame::where('title', 'Režģis 3')->get()) === 0) {
            $f = new Frame();
            $f->title = 'Režģis 3';
            $f->save();
        }
        if (count(Frame::where('title', 'Režģis 4')->get()) === 0) {
            $f = new Frame();
            $f->title = 'Režģis 4';
            $f->save();
        }
        if (count(Frame::where('title', 'Režģis 5')->get()) === 0) {
            $f = new Frame();
            $f->title = 'Režģis 5';
            $f->save();
        }
    }
}