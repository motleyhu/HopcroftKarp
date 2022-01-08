<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Model;

use Stringable;

/**
 * Represents a vertex of the bipartite graph that we are trying to find a maximum cardinality matching of
 * It is identified by a string (for now)
 */
class Vertex
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
}
