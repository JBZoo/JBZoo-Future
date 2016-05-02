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

import React, { Component } from 'react'

import DatePicker    from 'material-ui/DatePicker';

export default class FieldDate extends Component {

    render() {

        var defaultDate = new Date();

        if (this.props.data.default) {
            let parts = this.props.data.default.split('-');
            defaultDate = new Date(parts[0], parts[1] - 1, parts[2]);
        }

        return <DatePicker
            id={this.props.id}
            name={this.props.name}
            hintText={this.props.data.hint}
            defaultDate={defaultDate}
        />;
    }

}
