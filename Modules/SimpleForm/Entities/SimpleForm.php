<?php

namespace Modules\SimpleForm\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SimpleForm\Traits\ActivityTrait;
use Modules\SimpleForm\Traits\EmailTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;

class SimpleForm extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use ActivityTrait;
    use EmailTrait;
    public $table='form';
    protected $fillable = [
        'data01', 'data02', 'data03'
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('only-xlsx-please')
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            });
    }
}
