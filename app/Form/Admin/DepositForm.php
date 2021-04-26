<?php

namespace App\Form\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class DepositForm extends Form
{
    public function buildForm()
    {
        $this->add('value', Field::NUMBER, [
            'label' => __('Valor'),
            'rules' => ['required', 'numeric', 'between:0,99999.99'],
            'attr' => [
                'placeholder' => __('Valor da recarga'),
                'step' => '0.01'
            ]
        ]);
    }
}
