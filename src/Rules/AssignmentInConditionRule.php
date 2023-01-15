<?php

namespace Odan\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\NodeFinder;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @implements Rule<Node\Stmt\If_>
 */
class AssignmentInConditionRule implements Rule
{
    private NodeFinder $nodeFinder;

    public function __construct()
    {
        $this->nodeFinder = new NodeFinder();
    }

    public function getNodeType(): string
    {
        return Node\Stmt\If_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $assignNode = $this->nodeFinder->findFirstInstanceOf($node->cond, Assign::class);
        if (!$assignNode instanceof Assign) {
            return [];
        }

        return ['Assignment in conditional expression is not allowed.'];
    }
}
