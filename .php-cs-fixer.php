<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor', 'public', 'storage', 'tools', 'dockerlaravelblog', 'bootstrap', '.vscode', '.config', '.composer', 'config'])
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@Symfony' => true,
        //'full_opening_tag' => false,
    ])
    ->setFinder($finder)
;