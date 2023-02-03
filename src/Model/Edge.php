<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Model;

/**
 * Matching returned using these objects
 *
 * @template TLeftVertex of object|string|int
 * @template TRightVertex of object|string|int
 */
class Edge
{
    /**
     * @var TLeftVertex
     */
    private object|string|int $leftVertex;

    /**
     * @var TRightVertex
     */
    private object|string|int $rightVertex;

    /**
     * @param TLeftVertex  $leftVertex
     * @param TRightVertex $rightVertex
     */
    public function __construct($leftVertex, $rightVertex)
    {
        $this->leftVertex = $leftVertex;
        $this->rightVertex = $rightVertex;
    }

    /**
     * @return TLeftVertex
     */
    public function getLeftVertex()
    {
        return $this->leftVertex;
    }

    /**
     * @return TRightVertex
     */
    public function getRightVertex()
    {
        return $this->rightVertex;
    }
}
