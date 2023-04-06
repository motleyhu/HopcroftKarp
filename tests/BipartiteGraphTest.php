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
    /**
     * @return iterable<string, array<BipartiteGraph|mixed[]>>
     */
    public function hopcroftKarpDataProvider(): iterable
    {
        yield 'empty' => [
            new BipartiteGraph([]),
            [],
        ];

        yield 'simple' => [
            new BipartiteGraph([
                1 => [2, 3],
                2 => [1],
                3 => [2],
                4 => [2, 4],
            ]),
            [
                1 => 3,
                2 => 1,
                3 => 2,
                4 => 4,
            ],
        ];

        yield 'complex & imperfect matching' => [
            new BipartiteGraph([
                1 => [5, 6],
                2 => [7, 8],
                3 => [9, 10],
                4 => [11],
                5 => [1],
                6 => [1],
                7 => [2],
                8 => [2],
                9 => [3],
                10 => [3],
                11 => [4],
            ]),
            [
                1 => 5,
                2 => 7,
                3 => 9,
                4 => 11,
                5 => 1,
                6 => null,
                7 => 2,
                8 => null,
                9 => 3,
                10 => null,
                11 => 4,
            ],
        ];

        yield 'empty right side' => [
            new BipartiteGraph([
                1 => [2, 3],
                2 => [],
                3 => [2],
                4 => [2, 4],
            ]),
            [
                1 => 3,
                2 => null,
                3 => 2,
                4 => 4,
            ]
        ];

        yield 'more vertices on the right side' => [
            new BipartiteGraph([
                1 => [1, 3],
                2 => [3],
                3 => [2, 4],
                4 => [1, 4, 5],
            ]),
            [
                1 => 1,
                2 => 3,
                3 => 2,
                4 => 4,
            ]
        ];

        yield 'more vertices on the left side' => [
            new BipartiteGraph([
                1 => [1, 4],
                2 => [3],
                3 => [1, 2],
                4 => [3, 4],
                5 => [4],
            ]),
            [
                1 => 1,
                2 => 3,
                3 => 2,
                4 => 4,
                5 => null,
            ]
        ];
    }

    /**
     * @dataProvider hopcroftKarpDataProvider
     * @param mixed[] $expected
     */
    public function testHopcroftKarp(BipartiteGraph $graph, array $expected): void
    {
        self::assertSame($expected, $graph->hopcroftKarp());
    }
}
