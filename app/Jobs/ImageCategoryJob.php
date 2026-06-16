<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use App\Enum\Image\CategoryEnum;
class ImageCategoryJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public int $categoryId,
        public string $path
    ) {}

    public function handle(): void
    {
        $category = Category::findOrFail($this->categoryId);
        $fullPath = storage_path('app/private/' . $this->path);
        $category->addMedia($fullPath)
            ->toMediaCollection(CategoryEnum::IMAGE->value);

        // unlink($fullPath);
        // $subcategory = Subcategory::findOrFail($this->subcategory);
        //  $fullPath = storage_path('app/private/' . $this->tempath);
        // $subcategory->addMedia($fullPath)
        //     ->toMediaCollection('subcategory');

        // unlink($fullPath);
    }
}
