<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Bus\Queueable;
use App\Enum\Image\ProductEnum;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductGalleryJob implements ShouldQueue
{
     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $productId,
        public string $mainImage,
        public array $gallery
    ) {}

    /**
     * Execute the job.
     */
   public function handle(): void
{
    $product = Product::find($this->productId);
    if (!$product) {
       Log::warning("Product {$this->productId} not found.");
        return;
    }

    // Main Image
    $mainImagePath = storage_path('app/private/' . $this->mainImage);
    if (file_exists($mainImagePath)) {
        $product
            ->addMedia($mainImagePath)
            ->toMediaCollection(ProductEnum::IMAGE->value, 'product'); // disk public
      
    } else {
        Log::warning("Main image not found: {$mainImagePath}");
    }

    // Gallery
                if ($this->gallery === null) { 

}else {
          foreach ($this->gallery as $image) {
        $fullPath = storage_path('app/private/' . $image);
        if (file_exists($fullPath)) {
            $product
                ->addMedia($fullPath)
                ->toMediaCollection(ProductEnum::GallaryProduct->value, 'gallery_products'); // disk public
          
        } else {
            Log::warning("Gallery image not found: {$fullPath}");
        }
    }
    }


    Log::info("Media added for product {$this->productId}");
}
}
