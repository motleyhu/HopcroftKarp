<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\ValueObject;

use Stringable;

/**
 * Represents a vertex of the bipartite graph that we are trying to find a maximum cardinality matching of
 * It is identified by a string (for now)
 */
class Vertex implements Stringable
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->id;
    }
}
