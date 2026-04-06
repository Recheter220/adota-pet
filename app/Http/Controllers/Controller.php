<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $defaultMessages = [
        'required' => 'O campo :attribute é obrigatório',
        'date' => 'O campo :attribute deve ser uma data válida',
    ];

    protected $messages = [];

    public function __construct()
    {
        $this->messages = [...$this->messages, ...$this->defaultMessages];
    }
}
