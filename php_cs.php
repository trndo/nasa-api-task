<?php

$finder = PhpCsFixer\Finder::create()
    ->in('src');
return PhpCsFixer\Config::create()
    ->setRules([
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'continue',
                'return',
                'throw',
                'try'
            ]
        ],
        '@PSR2' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP71Migration:risky' => true,
        '@PHP73Migration' => true,
        'psr4' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'strict_param' => true,
        'mb_str_functions' => true,
        'declare_strict_types' => true,
        'array_syntax' => ['syntax' => 'short'],
        'class_definition' => [
            'multi_line_extends_each_single_line' => true
        ]
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php_cs.cache');