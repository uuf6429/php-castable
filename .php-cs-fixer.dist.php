<?php

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        '@PER-CS2.0' => true,
        '@PER-CS2.0:risky' => true,
        'trailing_comma_in_multiline' => false,
    ])
    ->setFinder(
        (new PhpCsFixer\Finder())
            ->in(__DIR__)
    );
