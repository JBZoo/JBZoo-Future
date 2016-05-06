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

defined('JBZOO') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_jbzoo/cck/init.php';

/**
 * @param array $query
 * @return array
 */
function JBZooBuildRoute(&$query)
{
    dump($query);

    return [];
}

/**
 * @param array $segments
 * @return array
 */
function JBZooParseRoute($segments)
{
    dump($segments);

    return [];
}
