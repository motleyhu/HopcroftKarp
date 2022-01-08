<?php

namespace Motley\HopcroftKarp\Model;


use LogicException;

/**
 * TODO: Extend from Edges
 * Model for gathering edges for matching
 */
class Matching
{
    /**
     * @var Edge[]
     */
    private array $edges = [];

    /**
     * TODO: Cache
     * @return Vertex[]
     */
    public function getLeftVertices(): array
    {
        return array_map(
            fn (Edge $edge) => $edge->getLeftVertex(),
            $this->edges
        );
    }

    /**
     * TODO: Cache
     * @return Vertex[]
     */
    public function getRightVertices(): array
    {
        return array_map(
            fn (Edge $edge) => $edge->getRightVertex(),
            $this->edges
        );
    }

    public function hasEdge(Edge $edge): bool
    {
        return in_array($edge, $this->edges);
    }
}
