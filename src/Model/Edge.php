<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp\Model;

/**
 * Matching returned using these objects
 */
class Edge
{
    /**
     * @var vertex
     */
    private $leftVertex;

    /**
     * @var vertex
     */
    private $rightVertex;

    /**
     * @param vertex $leftVertex
     * @param vertex $rightVertex
     */
    public function __construct($leftVertex, $rightVertex)
    {
        $this->leftVertex = $leftVertex;
        $this->rightVertex = $rightVertex;
    }

    /**
     * @return vertex
     */
    public function getLeftVertex()
    {
        return $this->leftVertex;
    }

    /**
     * @return vertex
     */
    public function getRightVertex()
    {
        return $this->rightVertex;
    }
}
