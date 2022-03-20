<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\HopcroftKarp;
use Motley\HopcroftKarp\Model\Edge;
use PHPUnit\Framework\TestCase;

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
}
