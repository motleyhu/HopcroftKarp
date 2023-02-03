<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\Model\Edge;
use Motley\HopcroftKarp\Model\Matching;
use PHPUnit\Framework\TestCase;

/**
 * MatchingTest
 */
class MatchingTest extends TestCase
{
    public function testGetRightForLeft(): void
    {
        $matching = new Matching([
            new Edge('left1', 'right3'),
            new Edge('left2', 'right1'),
            new Edge('left3', 'right2'),
            new Edge('left4', 'right4'),
        ]);

        self::assertSame('right1', $matching->getRightByLeft('left2'));
        self::assertSame('right2', $matching->getRightByLeft('left3'));
        self::assertNull($matching->getRightByLeft('unmatched'));
        self::assertSame('left3', $matching->getLeftByRight('right2'));
        self::assertSame(['left1', 'left2', 'left3', 'left4'], $matching->getAllLeft());
        self::assertSame(['right3', 'right1', 'right2', 'right4'], $matching->getAllRight());
    }
}
