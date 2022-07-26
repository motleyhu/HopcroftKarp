<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\ClassCommentSniff;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ControlStructure\NoTrailingCommaInListCallFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoTrailingCommaInSinglelineFunctionCallFixer;
use PhpCsFixer\Fixer\FunctionNotation\StaticLambdaFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\HeredocIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Spacing\StandaloneLinePromotedPropertyFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->parallel();
    $ecsConfig->paths([__DIR__]);
    $ecsConfig->skip([
        __DIR__ . '/vendor',
        ClassCommentSniff::class => [__DIR__ . '/tests'],
    ]);

    $ecsConfig->sets([SetList::PSR_12, SetList::CLEAN_CODE, SetList::DOCTRINE_ANNOTATIONS]);

    $ecsConfig->rules([
        ObjectOperatorWithoutWhitespaceFixer::class,
        NativeFunctionInvocationFixer::class,
        TrailingCommaInMultilineFixer::class,
        NoTrailingCommaInListCallFixer::class,
        NoTrailingCommaInSinglelineArrayFixer::class,
        NoTrailingCommaInSinglelineFunctionCallFixer::class,
        FullyQualifiedStrictTypesFixer::class,
        GlobalNamespaceImportFixer::class,
        FunctionTypehintSpaceFixer::class,
        ArrayIndentationFixer::class,
        HeredocIndentationFixer::class,
        PhpdocIndentFixer::class,
        MethodChainingIndentationFixer::class,
        IsNullFixer::class,
        BlankLineBeforeStatementFixer::class,
        DeclareStrictTypesFixer::class,
        ClassCommentSniff::class,
        CyclomaticComplexitySniff::class,
        NestingLevelSniff::class,
        StandaloneLinePromotedPropertyFixer::class,
        LineLengthFixer::class,
        StaticLambdaFixer::class,
    ]);
};
