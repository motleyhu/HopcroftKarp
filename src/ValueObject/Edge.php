<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\ValueObject;

/**
 * Represents an edge of the bipartite graph that we are trying to find a maximum cardinality matching of
 */
class Edge
{
    private Vertex $vertex1;
    private Vertex $vertex2;

    public function __construct(Vertex $vertex1, Vertex $vertex2)
    {
        $this->vertex1 = $vertex1;
        $this->vertex2 = $vertex2;
    }

    public function getVertex1(): Vertex
    {
        return $this->vertex1;
    }

    public function getVertex2(): Vertex
    {
        return $this->vertex2;
    }
}
