<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp;

/**
 * The resulting matching
 */
class Matching
{
    /**
     * @var array<array{vertex, vertex}>
     */
    private array $edges;

    /**
     * @param array<array{vertex, vertex}> $edges
     */
    public function __construct(array $edges)
    {
        $this->edges = $edges;
    }

    /**
     * @return array<array{vertex, vertex}>
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
            fn (array $edge) => $edge[0],
            $this->edges
        );
    }

    /**
     * @return array<vertex>
     */
    public function getAllRight(): array
    {
        return array_map(
            fn (array $edge) => $edge[1],
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
            if ($edge[0] != $leftVertex) {
                continue;
            }

            return $edge[1];
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
            if ($edge[1] != $rightVertex) {
                continue;
            }

            return $edge[0];
        }

        return null;
    }
}
