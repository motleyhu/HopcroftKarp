<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\BipartiteGraph;
use PHPUnit\Framework\TestCase;

/**
 * BipartiteGraphTest
 */
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

    public function testFreezingEdges(): void
    {
        $previousMatching = [
            1 => 3,
            2 => 1,
            3 => 2,
            4 => 4,
        ];

        $graph = new BipartiteGraph([
            1 => [1, 2, 4],
            2 => [1, 2, 3, 4],
            3 => [1, 3, 4],
            4 => [1, 2, 3, 4],
        ]);

        $this->assertSame([
            1 => 2,
            2 => 1,
            3 => 3,
            4 => 4,
        ], $graph->hopcroftKarp($previousMatching));
    }
}
