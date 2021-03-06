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

use JBZoo\CCK\Entity\Item;

/**
 * Class AtomItems_Test
 */
class AtomItems_Test extends JBZooPHPUnit
{
    protected $_fixtureFile = 'AtomItems_TableItemTest.php';

    public function testSaveItemAction()
    {
        $uniqueName = uniqid('name-');

        $request = [
            'item' => [
                'name' => $uniqueName
            ]
        ];

        $response = $this->helper->requestAdmin('items.index.saveItem', $request, 'PAYLOAD');

        /** @var Item $newItem */
        $newItem = $this->app['models']['item']->get($response->find('item.id'));
        isSame($uniqueName, $response->find('item.name'));
        isSame($uniqueName, $newItem->name);

        $this->app['events']->getManager()->removeListeners('entity.item.save.before');
        $this->app['events']->getManager()->removeListeners('entity.item.save.save');
    }

    public function testGetItem()
    {
        $response = $this->helper->requestAdmin('items.index.getItem', ['id' => 2], 'PAYLOAD');

        is($response->find('item.id'), 2);
    }

    public function testRemoveItemAction()
    {
        /** @var array(Data) $results */
        $results = $this->helper->requestAdminBatch([ // experimental
            ['items.index.saveItem', ['item' => []], 'PAYLOAD'],
            ['items.index.removeItem', ['id' => 2], 'PAYLOAD'],
            ['items.index.removeItem', ['id' => 100500], 'PAYLOAD']
        ]);

        // Check first request
        /** @var Item $newItem */
        $newId = $results[0]->find('item.id');
        isTrue($newId > 0);
        $newItem = $this->app['models']['item']->get($newId);
        isTrue($newItem);

        // Remove exists item
        is(2, $results[1]->find('removed'));
        $this->app['models']['item']->cleanObjects();
        $newItem = $this->app['models']['item']->get(2);
        isFalse($newItem);

        // Remove undefined item
        is(0, $results[2]->find('removed'));
    }

    public function testGetListAction()
    {
        $response = $this->helper->requestAdmin('items.index.getList');

        isTrue(is_array($response->find('list')));
    }

    public function testGetNewItemAction()
    {
        $response = $this->helper->requestAdmin('items.index.getNewItem');

        isTrue(is_array($response->find('item')));
    }
}
