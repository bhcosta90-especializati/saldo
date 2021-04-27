<?php

namespace App\Form\Admin\Transfer;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class TransferForm extends Form
{
    public function buildForm()
    {
        $this->add('value', Field::NUMBER, [
            'label' => __('Valor'),
            'rules' => ['required', 'numeric', 'between:0,'.$this->getData('balance')],
            'attr' => [
                'placeholder' => __('Valor da transferência'),
                'step' => '0.01'
            ]
        ]);
    }
}
