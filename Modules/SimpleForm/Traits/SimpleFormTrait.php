<?php

namespace Modules\SimpleForm\Traits;


use Modules\SimpleForm\Entities\SimpleForm;

trait SimpleFormTrait {

    public static function getRejectedRecordsCount()
    {
        return SimpleForm::whereNull('first_name')
            ->orWhereNull('second_name')
            ->orWhereNull('family_name')
            ->orWhereNull('uid')
            ->count();
    }

    public static function getAcceptedRecordsCount()
    {
        return SimpleForm::whereNotNull('first_name')
            ->whereNotNull('second_name')
            ->whereNotNull('family_name')
            ->whereNotNull('uid')
            ->count();
    }
}
