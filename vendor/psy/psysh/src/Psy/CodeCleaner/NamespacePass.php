<?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Namespace_;
use Psy\CodeCleaner;

/**
 * Provide implicit namespaces for subsequent execution.
 *
 * The namespace pass remembers the last standalone namespace line encountered:
 *
 *     namespace Foo\Bar;
 *
 * ... which it then applies implicitly to all future evaluated code, until the
 * namespace is replaced by another namespace. To reset to the top level
 * namespace, enter `namespace {}`. This is a bit ugly, but it does the trick :)
 */
class NamespacePass extends CodeCleanerPass
{
    private $namespace = null;
    private $cleaner;

    /**
     * @param CodeCleaner $cleaner
     */
    public function __construct(CodeCleaner $cleaner)
    {
        $this->cleaner = $cleaner;
    }

    /**
     * If this is a standalone namespace line, remember it for later.
     *
     * Otherwise, apply remembered namespaces to the code until a new namespace
     * is encountered.
     *
     * @param array $nodes
     */
    public function beforeTraverse(array $nodes)
    {
        if (empty($nodes)) {
            return $nodes;
        }

        $last = end($nodes);
        if (!$last instanceof Namespace_) {
            return $this->namespace ? array(new Namespace_($this->namespace, $nodes)) : $nodes;
        }

        $this->setNamespace($last->name);

        return $nodes;
    }

    /**
     * Remember the namespace and (re)set the namespace on the CodeCleaner as
     * well.
     *
     * @param null|Name $namespace
     */
    private function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        $this->cleaner->setNamespace($namespace === null ? null : $namespace->parts);
    }
}
