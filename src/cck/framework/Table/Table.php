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

namespace JBZoo\CCK\Table;

use JBZoo\CrossCMS\AbstractDatabase;
use JBZoo\CCK\App;
use JBZoo\SqlBuilder\Query\Delete;
use JBZoo\SqlBuilder\Query\Insert;
use JBZoo\SqlBuilder\Query\Replace;
use JBZoo\SqlBuilder\Query\Select;
use JBZoo\SqlBuilder\Query\Union;
use JBZoo\Utils\Dates;

/**
 * Class Table
 * @package JBZoo\CCK
 */
abstract class Table
{
    /**
     * @var App
     */
    public $app;

    /**
     * @var string
     */
    public $entity = 'stdClass';

    /**
     * @var AbstractDatabase
     */
    protected $_db;

    /**
     * @var string
     */
    protected $_table = '';

    /**
     * @var string
     */
    protected $_key = 'id';

    /**
     * @var string
     */
    protected $_dbNow = '';

    /**
     * @var string
     */
    protected $_dbNull = '0000-00-00 00:00:00';

    /**
     * A list of the objects created from the records fetched from the database
     * @var array
     */
    protected $_objects = [];

    /**
     * Table constructor.
     *
     * @param string $name
     * @param string $key
     */
    public function __construct($name = '', $key = 'id')
    {
        $this->app = App::getInstance();
        $this->_db = $this->app['db'];

        $this->_key   = $key;
        $this->_table = $name;
        $this->_dbNow = $this->_db->quote(Dates::sql(time()), false);
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->_table;
    }

    /**
     * @param array $rowData
     * @return mixed
     */
    protected function _fetchObject($rowData)
    {
        $keyName = $this->_key;
        $class   = $this->entity;

        // Check store
        if (isset($rowData[$keyName]) && isset($this->_objects[$rowData[$keyName]])) {
            return $this->_objects[$rowData[$keyName]];
        }

        // Create new object (todo: check performance)
        $object = new $class($this->app);
        foreach ($rowData as $propName => $propValue) {
            if (property_exists($object, $propName)) {
                $object->$propName = $propValue;
            }
        }

        // Save to memory store (cache it)
        if ($object->$keyName && !key_exists($object->$keyName, $this->_objects)) {
            $this->_objects[$object->$keyName] = $object;
        }

        return $object;
    }

    /**
     * @param $rows
     * @return array
     */
    protected function _fetchObjectList($rows)
    {
        $result = [];
        foreach ($rows as $row) {
            $result[] = $this->_fetchObject($row);
        }

        return $result;
    }

    /**
     * Remove record from database table
     *
     * @param $id
     * @return bool|int
     */
    public function remove($id)
    {
        $sql = $this->_delete()
            ->where($this->_key . ' = ?s', $id);

        $this->unsetObject($id);

        return $this->_db->query($sql);
    }

    /**
     * Remove record from database table
     *
     * @param $id
     * @return bool|int
     */
    public function getById($id)
    {
        if ($this->hasObject($id)) {
            return $this->_objects[$id];
        }

        $sql = $this->_select()
            ->where($this->_key . ' = ?s', $id);

        $row    = $this->_db->fetchRow($sql);
        $object = $this->_fetchObject($row);

        return $object;
    }

    /**
     * Removes the object from the internal object storage.
     * @param string $key The key of the object to be removed
     */
    public function unsetObject($key)
    {
        if ($this->hasObject($key)) {
            unset($this->_objects[$key]);
        }
    }

    /**
     * Checks if the object is already managed by the table.
     * @param string $key The key of the object
     * @return bool
     */
    public function hasObject($key)
    {
        return isset($this->_objects[$key]);
    }

    /**
     * Clean all cached objects
     */
    public function cleanObjects()
    {
        $this->_objects = [];
    }

    /**
     * @param string $tableName
     * @param null   $alias
     * @return Select
     */
    protected function _select($tableName = null, $alias = null)
    {
        if (null === $tableName) {
            $tableName = $this->_table;
        }

        return new Select($tableName, $alias);
    }

    /**
     * @param string $tableName
     * @return Replace
     */
    protected function _replace($tableName = null)
    {
        if (null === $tableName) {
            $tableName = $this->_table;
        }

        return new Replace($tableName);
    }

    /**
     * @param string $tableName
     * @return Insert
     */
    protected function _insert($tableName = null)
    {
        if (null === $tableName) {
            $tableName = $this->_table;
        }

        return new Insert($tableName);
    }

    /**
     * @param string $tableName
     * @param null   $alias
     * @return Delete
     */
    protected function _delete($tableName = null, $alias = null)
    {
        if (null === $tableName) {
            $tableName = $this->_table;
        }

        return new Delete($tableName, $alias);
    }

    /**
     * @return Union
     */
    protected function _union()
    {
        return new Union();
    }
}
