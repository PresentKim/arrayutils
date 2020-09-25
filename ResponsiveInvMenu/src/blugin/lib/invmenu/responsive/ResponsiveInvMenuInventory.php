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

namespace blugin\lib\invmenu\responsive;

use blugin\lib\invmenu\responsive\slot\ResponsiveSlot;
use blugin\lib\invmenu\responsive\slot\SlotTransactionEvent;
use muqsit\invmenu\inventory\InvMenuInventory;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\metadata\MenuMetadata;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;

class ResponsiveInvMenuInventory extends InvMenuInventory{
    /** @var InvMenu|null */
    protected $bindedMenu = null;

    public function __construct(MenuMetadata $menu_metadata){
        parent::__construct($menu_metadata);
        $this->slots = new ResponsiveSlotList($this->getSize());
    }

    public function getSlotList() : ResponsiveSlotList{
        return $this->slots;
    }

    /** @return ResponsiveSlot[] */
    public function getAllSlot() : array{
        return $this->slots->getAll();
    }

    public function getSlot(int $index) : ?ResponsiveSlot{
        return $this->slots->get($index);
    }

    public function setSlot(int $index, ResponsiveSlot $slot) : void{
        $this->slots[$index] = $slot;
    }

    public function bind(InvMenu $menu) : void{
        $this->bindedMenu = $menu;
    }

    public function getListener() : \Closure{
        return function(InvMenuTransaction $transaction){ return $this->onTransaction($transaction); };
    }

    /**
     * @param InvMenuTransaction $transaction
     *
     * Must return an InvMenuTransactionResult instance.
     * Return $transaction->continue() to continue the transaction.
     * Return $transaction->discard() to cancel the transaction.
     *
     * @return InvMenuTransactionResult
     */
    public function onTransaction(InvMenuTransaction $transaction) : InvMenuTransactionResult{
        $event = new SlotTransactionEvent($transaction, $this, $this->bindedMenu);
        $slot = $this->getSlot($event->getSlot());
        if($slot !== null){
            $result = $slot->handleTransaction($event);
            if($result->isCancelled()){
                $player = $event->getPlayer();
                $player->getCursorInventory()->sendSlot(0, $player);
            }
            return $result;
        }
        return $transaction->continue();
    }
}
