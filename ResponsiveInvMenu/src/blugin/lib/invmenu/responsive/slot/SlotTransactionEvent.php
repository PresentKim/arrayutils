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

use blugin\lib\invmenu\responsive\ResponsiveInvMenuInventory;
use muqsit\invmenu\InvMenu;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\Player;

class SlotTransactionEvent{
    /** @var Player */
    protected $player;

    /** @var SlotChangeAction */
    protected $action;

    /** @var ResponsiveInvMenuInventory */
    protected $inventory;

    /** @var InvMenu */
    protected $menu;

    public function __construct(Player $player, SlotChangeAction $action, ResponsiveInvMenuInventory $inventory, InvMenu $menu){
        $this->player = $player;
        $this->action = $action;
        $this->inventory = $inventory;
        $this->menu = $menu;
    }

    public function getPlayer() : Player{
        return $this->player;
    }

    public function getAction() : SlotChangeAction{
        return $this->action;
    }

    public function getInventory() : ResponsiveInvMenuInventory{
        return $this->inventory;
    }

    public function getMenu() : InvMenu{
        return $this->menu;
    }

    public function getSlot() : int{
        return $this->action->getSlot();
    }

    public function getSourceItem() : Item{
        return $this->action->getSourceItem();
    }

    public function getTargetItem() : Item{
        return $this->action->getTargetItem();
    }
}
