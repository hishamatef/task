<?php

namespace Modules\SimpleForm\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\SimpleForm\Traits\EmailTrait;
use Modules\SimpleForm\Traits\SimpleFormTrait;

class SimpleForm extends Model
{
    use HasFactory;
    use EmailTrait;
    use SimpleFormTrait;
    public $table='form';
    protected $fillable = [
        'first_name', 'second_name', 'family_name', 'uid'
    ];
}
