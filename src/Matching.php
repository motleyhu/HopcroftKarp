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
}
