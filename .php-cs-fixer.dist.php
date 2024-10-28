<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return (new Config())
    ->setRules([
        '@PSR2' => true,
    ])
    ->setFinder(
        Finder::create()
            ->in(__DIR__)
    );
