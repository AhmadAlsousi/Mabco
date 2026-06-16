<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Enum\Image\ProductEnum;
use App\Models\ColorImageProduct;

class ImgColorJob implements ShouldQueue
{
    use Queueable;


    /**
     * Create a new job instance.
     */
    public function __construct(        public int $colorimgid,
        public string $path)
    {


    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


         $colorimg = ColorImageProduct::findOrFail($this->colorimgid);
         $fullPath = storage_path('app/private/' . $this->path);
        $colorimg->addMedia($fullPath)
            ->toMediaCollection(ProductEnum::GALLERY->value);

        unlink($fullPath);
    }
}
