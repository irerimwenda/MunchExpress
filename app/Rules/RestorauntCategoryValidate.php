<?php

namespace App\Rules;
use App\Models\Category;

use Illuminate\Contracts\Validation\Rule;

class RestorauntCategoryValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     private $restoraunt_id;

    public function __construct($restoraunt_id)
    {
        $this->restoraut_id = $restoraunt_id;
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
        //logger($attribute);
        //logger($value);

        if(Category::where('name', $value)->where('restoraunt_id', $this->restoraunt_id)->first()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This category for this restoraunt does not exist.';
    }
}
