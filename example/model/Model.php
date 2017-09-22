<?php
/**
 * Created by PhpStorm.
 * User: JimmDiGriz
 * Date: 22.09.2017
 * Time: 11:48
 */

namespace jimmdigriz\jsom\example\model;

class Model
{
    public function __get($name)
    {
        $getterName = 'get' . ucfirst($name);

        if (method_exists($this, $getterName)) {
            return $this->{$getterName}();
        }

        return null;
    }

    public function __set($name, $value)
    {
        $setterName = 'set' . ucfirst($name);

        if (method_exists($this, $setterName)) {
            $this->{$setterName}($value);
        }
    }
}