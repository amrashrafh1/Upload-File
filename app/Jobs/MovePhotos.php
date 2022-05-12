<?php

namespace App\Jobs;

use App\Models\Album;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MovePhotos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $album, $newAlbum;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Album $album, Album $newAlbum)
    {
        $this->album = $album;
        $this->newAlbum = $newAlbum;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $photos = $this->album->getMedia('photos');
            foreach($photos as $photo){
                $this->newAlbum->addMedia($photo->getPath())->toMediaCollection('photos');
                $photo->delete();
            }
            $this->album->delete();
    }
}
