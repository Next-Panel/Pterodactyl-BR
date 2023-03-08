<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | O following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O :attribute deve ser aceito.',
    'active_url' => 'O :attribute não é uma URL válida.',
    'after' => 'O :attribute deve ser uma data após :date.',
    'after_or_equal' => 'O :attribute deve ser uma data posterior ou igual a :date.',
    'alpha' => 'O :attribute só pode conter cartas.',
    'alpha_dash' => 'O :attribute pode conter apenas letras, números e travessões.',
    'alpha_num' => 'O :attribute pode conter apenas letras e números.',
    'array' => 'O :attribute deve ser uma matriz(array).',
    'before' => 'O :attribute deve ser uma data antes :date.',
    'before_or_equal' => 'O :attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file' => 'O :attribute deve estar entre :min e :max kilobytes(kb).',
        'string' => 'O :attribute deve estar entre :min e :max caracteres.',
        'array' => 'O :attribute deve estar entre :min e :max itens.',
    ],
    'boolean' => 'O :attribute campo deve ser verdadeiro ou falso',
    'confirmed' => 'O :attribute confirmação não corresponde.',
    'date' => 'O :attribute não é uma data válida.',
    'date_format' => 'O :attribute não corresponde ao formato :format.',
    'different' => 'O :attribute e :other deve ser diferente.',
    'digits' => 'O :attribute deve ter :digits digitos.',
    'digits_between' => 'O :attribute deve estar entre :min e :max digitos.',
    'dimensions' => 'O :attribute tem dimensões de imagem inválidas.',
    'distinct' => 'O :attribute campo tem um valor duplicado.',
    'email' => 'O :attribute deve ser um endereço de e-mail válido.',
    'exists' => 'O :attribute selecionado é inválido.',
    'file' => 'O :attribute deve ser um arquivo.',
    'filled' => 'O :attribute é um campo necessário.',
    'image' => 'O :attribute deve ser uma imagem.',
    'in' => 'O :attribute selecionado é inválido.',
    'in_array' => 'O :attribute campo não existe em :other.',
    'integer' => 'O :attribute deve ser um número inteiro.',
    'ip' => 'O :attribute deve ser um endereço IP válido.',
    'json' => 'O :attribute deve ser uma sequência válida de JSON.',
    'max' => [
        'numeric' => 'O :attribute não pode ser maior do que :max.',
        'file' => 'O :attribute não pode ser maior do que :max kilobytes(kb).',
        'string' => 'O :attribute não pode ser maior do que :max caracteres.',
        'array' => 'O :attribute não pode ter mais do que :max itens.',
    ],
    'mimes' => 'O :attribute must be a file of type: :values.',
    'mimetypes' => 'O :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'O :attribute deve ser pelo menos :min.',
        'file' => 'O :attribute deve ser pelo menos :min kilobytes.',
        'string' => 'O :attribute deve ser pelo menos :min characteres.',
        'array' => 'O :attribute deve ser pelo menos :min itens.',
    ],
    'not_in' => 'O selected :attribute é inválido.',
    'numeric' => 'O :attribute deve ser um número.',
    'present' => 'O :attribute campo deve estar presente.',
    'regex' => 'O :attribute formato é inválido.',
    'required' => 'O :attribute é um campo necessário.',
    'required_if' => 'O :attribute é um camponecessário quando :other é :value.',
    'required_unless' => 'O :attribute é um campo necessário, a menos que :other está em :values.',
    'required_with' => 'O :attribute é um camponecessário quando :values está presente.',
    'required_with_all' => 'O :attribute é um camponecessário quando :values está presente.',
    'required_without' => 'O :attribute é um camponecessário quando :values não está presente.',
    'required_without_all' => 'O :attribute é um camponecessário quando nenhum dos :values estão presentes.',
    'same' => 'O :attribute e :other deve combinar.',
    'size' => [
        'numeric' => 'O :attribute deve ser :size.',
        'file' => 'O :attribute deve ser :size kilobytes.',
        'string' => 'O :attribute deve ser :size characteres.',
        'array' => 'O :attribute deve conter :size itens.',
    ],
    'string' => 'O :attribute deve ser uma string.',
    'timezone' => 'O :attribute deve ser uma zona válida.',
    'unique' => 'O :attribute já foi tomado.',
    'uploaded' => 'O :attribute não conseguiu fazer o upload.',
    'url' => 'O :attribute formato é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | O following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

    // Internal validation logic for Pterodactyl
    'internal' => [
        'variable_value' => ':env variável',
        'invalid_password' => 'A senha fornecida era inválida para esta conta.',
    ],
];
