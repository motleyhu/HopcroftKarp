<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Model;

/**
 * The resulting matching
 *
 * @template TLeftVertex of object|string|int
 * @template TRightVertex of object|string|int
 */
class Matching
{
    /**
     * @var Edge<TLeftVertex, TRightVertex>[]
     */
    private array $edges;

    /**
     * @param Edge<TLeftVertex, TRightVertex>[] $edges
     */
    public function __construct(array $edges)
    {
        $this->edges = $edges;
    }

    /**
     * @return Edge<TLeftVertex, TRightVertex>[]
     */
    public function toArray(): array
    {
        return $this->edges;
    }

    /**
     * @return TLeftVertex[]
     */
    public function getAllLeft(): array
    {
        return array_map(static fn (Edge $edge) => $edge->getLeftVertex(), $this->edges);
    }

    /**
     * @return TRightVertex[]
     */
    public function getAllRight(): array
    {
        return array_map(static fn (Edge $edge) => $edge->getRightVertex(), $this->edges);
    }

    /**
     * @param TLeftVertex $leftVertex
     *
     * @return TRightVertex|null
     */
    public function getRightByLeft($leftVertex): object|string|int|null
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
     * @param TRightVertex $rightVertex
     *
     * @return TLeftVertex|null
     */
    public function getLeftByRight($rightVertex): object|string|int|null
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
