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

import { injectAsyncReducer } from '../../../core/assets/jsx/store/configureStore';

var AtomsApp;

module.exports.default = function (reducerRegistry, atomKey) {

    var reducers = require('./reducers');

    reducerRegistry.register({
        atomsForms: reducers.default,
        config    : reducers.changeOption
    });

    return {
        path: 'atoms',
        getComponent(nextState, callback) {

            if (!AtomsApp) {
                AtomsApp = require('./AtomsApp');
            }

            callback(null, AtomsApp);
        }
    }
};
