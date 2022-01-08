<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\ValueObject;

/**
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
    private array $set1 = [];

    /**
     * @var Vertex[]
     */
    private array $set2 = [];

    /**
     * @param Edge[] $edges
     */
    public function __construct(array $edges)
    {
        foreach ($edges as $edge) {
            $vertex1 = $edge->getVertex1();
            $vertex2 = $edge->getVertex2();

            if (!\in_array($vertex1, $this->set1)) {
                $this->set1[] = $vertex1;
            }
            if (!\in_array($vertex2, $this->set2)) {
                $this->set2[] = $vertex2;
            }
        }

        $this->edges = $edges;
    }

    /**
     * @return Edge[]
     */
    public function getEdges(): array
    {
        return $this->edges;
    }
}
