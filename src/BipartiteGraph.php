<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp;

/**
 * Bipartite Graph providing Hopcroft-Karp algo
 */
class BipartiteGraph
{
    private const INF = PHP_INT_MAX;

    // The number of vertices on each side
    private int $leftCount;
    private int $rightCount;

    /**
     * Keyed by left index, values are right indices
     * 0 is used for dummy vertex
     *
     * @var array<int, array<int>>
     */
    private array $edges;

    /**
     * Edges in matching, keyed by left index, value is right index
     *
     * @var array<int, int|null>
     */
    private array $matchingLeft = [];

    /**
     * Edges in matching, keyed by right index, value is left index
     *
     * @var array<int, int|null>
     */
    private array $matchingRight = [];

    /**
     * Distance of left vertices
     * dist[u] is one more than dist[u'] if u is next to u' in augmenting path
     *
     * @var array<int|'', int|null>
     */
    private array $distance;

    public function __construct(int $leftCount, int $rightCount)
    {
        $this->leftCount = $leftCount;
        $this->rightCount = $rightCount;
        $this->edges = array_fill(1, $leftCount, []);
    }

    public function addEdge(int $leftVertex, int $rightVertex): void
    {
        $this->edges[$leftVertex][] = $rightVertex;
    }

    /**
     * Returns size of maximum matching
     */
    public function hopcroftKarp(): int
    {
        $this->matchingLeft = array_fill(1, $this->leftCount, null);
        $this->matchingRight = array_fill(1, $this->rightCount, null);

        $matchingSize = 0;

        // Keep updating the result while there is an augmenting path.
        while ($this->breadthFirstSearch()) {
            // Find a free vertex
            for ($leftVertex = 1; $leftVertex <= $this->leftCount; ++$leftVertex) {
                if ($this->matchingLeft[$leftVertex] != null) {
                    // Not a free vertex
                    continue;
                }

                if (!$this->depthFirstSearch($leftVertex)) {
                    // There is no augmenting path from current vertex
                    continue;
                }

                ++$matchingSize;
            }
        }

        // TODO: The actual matching is in pairU/V
        return $matchingSize;
    }

    /**
     * Returns whether there is an augmenting path
     */
    private function breadthFirstSearch(): bool
    {
        $queue = [];

        // First layer of vertices (set distance as 0)
        for ($leftVertex = 1; $leftVertex <= $this->leftCount; ++$leftVertex) {
            // If this is a free vertex, add it to queue
            if ($this->matchingLeft[$leftVertex] == null) {
                // This vertex is not matched
                $this->distance[$leftVertex] = 0;
                array_push($queue, $leftVertex);
            } else {
                // Else set distance as infinite so that this vertex is considered next time
                $this->distance[$leftVertex] = self::INF;
            }
        }

        $this->distance[null] = self::INF;

        // Queue is going to contain vertices of left side only.
        while (!empty($queue)) {
            $leftVertex = array_shift($queue);

            // If this node is not null and can provide a shorter path to null
            if ($this->distance[$leftVertex] < $this->distance[null]) {
                // Get all adjacent vertices of the dequeued vertex
                foreach ($this->edges[$leftVertex] as $rightVertex) {
                    // If pair of v is not considered
                    // so far (v, pairV[V]) is not yet
                    // explored edge.
                    if ($this->distance[$this->matchingRight[$rightVertex]] == self::INF) {
                        // Consider the pair and add
                        // it to queue
                        $this->distance[$this->matchingRight[$rightVertex]] = $this->distance[$leftVertex] + 1;
                        array_push($queue, $this->matchingRight[$rightVertex]);
                    }
                }
            }
        }

        // If we could come back to NIL using
        // alternating path of distinct vertices
        // then there is an augmenting path
        return $this->distance[null] != self::INF;
    }

    // Returns true if there is an augmenting
    // path beginning with free vertex u
    private function depthFirstSearch(?int $leftVertex): bool
    {
        if ($leftVertex == null) {
            return true;
        }

        foreach ($this->edges[$leftVertex] as $rightVertex) {
            // Follow the distances set by BFS
            if ($this->distance[$this->matchingRight[$rightVertex]] !== $this->distance[$leftVertex] + 1) {
                continue;
            }

            // If dfs for pair of v also returns true
            if ($this->depthFirstSearch($this->matchingRight[$rightVertex])) {
                $this->matchingRight[$rightVertex] = $leftVertex;
                $this->matchingLeft[$leftVertex] = $rightVertex;

                return true;
            }
        }

        // If there is no augmenting path
        // beginning with u.
        $this->distance[$leftVertex] = self::INF;

        return false;
    }
}
