<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Model;

/**
 * The resulting matching
 * TODO: VO for Edges
 */
class Matching
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

    /**
     * @return Edge[]
     */
    public function toArray(): array
    {
        return $this->edges;
    }

    /**
     * @return array<vertex>
     */
    public function getAllLeft(): array
    {
        return array_map(
            fn (Edge $edge) => $edge->getLeftVertex(),
            $this->edges
        );
    }

    /**
     * @return array<vertex>
     */
    public function getAllRight(): array
    {
        return array_map(
            fn (Edge $edge) => $edge->getRightVertex(),
            $this->edges
        );
    }

    /**
     * @param vertex $leftVertex
     *
     * @return vertex|null
     */
    public function getRightByLeft($leftVertex)
    {
        foreach ($this->edges as $edge) {
            if ($edge->getLeftVertex() != $leftVertex) {
                continue;
            }

            return $edge->getRightVertex();
        }

        return null;
    }

    /**
     * @param vertex $rightVertex
     *
     * @return vertex|null
     */
    public function getLeftByRight($rightVertex)
    {
        foreach ($this->edges as $edge) {
            if ($edge->getRightVertex() != $rightVertex) {
                continue;
            }

            return $edge->getLeftVertex();
        }

        return null;
    }
}
