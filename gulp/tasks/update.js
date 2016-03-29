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

'use strict';

var gulp = require('gulp');

// Task: Update all
gulp.task('update', [
    //'update:material-ui',
    'update:react',
    'update:jbzoo-utils',
    'update:uikit',
    'update:bootstrap'
]);