<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarTHC_CBD implements Rule
{
    protected $THC;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($THC)
    {
        $this->THC = $THC;
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
        $CBD = $value;
        if((doubleval($this->THC) + doubleval($CBD)) <= 70){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'la suma entre THC y CBD debén sumar como máximo 70%.';
    }
}
