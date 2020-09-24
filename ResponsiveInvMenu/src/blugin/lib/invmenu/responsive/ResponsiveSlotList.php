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

use blugin\lib\invmenu\responsive\slot\NormalItemSlot;
use blugin\lib\invmenu\responsive\slot\ResponsiveSlot;
use pocketmine\item\Item;

class ResponsiveSlotList extends \SplFixedArray{
    public function offsetGet($offset) : ?Item{
        return ($value = parent::offsetGet($offset)) instanceof ResponsiveSlot ? $value->getItem() : $value;
    }

    public function offsetSet($offset, $value) : void{
        $before = parent::offsetGet($offset);
        if($before instanceof ResponsiveSlot && !$value instanceof ResponsiveSlot){
            $before->setItem($value);
            return;
        }elseif($value instanceof Item){
            $value = new NormalItemSlot($value);
        }
        parent::offsetSet($offset, $value);
    }

    public function current() : ?Item{
        return $this[$this->key()];
    }

    public function get(int $offset) : ?ResponsiveSlot{
        return parent::offsetGet($offset);
    }

    public function getAll() : array{
        $values = [];
        for($i = 0; $i < $this->count(); ++$i){
            if(($value = parent::offsetGet($i)) !== null){
                $values[] = $value;
            }
        }
        return $values;
    }
}