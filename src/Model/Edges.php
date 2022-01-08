<?php

namespace Motley\HopcroftKarp\Model;

/**
 * A collection of edges
 */
class Edges
{
    /**
     * @var Edge[]
     */
    private array $edges;

    /**
     * @param Edge[] $edges
     */
    public function __construct(array $edges)
    {
        $this->edges = $edges;
    }

    public function getLeftVertices(): Vertices
    {
        return new Vertices(
            array_map(fn (Edge $edge) => $edge->getRightVertex(), $this->edges)
        );
    }

    public function getRightVertices(): Vertices
    {
        return new Vertices(
            array_map(fn (Edge $edge) => $edge->getRightVertex(), $this->edges)
        );
    }
}
