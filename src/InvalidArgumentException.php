<?php

declare(strict_types=1);

namespace Motley\HopcroftKarp;

use InvalidArgumentException as BaseInvalidArgumentException;

/**
 * Thrown when the submitted graph is not bipartite
 */
class InvalidArgumentException extends BaseInvalidArgumentException
{
}
