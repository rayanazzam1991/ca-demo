<?php

namespace App\Rules;

use App\Core\Reminder\Infrastructure\Eloquent\ReminderModel;
use Illuminate\Contracts\Validation\Rule;

class UniqueItemNotifyRule implements Rule
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
        return !ReminderModel::where('item_id',$value)
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
        return __('main.domain_exists');
    }
}
