<?php

/*
 *
 *  ____  _             _         _____
 * | __ )| |_   _  __ _(_)_ __   |_   _|__  __ _ _ __ ___
 * |  _ \| | | | |/ _` | | '_ \    | |/ _ \/ _` | '_ ` _ \
 * | |_) | | |_| | (_| | | | | |   | |  __/ (_| | | | | | |
 * |____/|_|\__,_|\__, |_|_| |_|   |_|\___|\__,_|_| |_| |_|
 *                |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  Blugin team
 * @link    https://github.com/Blugin
 * @license https://www.gnu.org/licenses/lgpl-3.0 LGPL-3.0 License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace blugin\lib\invmenu\responsive\slot;

use pocketmine\inventory\BaseInventory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

class SyncSlot extends ResponsiveSlot{
    /** @var BaseInventory */
    protected $inventory;

    /** @var int */
    protected $slot;

    public function __construct(BaseInventory $inventory, int $slot){
        $this->inventory = $inventory;
        $this->slot = $slot;
    }

    public function getItem() : ?Item{
        return $this->inventory->getItem($this->slot);
    }

    public function setItem(?Item $item) : void{
        $this->inventory->setItem($this->slot, $item ?? ItemFactory::get(Item::AIR, 0, 0));
    }

    public function getInventory() : BaseInventory{
        return $this->inventory;
    }

    public function getSlot() : int{
        return $this->slot;
    }
}
