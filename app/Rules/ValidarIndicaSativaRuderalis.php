<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarIndicaSativaRuderalis implements Rule
{
    protected $indica;
    protected $sativa;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($indica, $sativa)
    {
        $this->indica = $indica;
        $this->sativa = $sativa;
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
        $ruderalis = $value;
        if(doubleval($this->indica) + doubleval($this->sativa) + doubleval($ruderalis) == 100 ){
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
        return 'la suma entre indica, sativa y ruderalis debe ser igual a 100%.';
    }
}
