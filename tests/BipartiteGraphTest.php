<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\BipartiteGraph;
use PHPUnit\Framework\TestCase;

class BipartiteGraphTest extends TestCase
{
    public function testHopcroftKarp(): void
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

    public function testHopcroftEmptyInput(): void
    {
        $graph = new BipartiteGraph([]);

        $matching = $graph->hopcroftKarp();

        self::assertSame([], $matching);
    }

    public function testHopcroftEmptyRightSide(): void
    {
        $graph = new BipartiteGraph([
            1 => [2, 3],
            2 => [],
            3 => [2],
            4 => [2, 4],
        ]);

        $matching = $graph->hopcroftKarp();

        self::assertSame([
            1 => 3,
            2 => null,
            3 => 2,
            4 => 4,
        ], $matching);
    }
}
