<?php

namespace Motley\HopcroftKarp;

use Motley\HopcroftKarp\Model\BipartiteGraph;
use Motley\HopcroftKarp\Model\Edge;
use Motley\HopcroftKarp\Model\Matching;
use Motley\HopcroftKarp\Model\Path;

class DoStuff
{
    public static function findMatchingOrWhatever(BipartiteGraph $graph): Matching
    {
        $matching = new Matching();

        do {
            $breadthFirstLevels = [];

            // Go from left to right at least once TODO: Can we not repeat code?
            $leftVertices = $graph->getLeftFreeVertices($matching);
            $leftToRightEdges = $graph->getEdgesFromLeftNotInMatching($leftVertices, $matching);
            $rightVertices = $leftToRightEdges->getRightVertices();

            // Then right to left and back again until we find free vertices on the right
            while (!$rightVertices->intersectsWith($graph->getRightFreeVertices($matching))) {
                $rightToLeftEdges = $graph->getEdgesFromRightInMatching($rightVertices, $matching);
                $leftVertices = $rightToLeftEdges->getLeftVertices();

                $leftToRightEdges = $graph->getEdgesFromLeftNotInMatching($leftVertices, $matching);
                $rightVertices = $leftToRightEdges->getRightVertices();
            }










            /**
             * 1. Use breadthFirstSearch: Build alternating level path, rooted at unmatched vertices in setA
             *      - get the unmatched vertices on the left side
             *          - put it on the top of our alt-level graph
             *          - all the edges from these THAT ARE NOT IN THE MATCHING
             *          - same backwards THAT ARE IN THE MATCHING
             *          - STOP WHEN it has unmatched (FREE) vertices
             * 2. Use depthFirstSearch: Augment current matching M with maximal set of vertex disjoint shortest-length paths
             *      - meaning no overlapping vertices
             *      - start from one of the ending free vertices
             *      - depth backwards, remove it
             *      - start again from the next ending free vertices AND SO ON -
             *      - take these paths and
             *          - add its edges to the matching that are missing
             *          - remove the edges from the matching that are there
             */


        // UNTIL there are no more augmenting paths
        } while (111);

        return $matching;
    }
}
