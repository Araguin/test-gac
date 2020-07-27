<?php

namespace App\Entity;

abstract class ChargedFeesStateEnum
{
    const LOADING    = "loading";
    const LOADED    = "loaded";
    const IMPORTING = "importing";
    const IMPORTED = "imported";

    /** @var array user friendly named type */
    protected static $stateName = [
        self::LOADING    => 'Loading',
        self::LOADED => 'Loaded',
        self::IMPORTING => 'Importing',
        self::IMPORTED  => 'Imported',
    ];

    /**
     * @param  string $typeShortName
     * @return string
     */
    public static function getStateName($stateShortName)
    {
        if (!isset(static::$typeName[$stateShortName])) {
            return "Unknown type ($stateShortName)";
        }

        return static::$stateName[$stateShortName];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableStates()
    {
        return [
            self::TYPE_INFO,
            self::TYPE_WARNING,
            self::TYPE_SUCCESS,
            self::TYPE_DANGER
        ];
    }
}