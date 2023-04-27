<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\HopcroftKarp;
use Motley\HopcroftKarp\Model\Edge;
use Motley\HopcroftKarp\Model\Matching;
use PHPUnit\Framework\TestCase;

/**
 * HopcroftKarpTest
 */
class HopcroftKarpTest extends TestCase
{
    /**
     * @var HopcroftKarp<string, string>
     */
    private HopcroftKarp $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new HopcroftKarp();
    }

    public function testMatching(): void
    {
        $matching = $this->service->match([
            ['left1', ['right2', 'right3']],
            ['left2', ['right1']],
            ['left3', ['right2']],
            ['left4', ['right2']],
            ['left4', ['right4']],
        ]);

        self::assertEquals([
            new Edge('left1', 'right3'),
            new Edge('left2', 'right1'),
            new Edge('left3', 'right2'),
            new Edge('left4', 'right4'),
        ], $matching->toArray());
    }

    public function testMatchingEmpty(): void
    {
        $matching = $this->service->match([
            ['left1', ['right2', 'right3']],
            ['left2', ['right1']],
            ['left3', ['right2']],
            ['left4', ['right2']],
            ['left4', ['right4']],
        ]);

        self::assertEquals([
            new Edge('left1', 'right3'),
            new Edge('left2', 'right1'),
            new Edge('left3', 'right2'),
            new Edge('left4', 'right4'),
        ], $matching->toArray());
    }

    public function testMatchingEmptyRight(): void
    {
        $matching = $this->service->match([
            ['left1', ['right2', 'right3']],
            ['left2', ['right1']],
            ['left3', []],
            ['left4', ['right2']],
            ['left4', ['right4']],
        ]);

        self::assertEquals([
            new Edge('left1', 'right2'),
            new Edge('left2', 'right1'),
            new Edge('left4', 'right4'),
        ], $matching->toArray());
    }

    public function testFreezingEdges(): void
    {
        $previousMatching = new Matching([
            new Edge('left1', 'right4'),
            new Edge('left2', 'right3'),
            new Edge('left3', 'right2'),
            new Edge('left4', 'right1'),
        ]);

        $result = $this->service->match([
            ['left1', ['right1', 'right2', 'right3', 'right4']],
            ['left2', ['right1', 'right2', 'right3', 'right4']],
            ['left3', ['right1', 'right2', 'right3', 'right4']],
            ['left4', ['right1', 'right2', 'right3', 'right4']],
        ], $previousMatching);

        // Should be {1-1, 2-2, 3-3, 4-4} without freezing edges
        self::assertEquals($previousMatching, $result);
    }
}
