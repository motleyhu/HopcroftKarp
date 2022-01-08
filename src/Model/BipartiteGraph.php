<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Model;

/**
 * TODO: Extend from Edges
 * The bipartite graph that we are trying to find a maximum cardinality matching of
 */
class BipartiteGraph
{
    /**
     * @var Edge[]
     */
    private array $edges;

    /**
     * @var Vertex[]
     */
    private array $leftVertices = [];

    /**
     * @var Vertex[]
     */
    private array $rightVertices = [];

    /**
     * @param Edge[] $edges
     */
    public function __construct(array $edges)
    {
        foreach ($edges as $edge) {
            $vertex1 = $edge->getLeftVertex();
            $vertex2 = $edge->getRightVertex();

            if (!\in_array($vertex1, $this->leftVertices)) {
                $this->leftVertices[] = $vertex1;
            }
            if (!\in_array($vertex2, $this->rightVertices)) {
                $this->rightVertices[] = $vertex2;
            }
        }

        $this->edges = $edges;
    }

    public function getLeftFreeVertices(Matching $matching): Vertices
    {
        return new Vertices(
            array_diff($this->leftVertices, $matching->getLeftVertices())
        );
    }

    public function getRightFreeVertices(Matching $matching): Vertices
    {
        return new Vertices(
            array_diff($this->rightVertices, $matching->getRightVertices())
        );
    }

    public function getEdgesFromLeftNotInMatching(Vertices $vertices, Matching $matching): Edges
    {
        return new Edges(
            array_filter(
                $this->edges,
                fn (Edge $edge) => $vertices->hasVertex($edge->getLeftVertex()) && !$matching->hasEdge($edge)
            )
        );
    }

    public function getEdgesFromRightInMatching(Vertices $vertices, Matching $matching): Edges
    {
        return new Edges(
            array_filter(
                $this->edges,
                fn (Edge $edge) => $vertices->hasVertex($edge->getLeftVertex()) && $matching->hasEdge($edge)
            )
        );
    }

}
