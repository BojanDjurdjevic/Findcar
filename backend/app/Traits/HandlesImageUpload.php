<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait HandlesImageUpload
{
    protected function storeProcessedImage(
        UploadedFile $file,
        string $folder
    ): string {

        $manager = new ImageManager(
            new Driver()
        );

        $fileName = Str::uuid() . '.webp';

        $path = "{$folder}/{$fileName}";

        $image = $manager
            ->read($file)
            ->toWebp(90)
            ->toString();

        Storage::disk('public')
            ->put($path, $image);

        return $path;
    }

    protected function deleteImageFile(
        string $path
    ): void {

        Storage::disk('public')
            ->delete($path);
    }
}