<?php
/**
 * Created by PhpStorm.
 * User: JimmDiGriz
 * Date: 20.09.2017
 * Time: 14:50
 */

namespace jimmdigriz\jsom;


/**
 * @property string $data
 * @property JsonModel $class
 * @property JsonModel[] $result
 */
class JsonArray
{
    public $data;
    private $class;
    private $result = [];

    /**
     * @param string $data
     * @param string $class
     */
    public function __construct($data, $class)
    {
        $this->data = $data;
        $this->class = $class;
    }

    /**
     * @return array
     */
    public function fromJson(): array
    {
        $rows = json_decode($this->data);

        $this->result = [];

        /** @noinspection ForeachSourceInspection */
        foreach ($rows as $row) {
            /**
             * @var JsonModel $temp
             */
            $temp = new $this->class;

            $temp->fromJson($row);

            $this->result[] = $temp;
        }

        return $this->result;
    }

    public function toJson()
    {
        $array = [];

        foreach ($this->result as $model) {
            $array[] = $model->toArray();
        }

        return json_encode($array);
    }
}