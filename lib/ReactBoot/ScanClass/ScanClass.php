<?php

namespace ReactBoot\ScanClass;

use PhpParser\ParserFactory;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use RecursiveRegexIterator;

/**
 * ScanClass class.
 *
 * @package ReactBoot\ScanClass
 * @license MIT
 * @since  1.0
 * @author Guilherme Faht <gurus.gui@gmail.com>
 */
final class ScanClass
{
    /**
     * @var PhpParser\Parser The Parser instance
     */
    protected $parser;

    /**
     * @var PhpParser\NodeTraverser The NodeTraverser instance
     */
    protected $traverser;

    /**
     * @var ReactBoot\ScanClass\NodeVisitor The NodeVisitor instance
     */
    protected $visitor;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

        $this->visitor = new NodeVisitor;

        $this->traverser = new NodeTraverser;
        $this->traverser->addVisitor(new NameResolver);
        $this->traverser->addVisitor($this->visitor);
    }

    /**
     * @param string $file PHP filename.
     */
    private function parse($file): void
    {
        $stmts = $this->parser->parse(file_get_contents($file));
        $this->traverser->traverse($stmts);
    }

    /**
     * @param string $dir Directory´s name.
     * @return array List of classes.
     */
    public function scan($dir): array
    {
        $dirIterator = new RecursiveDirectoryIterator($dir);
        $recIterator = new RecursiveIteratorIterator($dirIterator);
        $regIterator = new RegexIterator($recIterator, '/^.+\.php$/i', RecursiveRegexIterator::ALL_MATCHES);

        foreach ($regIterator as $filename => $data) {
            $this->parse($filename);
        }

        return $this->visitor->getClasses();
    }
}
