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

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\item\Item;
use pocketmine\Player;

class ToggleMenuSlot extends ImmutableSlot{
    protected $menu;

    public function __construct(Item $item, InvMenu $menu){
        parent::__construct($item);
        $this->menu = $menu;
    }

    public function handleTransaction(SlotTransactionEvent $event) : InvMenuTransactionResult{
        $event->getPlayer()->removeWindow($event->getInventory());
        return $event->discard()->then(function(Player $player) : void{
            $this->getMenu()->send($player);
        });
    }

    public function getMenu() : InvMenu{
        return $this->menu;
    }

    public function setMenu(InvMenu $menu) : void{
        $this->menu = $menu;
    }
}