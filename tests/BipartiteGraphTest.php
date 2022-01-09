<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\BipartiteGraph;
use PHPUnit\Framework\TestCase;

class BipartiteGraphTest extends TestCase
{
    public function testIt(): void
    {
        $graph = new BipartiteGraph([
            1 => [2, 3],
            2 => [1],
            3 => [2],
            4 => [2, 4],
        ]);

        $matching = $graph->hopcroftKarp();

        self::assertSame([
            1 => 3,
            2 => 1,
            3 => 2,
            4 => 4,
        ], $matching);
    }
}
