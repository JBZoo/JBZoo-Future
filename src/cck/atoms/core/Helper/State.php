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

namespace JBZoo\CCK\Atom\Core\Helper;

use JBZoo\CCK\Atom\Helper;
use JBZoo\Data\PHPArray;

/**
 * Class State
 * @package JBZoo\CCK
 */
class State extends Helper
{
    /**
     * @return array
     */
    public function getInitDefines()
    {
        return [
            'AJAX_URL' => JBZOO_AJAX_URL,
            '__DEV__'  => $this->app['config']->isDebug()
        ];
    }

    /**
     * @return array
     */
    public function getSidebar()
    {

        $atomList = $this->app['atoms']->load('*');

        $result = [];
        /** @var PHPArray $atomInfo */
        foreach ($atomList as $atomInfo) {
            if ($sideBar = $atomInfo->get('admin-sidebar')) {
                $result = array_merge($result, $sideBar);
            }
        }

        return $result;
    }

    /**
     * @return \stdClass
     */
    public function getState()
    {
        $result = [];

        // get configs
        $atomList   = $this->app['atoms']->load('*');
        $atomConfig = [];

        $this->app->trigger('state.init.before');

        /** @var PHPArray $atomInfo */
        foreach ($atomList as $atomId => $atomInfo) {
            $atomInfo->remove('init');
            $atomInfo->remove('dir');
            if ($atomCfg = $atomInfo->get('config')) {
                $atomId = 'atom.' . $atomId;
                $stored = jbdata($this->app['core.config']->get($atomId));

                foreach ($atomCfg as $name => $field) {
                    if ($field['type'] == 'group') {
                        foreach ($field['childs'] as $childName => $childField) {
                            $default = isset($childField['default']) ? $childField['default'] : null;
                            $value   = $stored->find($name . '.' . $childName, $default);

                            $atomConfig[$atomId][$name][$childName] = $value;
                        }

                    } else {
                        $default = isset($childField['default']) ? $childField['default'] : null;
                        $value   = $stored->get($name, $default);

                        $atomConfig[$atomId][$name] = $value;
                    }
                }
            }
        }

        $result['config'] = $atomConfig;

        $this->app->trigger('state.init.after', [&$result]);

        return $result;
    }
}
