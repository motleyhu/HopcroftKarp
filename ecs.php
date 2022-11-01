<?php

declare(strict_types=1);

use Motley\EasyCodingStandard\SetList;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\ClassCommentSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([__DIR__]);
    $ecsConfig->skip([
        __DIR__ . '/vendor',
        ClassCommentSniff::class => [__DIR__ . '/tests'],
    ]);

    $ecsConfig->sets([SetList::MOTLEY]);
};
