<?php

namespace Odan\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Scalar\MagicConst;
use PhpParser\NodeFinder;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @implements Rule<Node\Stmt\If_>
 */
class YodaConditionRule implements Rule
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
        $nodes = $this->nodeFinder->findInstanceOf($node->cond, BinaryOp::class);

        $errors = [];

        /** @var BinaryOp $expr */
        foreach ($nodes as $expr) {
            if ($expr->left instanceof MagicConst) {
                continue;
            }

            // ConstFetch: true, false, null
            // Scalar: string, bool, int etc
            if (
                $expr->left instanceof ConstFetch ||
                $expr->left instanceof Node\Scalar
            ) {
                $errors[] = 'Yoda condition is not allowed.';
            }
        }

        return $errors;
    }
}
