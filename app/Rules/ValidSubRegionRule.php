<?php

namespace App\Rules;

use App\Core\Shared\Region\RegionModel;
use Illuminate\Contracts\Validation\Rule;

class ValidSubRegionRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        return RegionModel::where('parent_region_id','!=',null)->whereId($value)->exists();
    }

    public function message()
    {
       return  __('main.wrong_sub_region');
    }
}
