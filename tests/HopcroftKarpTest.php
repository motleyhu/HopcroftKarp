<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\HopcroftKarp;
use PHPUnit\Framework\TestCase;

class HopcroftKarpTest extends TestCase
{
    public function testMatching(): void
    {
        $matching = HopcroftKarp::matching([
            ['left1', ['right2', 'right3']],
            ['left2', 'right1'],
            ['left3', ['right2']],
            ['left4', ['right2']],
            ['left4', 'right4'],
        ]);

        self::assertSame([
            ['left1', 'right3'],
            ['left2', 'right1'],
            ['left3', 'right2'],
            ['left4', 'right4'],
        ], $matching->toArray());
    }
}
