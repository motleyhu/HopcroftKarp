# HopcroftKarp

PHP implementation of the Hopcroft-Karp algorithm

## The Algorithm

The (Hopcroft–Karp algorithm)[https://en.wikipedia.org/wiki/Hopcroft%E2%80%93Karp_algorithm] is the most efficient way to find a maximum cardinality matching in a bipartite graph.

Think of applicants for jobs, each applicant has skills for a certain sub-set of the jobs, and we need to employ the maximum number of applicants to jobs.
Or scheduling appointments for a set of time slots when each person is only available at specific time slots.

## The Implementation

This is a quick and lazy implementation for now which works well for my use case. I am more than happy to improve it further as and when there is a need for that. Issues and pull requests are welcome.

## Installation

```shell
composer require motley/hopcroft-karp
```

## Usage

You have to provide a set of edges describing your biparite graph. The vertex values can be object, string or int. The edge can be one to one or one to many, or a combination of those. Example:

```php
    $matching = HopcroftKarp::matching([
        ['left1', ['right2', 'right3']],
        ['left2', 'right1'],
        ['left3', ['right2']],
        ['left4', ['right2']],
        ['left4', 'right4'],
    ]);
```
The resulting matching object has a few helper methods to inspect it.

```php
$matching->toArray(); // [['left1', 'right3'], ['left2', 'right1'], ['left3', 'right2'], ['left4', 'right4']]
$matching->getRightForLeft('left2'); // 'right1'
$matching->getRightForLeft('unmatched'); // null
```

## Contributions

Issues and pull requests are welcome.
