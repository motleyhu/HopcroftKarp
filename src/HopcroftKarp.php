<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp;

use LogicException;
use Motley\HopcroftKarp\Model\Edge;
use Motley\HopcroftKarp\Model\Matching;

/**
 * Entry point
 *
 * @template TLeftVertex of object|string|int
 * @template TRightVertex of object|string|int
 */
class HopcroftKarp
{
    /**
     * @param array<array{TLeftVertex, iterable<TRightVertex>}> $edges array of 2-element arrays of left vertex and right vertex or vertices
     * @param Matching<TLeftVertex, TRightVertex>|null $previousMatching
     *
     * @return Matching<TLeftVertex, TRightVertex>
     */
    public function match(array $edges, ?Matching $previousMatching = null): Matching
    {
        /** @var array<positive-int, array<positive-int>> $resolvedEdges */
        $resolvedEdges = [];
        $leftVertices = [];
        $rightVertices = [];

        foreach ($edges as $currentEdges) {
            [$currentLeftVertex, $currentRightVertices] = array_values($currentEdges);

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

        // Resolve edges from previous matching
        $resolvedPreviousMatchingEdges = [];
        foreach ($previousMatching?->toArray() ?: [] as $edge) {
            $left = $edge->getLeftVertex();
            $right = $edge->getRightVertex();

            if ($leftIndex = array_search($left, $leftVertices)) {
                $rightIndex = array_search($right, $rightVertices) ?: null;
                $resolvedPreviousMatchingEdges[$leftIndex] = $rightIndex;
            }
        }

        $edgesByIndex = (new BipartiteGraph($resolvedEdges))->hopcroftKarp($resolvedPreviousMatchingEdges);
        $edgesWithValues = [];
        foreach ($edgesByIndex as $leftIndex => $rightIndex) {
            if ($rightIndex === null) {
                continue;
            }

            $edgesWithValues[] = new Edge($leftVertices[$leftIndex], $rightVertices[$rightIndex]);
        }

        return new Matching($edgesWithValues);
    }
}
