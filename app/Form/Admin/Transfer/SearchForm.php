<?php

namespace App\Form\Admin\Transfer;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class SearchForm extends Form
{
    public function buildForm()
    {
        $this->add('name', Field::TEXT, [
            'label' => __('Nome ou E-mail'),
            'rules' => ['required'],
            'attr' => [
                'placeholder' => __('Informação de quem vai receber a transferência (Nome ou E-mail)'),
                'step' => '0.01'
            ]
        ]);
    }
}
