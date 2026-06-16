<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Subcategory;

class SubcategoryImgJob implements ShouldQueue
{
    use Queueable;

  


    /**
     * Create a new job instance.
     */
    public function __construct(  protected $subcategory,
    protected $tempath)
    {
 

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         $subcategory = Subcategory::findOrFail($this->subcategory);
         $fullPath = storage_path('app/private/' . $this->tempath);
        $subcategory->addMedia($fullPath)
            ->toMediaCollection('subcategory');

       
    }
}
