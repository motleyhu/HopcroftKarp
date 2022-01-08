<?php

namespace Motley\HopcroftKarp\Model;

class Vertices
{
    /**
     * @var Vertex[]
     */
    private array $vertices;

    /**
     * @param Vertex[] $vertices
     */
    public function __construct(array $vertices)
    {
        $this->vertices = $vertices;
    }

    public function intersectsWith(Vertices $vertices): bool
    {
        foreach ($this->vertices as $vertex) {
            if ($vertices->hasVertex($vertex)) {
                return true;
            }
        }

        return false;
    }

    public function hasVertex(Vertex $vertex): bool
    {
        return in_array($vertex, $this->vertices);
    }
}
