<?php
namespace App\Trade\Entity;

use TuxBoy\Annotation\Set;
use TuxBoy\Entity;
use TuxBoy\Tools\HasName;

/**
 * Class Trade
 *
 * @Set(tableName="trades")
 */
class Trade extends Entity
{
    use HasName;

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $lat;

    /**
     * @var string
     */
    public $lng;

    /**
     * @var string
     */
    public $phone;

}