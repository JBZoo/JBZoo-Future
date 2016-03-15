<?php
/**
 * JBZoo CCK
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   CCK
 * @license   Proprietary http://jbzoo.com/license
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      http://jbzoo.com
 */

namespace JBZoo\CCK;

defined('_JBZOO') or die;


if (!defined('JBZOO_INIT')) {
    define('JBZOO_INIT', true);

    if ($composerPath = realpath(__DIR__ . '/../../vendor/autoload.php')) {
        require_once $composerPath;
        define('JBZOO_DEV', true);

    } elseif ($composerPath = realpath(__DIR__ . '/vendor/autoload.php')) {
        require_once $composerPath;
        define('JBZOO_DEV', false);
    } else {
        throw new Exception('Composer autoload not found!');
    }

    $app = App::getInstance();
    $app->init();

    return $app;
}
