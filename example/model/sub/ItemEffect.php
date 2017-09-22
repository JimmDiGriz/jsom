<?php
/**
 * Created by PhpStorm.
 * User: JimmDiGriz
 * Date: 22.09.2017
 * Time: 11:22
 */

namespace jimmdigriz\jsom\example\model\sub;

use jimmdigriz\jsom\JsonModel;
use jimmdigriz\jsom\values\Types;

/**
 * @property int $type
 * @property int $value
 */
class ItemEffect extends JsonModel
{
    public $type;
    public $value;

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'type' => Types::INT,
            'value' => Types::INT,
        ];
    }
}