<?php

namespace Modules\SimpleForm\Traits;

use Spatie\Activitylog\Models\Activity;

trait ActivityTrait {

    public static function getRecordsCount($discription)
    {
        return Activity::where('description',$discription)->count();
    }
}
