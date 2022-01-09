<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\Matching;
use PHPUnit\Framework\TestCase;

class MatchingTest extends TestCase
{
    public function testGetRightForLeft(): void
    {
        $matching = new Matching([['left1', 'right3'], ['left2', 'right1'], ['left3', 'right2'], ['left4', 'right4']]);

        self::assertSame('right1', $matching->getRightForLeft('left2'));
        self::assertSame('right2', $matching->getRightForLeft('left3'));
        self::assertNull($matching->getRightForLeft('unmatched'));
    }
}
