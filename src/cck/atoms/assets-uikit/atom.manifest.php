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

use JBZoo\CCK\App;

return [

    'load' => function (App $app) {

        $app['assets']->register(
            'uikit',
            [
                'atom-assets-uikit:assets/js/uikit.min.js',
                'atom-assets-uikit:assets/css/uikit.min.css',
            ],
            'jquery'
        );

        $app['assets']->register(
            'uikit-cdn',
            [
                'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.2/js/uikit.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.2/css/uikit.min.css',
            ],
            'jquery'
        );
    },

];
