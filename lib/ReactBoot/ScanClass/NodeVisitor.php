<?php

namespace ReactBoot\ScanClass;

use PhpParser;
use PhpParser\Node\Stmt;
use PhpParser\Node;

/**
 * NodeVisitor class.
 *
 * @package ReactBoot\ScanClass
 * @license MIT
 * @since  1.0
 * @author Guilherme Faht <gurus.gui@gmail.com>
 */
final class NodeVisitor extends PhpParser\NodeVisitorAbstract
{
    /**
     * @var array
     */
    protected $classes = [];

    /**
     * @return array List of classes
     */
    public function getClasses(): array
    {
        return $this->classes;
    }

    /**
     * @param string Class`name
     */
    protected function setClass($name): void
    {
        if (empty($this->classes[$name])) {
            $this->classes[$name] = $name;
        }
    }

    /**
     * @see PhpParser\NodeVisitorAbstract::leaveNode()
     */
    public function leaveNode(Node $node): void
    {
        if ($node instanceof Stmt\Class_) {
            $type = strtolower(get_class($node));
            $type = substr($type, strrpos($type, "\\") + 1, -1);
            $this->setClass($node->namespacedName->toString());
        }
    }
}
