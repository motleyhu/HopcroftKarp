<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp;

/**
 * Bipartite Graph providing Hopcroft-Karp algo
 */
class BipartiteGraph
{
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
    private array $dist;

    public function __construct(int $m, int $n)
    {
        $this->leftCount = $m;
        $this->rightCount = $n;
        $this->edges = array_fill(1, $m, []);
    }

    // Returns size of maximum matching
    public function hopcroftKarp(): int
    {
        $this->matchingLeft = array_fill(1, $this->leftCount, null);
        $this->matchingRight = array_fill(1, $this->rightCount, null);

        $result = 0;

        // Keep updating the result while
        // there is an augmenting path.
        while ($this->bfs()) {
            // Find a free vertex
            for ($u = 1; $u <= $this->leftCount; ++$u) {
                // If current vertex is free and there is
                // an augmenting path from current vertex
                if ($this->matchingLeft[$u] == null && $this->dfs($u)) {
                    ++$result;
                }
            }
        }

        // TODO: The actual matching is in pairU/V
        return $result;
    }

    // Returns true if there is an augmenting
    // path, else returns false
    private function bfs(): bool
    {
        // An integer queue
        $Q = [];

        // First layer of vertices (set distance as 0)
        for ($u = 1; $u <= $this->leftCount; ++$u) {
            // If this is a free vertex,
            // add it to queue
            if ($this->matchingLeft[$u] == null) {
                // u is not matched
                $this->dist[$u] = 0;
                array_push($Q, $u);
            }

            // Else set distance as infinite
            // so that this vertex is
            // considered next time
            else {
                $this->dist[$u] = PHP_INT_MAX;
            }
        }

        // Initialize distance to
        // NIL as infinite
        $this->dist[null] = PHP_INT_MAX;

        // Q is going to contain vertices
        // of left side only.
        while (!empty($Q)) {
            // Dequeue a vertex
            $u = array_shift($Q);

            // If this node is not NIL and
            // can provide a shorter path to NIL
            if ($this->dist[$u] < $this->dist[null]) {
                // Get all adjacent vertices of
                // the dequeued vertex u
                foreach ($this->edges[$u] as $i) {
                    $v = $i;

                    // If pair of v is not considered
                    // so far (v, pairV[V]) is not yet
                    // explored edge.
                    if ($this->dist[$this->matchingRight[$v]] == PHP_INT_MAX) {
                        // Consider the pair and add
                        // it to queue
                        $this->dist[$this->matchingRight[$v]] = $this->dist[$u] + 1;
                        array_push($Q, $this->matchingRight[$v]);
                    }
                }
            }
        }

        // If we could come back to NIL using
        // alternating path of distinct vertices
        // then there is an augmenting path
        return $this->dist[null] != PHP_INT_MAX;
    }

    // Returns true if there is an augmenting
    // path beginning with free vertex u
    private function dfs(?int $u): bool
    {
        if ($u != null) {
            foreach ($this->edges[$u] as $i) {
                // Adjacent to u
                $v = $i;

                // Follow the distances set by BFS
                if ($this->dist[$this->matchingRight[$v]] == $this->dist[$u] + 1) {
                    // If dfs for pair of v also returns
                    // true
                    if ($this->dfs($this->matchingRight[$v]) == true) {
                        $this->matchingRight[$v] = $u;
                        $this->matchingLeft[$u] = $v;

                        return true;
                    }
                }
            }

            // If there is no augmenting path
            // beginning with u.
            $this->dist[$u] = PHP_INT_MAX;

            return false;
        }

        return true;
    }

    // To add edge from u to v and v to u
    public function addEdge(int $u, int $v): void
    {
        // Add u to v’s list.
        $this->edges[$u][] = $v;
    }
}
