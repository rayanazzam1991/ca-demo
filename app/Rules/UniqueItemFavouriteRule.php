<?php

namespace App\Rules;

use App\Core\Favourite\Infrastructure\Eloquent\FavouriteModel;
use App\Core\Tenant\Infrastructure\Eloquent\TenantModel;
use Illuminate\Contracts\Validation\Rule;

class UniqueItemFavouriteRule implements Rule
{
    private int $distributor_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $distributor_id){
        $this->distributor_id=$distributor_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !FavouriteModel::where('item_id',$value)
            ->where('distributor_id',$this->distributor_id)
            ->where('user_id',auth()->id())
            ->exists();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('main.item_exists');
    }
}
