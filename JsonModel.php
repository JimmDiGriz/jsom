<?php
/**
 * Created by PhpStorm.
 * User: JimmDiGriz
 * Date: 20.09.2017
 * Time: 14:46
 */

namespace jimmdigriz\jsom;

use jimmdigriz\jsom\values\Types;

abstract class JsonModel
{
    /**
     * @return array
     */
    abstract public function fields(): array;

    /**
     * @param array $row
     */
    public function fromJson(array $row)
    {
        $fields = $this->fields();

        foreach ($fields as $field => $type) {
            $tempValue = null;

            if (isset($row->{$field})) {
                $tempValue = $row->{$field};
            }

            if (in_array($type, Types::$list, true)) {
                $method = 'to' . ucfirst($type);

                $this->{$field} = $this->{$method}($tempValue);

                continue;
            }

            if (is_subclass_of($type, self::class)) {
                $this->{$field} = $this->toModel($tempValue, $type);

                continue;
            }

            $this->{$field} = $tempValue;
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $fields = $this->fields();

        $result = [];

        foreach ($fields as $field => $type) {
            if ($this->{$field} instanceof static) {
                $result[$field] = $this->{$field}->toArray();

                continue;
            }

            $result[$field] = $this->{$field};
        }

        return $result;
    }

    /**
     * @param mixed $value
     *
     * @return int|mixed
     */
    protected function toInt($value)
    {
        if (is_int($value)) {
            return (int)$value;
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return float|mixed
     */
    protected function toFloat($value)
    {
        if (is_float($value)) {
            return (float)$value;
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return string|mixed
     */
    protected function toJson($value)
    {
        try {
            return json_encode($value);
        } catch (\Exception $ex) {
            return $value;
        }
    }

    /**
     * @param mixed $value
     *
     * @return string|mixed
     */
    protected function toString($value)
    {
        if (is_string($value)) {
            return (string)$value;
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return bool|mixed
     */
    protected function toBool($value)
    {
        if (is_bool($value)) {
            return (bool)$value;
        }

        return $value;
    }

    /**
     * @param mixed  $value
     * @param string $class
     *
     * @return JsonModel
     */
    protected function toModel($value, $class)
    {
        try {
            /**@var static $instance */
            $instance = new $class;

            $instance->fromJson($value);

            return $instance;
        } catch (\Exception $ex) {
            return $value;
        }
    }
}