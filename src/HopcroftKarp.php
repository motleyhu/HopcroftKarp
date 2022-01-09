<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp;

use LogicException;
use Motley\HopcroftKarp\Model\Edge;
use Motley\HopcroftKarp\Model\Matching;

/**
 * Entry point
 *
 * @template TLeftVertex
 * @template TRightVertex
 */
class HopcroftKarp
{
    /**
     * @param array<array{TLeftVertex, TRightVertex|TRightVertex[]}> $edges array of 2-element arrays of left vertex and right vertex or vertices
     *
     * @return Matching<TLeftVertex, TRightVertex>
     */
    public static function matching(array $edges): Matching
    {
        /** @var array<positive-int, array<positive-int>> $resolvedEdges */
        $resolvedEdges = [];
        /** @var array<positive-int, TLeftVertex> $leftVertices */
        $leftVertices = [];
        /** @var array<positive-int, TRightVertex> $rightVertices */
        $rightVertices = [];

        foreach ($edges as $currentEdges) {
            $currentEdges = array_values($currentEdges);

            $currentLeftVertex = $currentEdges[0];
            $currentRightVertices = $currentEdges[1];
            if (!\is_array($currentRightVertices)) {
                $currentRightVertices = [$currentRightVertices];
            }

            if (!\in_array($currentLeftVertex, $leftVertices)) {
                $leftVertices[\count($leftVertices) + 1] = $currentLeftVertex;
            }
            $leftVertexIndex = array_search($currentLeftVertex, $leftVertices);
            if ($leftVertexIndex === false) {
                throw new LogicException();
            }
            if (!\array_key_exists($leftVertexIndex, $resolvedEdges)) {
                $resolvedEdges[$leftVertexIndex] = [];
            }

            foreach ($currentRightVertices as $currentRightVertex) {
                if (!\in_array($currentRightVertex, $rightVertices)) {
                    $rightVertices[\count($rightVertices) + 1] = $currentRightVertex;
                }
                $rightVertexIndex = array_search($currentRightVertex, $rightVertices);
                if ($rightVertexIndex === false) {
                    throw new LogicException();
                }
                $resolvedEdges[$leftVertexIndex][] = $rightVertexIndex;
            }
        }

        $edgesByIndex = (new BipartiteGraph($resolvedEdges))->hopcroftKarp();
        $edgesWithValues = [];
        foreach ($edgesByIndex as $leftIndex => $rightIndex) {
            $edgesWithValues[] = new Edge($leftVertices[$leftIndex], $rightVertices[$rightIndex]);
        }

        return new Matching($edgesWithValues);
    }
}
