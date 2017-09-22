<?php
/**
 * Created by PhpStorm.
 * User: JimmDiGriz
 * Date: 22.09.2017
 * Time: 11:21
 */

namespace jimmdigriz\jsom\example\model;

use jimmdigriz\jsom\example\model\sub\ItemEffect;

/**
 * @property int $id
 * @property ItemEffect $effect
 */
class Item extends Model
{
    public $id;
    private $rawEffect;

    /**
     * @return ItemEffect
     */
    public function getEffect(): ItemEffect
    {
        if (!($this->rawEffect instanceof ItemEffect)) {
            $effect = new ItemEffect();
            $effect->fromJson($this->rawEffect);

            $this->rawEffect = $effect;
        }

        return $this->rawEffect;
    }

    /**
     * @param string|ItemEffect $value
     */
    public function setEffect($value)
    {
        if ($value instanceof ItemEffect) {
            $value = json_encode($value->toArray());
        }

        $this->rawEffect = $value;
    }
}