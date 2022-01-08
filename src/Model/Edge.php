<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Model;

/**
 * Represents an edge of the bipartite graph that we are trying to find a maximum cardinality matching of
 */
class Edge
{
    private Vertex $leftVertex;
    private Vertex $rightVertex;

    public function __construct(Vertex $leftVertex, Vertex $rightVertex)
    {
        $this->leftVertex = $leftVertex;
        $this->rightVertex = $rightVertex;
    }

    public function getLeftVertex(): Vertex
    {
        return $this->leftVertex;
    }

    public function getRightVertex(): Vertex
    {
        return $this->rightVertex;
    }
}
