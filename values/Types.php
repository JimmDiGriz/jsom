<?php
/**
 * Created by PhpStorm.
 * User: JimmDiGriz
 * Date: 22.09.2017
 * Time: 10:20
 */

namespace jimmdigriz\jsom\values;

class Types
{
    public static $list = [
        self::INT,
        self::FLOAT,
        self::JSON,
        self::STRING,
        self::BOOL,
    ];

    const INT = 'int';
    const FLOAT = 'float';
    const JSON = 'json';
    const STRING = 'string';
    const BOOL = 'bool';
}