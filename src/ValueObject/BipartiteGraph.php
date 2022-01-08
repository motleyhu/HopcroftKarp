<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\ValueObject;

use Motley\HopcroftKarp\InvalidArgumentException;

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
    private array $set1;

    /**
     * @var Vertex[]
     */
    private array $set2;

    /**
     * TODO: Maybe extract vertices instead of expecting them
     *
     * @param Vertex[] $set1
     * @param Vertex[] $set2
     * @param Edge[]   $edges
     */
    public function __construct(array $set1, array $set2, array $edges)
    {
        foreach ($edges as $edge) {
            if (!\in_array($edge->getVertex1(), $set1)) {
                throw new InvalidArgumentException('Starting vertex of edge must be in set1');
            }
            if (!\in_array($edge->getVertex2(), $set2)) {
                throw new InvalidArgumentException('Ending vertex of edge must be in set2');
            }
        }
        if (array_intersect($set1, $set2)) {
            throw new InvalidArgumentException('Vertex sets shall not intersect');
        }

        $this->set1 = $set1;
        $this->set2 = $set2;
        $this->edges = $edges;
    }
}
