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

namespace JBZoo\CCK\Atom\Core\Controller;

use JBZoo\CCK\Atom\Controller;

/**
 * Class Index
 * @package JBZoo\CCK
 */
class Index extends Controller
{
    /**
     * Index action
     */
    public function index()
    {
        $this->app['assets']->add(
            'my',
            [
                'atom-core:assets/jsx/my.jsx',
                'assets:less/admin.less',
            ],
            ['material-ui']
        );

        ?>
        <div id="jbzoo-react-app">Loading ...</div>
        <?php
    }
}
