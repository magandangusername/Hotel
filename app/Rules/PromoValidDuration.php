<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\promotion_description;
use Illuminate\Support\Facades\DB;

class PromoValidDuration implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $date = date("Y-m-d h:i:sa");
        $valid = DB::table('promotion_descriptions')->where('promotion_start', '<=', $date)->where('promotion_end', '>=', $date)->where('promotion_code', $value)->count();

        // if ($valid >= 1) {
        //     return true;
        // }
        return $valid >= 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is no longer or not yet available.';
    }
}
