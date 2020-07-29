<?php

namespace App\Entity\Enum;

abstract class FeeType
{
    const INTERNET    = "data";
    const CALL    = "call";
    const MESSAGE    = "message";

    protected static $typeName = [
        self::INTERNET    => 'Data',
        self::CALL => 'Call',
        self::MESSAGE => 'Message'
    ];

    /**
     * @param  string $typeShortName
     * @return string
     */
    public static function getFeeTypeName($typeShortName)
    {
        if (!isset(static::$typeName[$typeShortName])) {
            return "Unknown type ($typeShortName)";
        }

        return static::$typeName[$typeShortName];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableFeeTypes()
    {
        return [
            self::INTERNET,
            self::CALL,
            self::MESSAGE
        ];
    }
}