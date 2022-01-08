<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Tests;

use Motley\HopcroftKarp\BipartiteGraph;
use PHPUnit\Framework\TestCase;

class BipartiteGraphTest extends TestCase
{
    public function testIt(): void
    {
        $graph = new BipartiteGraph(41, 4);
        $graph->addEdge(1, 2);
        $graph->addEdge(1, 3);
        $graph->addEdge(2, 1);
        $graph->addEdge(3, 2);
        $graph->addEdge(4, 2);
        $graph->addEdge(4, 4);

        $x = $graph->hopcroftKarp();
        var_dump($x);
    }
}
