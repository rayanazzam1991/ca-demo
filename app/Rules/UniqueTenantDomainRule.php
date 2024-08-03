<?php

namespace App\Rules;

use App\Core\Tenant\Infrastructure\Eloquent\TenantModel;
use Illuminate\Contracts\Validation\Rule;

class UniqueTenantDomainRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !TenantModel::where('domain',$value. "." . config("shared_system_config.base_domain"))->exists();

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
