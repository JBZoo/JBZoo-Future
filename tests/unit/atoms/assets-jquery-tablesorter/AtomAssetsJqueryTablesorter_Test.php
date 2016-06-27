<?php
/**
 * JBZoo CCK
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package    CCK
 * @license    Proprietary http://jbzoo.com/license
 * @copyright  Copyright (C) JBZoo.com,  All rights reserved.
 * @link       http://jbzoo.com
 */

namespace JBZoo\PHPUnit;

/**
 * Class AtomAssetsJqueryTablesorter_Test
 * @package JBZoo\PHPUnit
 */
class AtomAssetsJqueryTablesorter_Test extends JBZooPHPUnit
{
    public function testJQueryTableSorter()
    {
        $result = $this->_request('test.index.assetsJQueryTableSorter');
        isContain("/jquery.js", $result->get('body'));
        isContain("/tablesorter.min.js", $result->get('body'));
        isContain("/tablesorter.min.css", $result->get('body'));
    }
}
