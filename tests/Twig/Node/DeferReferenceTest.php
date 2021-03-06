<?php
namespace Tests\Boekkooi\Bundle\TwigJackBundle\Twig\Node;

use Boekkooi\Bundle\TwigJackBundle\Twig\Node\DeferReference;

/**
 * @author Warnar Boekkooi <warnar@boekkooi.net>
 */
class DeferReferenceTest extends \Twig_Test_NodeTestCase
{
    /**
     * @covers Twig_Node_BlockReference::__construct
     */
    public function testConstructor()
    {
        $node = new DeferReference('foo', 'bar', 1);

        $this->assertEquals('foo', $node->getAttribute('name'));
        $this->assertEquals('bar', $node->getAttribute('reference'));
    }

    /**
     * @covers Twig_Node_BlockReference::compile
     * @dataProvider getTests
     */
    public function testCompile($node, $source, $environment = null)
    {
        parent::testCompile($node, $source, $environment);
    }

    public function getTests()
    {
        return array(
            array(new DeferReference('foo', 'js', 1), <<<EOF
// line 1
\$this->env->getExtension('defer')->cache('js', 'foo', \$this->renderBlock('foo', \$context, \$blocks));
EOF
            ),
        );
    }
}
