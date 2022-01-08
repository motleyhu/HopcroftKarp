<?php

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\DoStuff;
use Motley\HopcroftKarp\Model\BipartiteGraph;
use Motley\HopcroftKarp\Model\Edge;
use Motley\HopcroftKarp\Model\Vertex;
use PHPUnit\Framework\TestCase;

class DoStuffTest extends TestCase
{
    public function testFindMatchingOrWhatever(): void
    {
        // Example from https://youtu.be/lM5eIpF0xjA

        $input = new BipartiteGraph([
            new Edge(new Vertex('B'), new Vertex(1)),
            new Edge(new Vertex('E'), new Vertex(7)),
            new Edge(new Vertex('E'), new Vertex(3)),
            new Edge(new Vertex('E'), new Vertex(6)),
            new Edge(new Vertex('J'), new Vertex(2)),
            new Edge(new Vertex('J'), new Vertex(5)),
            new Edge(new Vertex('J'), new Vertex(4)),
            new Edge(new Vertex('L'), new Vertex(7)),
            new Edge(new Vertex('L'), new Vertex(2)),
            new Edge(new Vertex('T'), new Vertex(7)),
            new Edge(new Vertex('T'), new Vertex(6)),
            new Edge(new Vertex('T'), new Vertex(5)),
            new Edge(new Vertex('A'), new Vertex(3)),
            new Edge(new Vertex('A'), new Vertex(6)),
            new Edge(new Vertex('R'), new Vertex(6)),
            new Edge(new Vertex('R'), new Vertex(7)),
        ]);

        $x = DoStuff::findMatchingOrWhatever($input);

        var_dump($x);
    }
}
