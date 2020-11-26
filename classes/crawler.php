<?php
/**
 * @package    local_coursehybridtree
 * @copyright  2014-2020 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_coursehybridtree;

require_once __DIR__ . '/../../../config.php';

use \local_coursehybridtree\CourseHybridTree;


class crawler {

    private $verbose;
    private $maxdepth;

    /**
     *
     * @param int $verbose
     */
    function __construct(int $verbose, int $maxdepth)
    {
        $this->verbose = $verbose;
        $this->maxdepth = $maxdepth;
    }


    /**
     *
     * @param string $node
     */
    public function hybridcrawler($node='/cat0') {
        $tree = CourseHybridTree::createTree($node);

        $this->internalcrawler($tree, 'self::printnode');
    }

    /**
     *
     * @param ChtNode $node
     * @param int $maxdepth
     * @param type $callbackfn
     * @param type $extraparams
     * @return int
     */
    public function internalcrawler($node, $callbackfn, $extraparams=[]) {
        $total = 0;
        call_user_func($callbackfn, $node, $extraparams);
        $children = $node->listChildren();
        if ( count($children) == 0 ) {
            return 1;
        }
        if ( $this->maxdepth == 0  ||  $node->getAbsoluteDepth() < $this->maxdepth ) {
            foreach ($children as $child) {
                $total += $this->internalcrawler($child, $callbackfn, $extraparams);
            }
        // echo $total . "\n";
        }
        return $total;
    }

    /**
     *
     * @param ChtNode $node
     */
    private function printnode($node) {
        $this->vecho(1, $node->getAbsoluteDepth() . '.');
        $this->vecho(2, $node->getAbsolutePath() . " ")  ;
        $descendantcourses = $node->listDescendantCourses();
        $this->vecho(3, sprintf('descendants=%d (%s)', count($descendantcourses), join (' ', $descendantcourses)));
        $this->vecho(2, "\n");
    }

    private function vecho ($verbmin, $text) {
        if ($this->verbose >= $verbmin) {
            echo $text;
        }
    }

}