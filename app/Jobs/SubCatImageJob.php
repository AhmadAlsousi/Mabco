<?php

namespace App\Jobs;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Log;
class SubCatImageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $subId,
        public string $path
    ) {
    }

    public function handle(): void
    {
        Log::info('JOB STARTED');

    $subcategory = Subcategory::findOrFail($this->subId);

    $fullPath = storage_path('app/private/' . $this->path);

    $subcategory->addMedia($fullPath)
        ->toMediaCollection('subcategory');

 
    }
}
