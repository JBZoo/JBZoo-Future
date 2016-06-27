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
 * Class AtomAssetsMaterialize_Test
 * @package JBZoo\PHPUnit
 */
class AtomAssetsMaterialize_Test extends JBZooPHPUnit
{
    public function testMaterialize()
    {
        $result = $this->_request('test.index.assetsMaterialize');
        isContain("materialize.min.css", $result->get('body'));
        isContain("materialize.min.js", $result->get('body'));
        isContain("family=Material+Icons", $result->get('body'));
        isContain("/jquery.js", $result->get('body'));
    }
}
