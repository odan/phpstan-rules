<?php

namespace Odan\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<ClassMethod>
 */
final class CyclomaticComplexityRule implements Rule
{
    private int $maxComplexity;

    public function __construct(int $maxComplexity)
    {
        $this->maxComplexity = $maxComplexity;
    }

    public function getNodeType(): string
    {
        return ClassMethod::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->stmts === null) {
            return []; // Abstract method or interface
        }

        $visitor = new class extends NodeVisitorAbstract {
            public int $complexity = 1;

            public function enterNode(Node $node)
            {
                if (
                    $node instanceof Node\Stmt\If_
                    || $node instanceof Node\Stmt\For_
                    || $node instanceof Node\Stmt\Foreach_
                    || $node instanceof Node\Stmt\While_
                    || $node instanceof Node\Stmt\Do_
                    || $node instanceof Node\Stmt\Case_
                    || $node instanceof Node\Stmt\Catch_
                    || $node instanceof Node\Expr\BinaryOp\LogicalAnd
                    || $node instanceof Node\Expr\BinaryOp\LogicalOr
                    || $node instanceof Node\Expr\Ternary
                    || $node instanceof Node\Expr\BinaryOp\BooleanAnd
                    || $node instanceof Node\Expr\BinaryOp\BooleanOr
                ) {
                    $this->complexity++;
                }
            }
        };

        $traverser = new NodeTraverser();
        $traverser->addVisitor($visitor);
        $traverser->traverse($node->stmts);

        if ($visitor->complexity > $this->maxComplexity) {
            return [
                RuleErrorBuilder::message(sprintf(
                    'Cyclomatic complexity of %d exceeds the configured maximum of %d.',
                    $visitor->complexity,
                    $this->maxComplexity
                ))->build()
            ];
        }

        return [];
    }
}
