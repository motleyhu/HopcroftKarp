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
     * @dataProvider dataProvider
     * @param array<positive-int, array<positive-int>> $data
     * @param array<positive-int, positive-int|null> $previousMatching
     * @param mixed[] $expected
     */
    public function testHopcroftKarp(array $data, array $previousMatching, array $expected): void
    {
        $graph = new BipartiteGraph($data);

        self::assertSame($expected, $graph->hopcroftKarp($previousMatching));
    }

    /**
     * @return iterable<string, array<positive-int, array<positive-int>>|mixed[]>
     */
    public static function dataProvider(): iterable
    {
        yield 'empty' => [[], [], []];

        yield 'simple' => [
            [
                1 => [2, 3],
                2 => [1],
                3 => [2],
                4 => [2, 4],
            ], [],
            [
                1 => 3,
                2 => 1,
                3 => 2,
                4 => 4,
            ],
        ];

        yield 'complex with imperfect matching' => [
            [
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
            ], [],
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
            [
                1 => [2, 3],
                2 => [],
                3 => [2],
                4 => [2, 4],
            ], [],
            [
                1 => 3,
                2 => null,
                3 => 2,
                4 => 4,
            ],
        ];

        yield 'more vertices on the right side' => [
            [
                1 => [1, 3],
                2 => [3],
                3 => [2, 4],
                4 => [1, 4, 5],
            ], [],
            [
                1 => 1,
                2 => 3,
                3 => 2,
                4 => 4,
            ],
        ];

        yield 'more vertices on the left side' => [
            [
                1 => [1, 4],
                2 => [3],
                3 => [1, 2],
                4 => [3, 4],
                5 => [4],
            ], [],
            [
                1 => 1,
                2 => 3,
                3 => 2,
                4 => 4,
                5 => null,
            ],
        ];

        yield 'complete freezing edges' => [
            [
                1 => [1, 2, 3, 4],
                2 => [1, 2, 3, 4],
                3 => [1, 2, 3, 4],
                4 => [1, 2, 3, 4],
            ],
            [
                1 => 3,
                2 => 1,
                3 => 2,
                4 => 4,
            ],
            [
                1 => 3,
                2 => 1,
                3 => 2,
                4 => 4,
            ],
        ];

        yield 'partial freezing edges' => [
            [
                1 => [1, 2, 3],
                2 => [1, 2, 3, 4],
                3 => [2, 3, 4],
                4 => [1, 2, 3, 4],
            ],
            [
                1 => 4,
                2 => 2,
                3 => 1,
                4 => 3,
            ],
            [
                1 => 1,
                2 => 2,
                3 => 4,
                4 => 3,
            ],
        ];

        yield 'no overlap with previous matching' => [
            [
                1 => [1, 2],
                2 => [2, 3],
                3 => [3, 4],
                4 => [1],
            ],
            [
                1 => 3,
                2 => 1,
                3 => 2,
                4 => 4,
            ],
            [
                1 => 2,
                2 => 3,
                3 => 4,
                4 => 1,
            ],
        ];

        yield 'ignore previous matching if necessary to achieve maximum matching' => [
            [
                1 => [1, 2],
                2 => [1],
            ],
            [
                1 => 1,
                2 => 2,
            ],
            [
                1 => 2,
                2 => 1,
            ],
        ];
    }
}
