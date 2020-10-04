<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SimpleFormTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    /** @test */
    public function testXlsxUpload()
    {
        $file = UploadedFile::fake()->create('document.xlsx', 5);

        $response = $this->postJson(route('simpleform.store'), [
            'file' => $file
        ]);
        Storage::disk(config('filesystems.default'))->assertExists('/public/uploads/' .$file->hashName());
    }

    /** @test */
    public function testImageUpload()
    {
        $file = UploadedFile::fake()->create('document.jpg', 5);

        $response = $this->json('POST', route('simpleform.store'), [
            'file' => $file,
        ]);

        // Assert a file does not exist...
        Storage::disk(config('filesystems.default'))->assertMissing('/public/uploads/' .$file->hashName());
    }
}
