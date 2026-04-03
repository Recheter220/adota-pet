<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $messages = [
        'required' => 'O campo :attribute é obrigatório',
        'date' => 'O campo :attribute deve ser uma data válida',
    ];
}
