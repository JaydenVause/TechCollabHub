<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidBlock implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $blockTypes = ['paragraph' , 'header', 'image'];

       $found = false;

       foreach($blockTypes as $blockType){
            if($value == $blockType){
                $found = true;
                break;
            }
       }

       if(!$found){
        $fail('The :attribute must be a valid block type');
       }
    }
}
