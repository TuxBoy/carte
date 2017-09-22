<?php
namespace App\Trade\Entity;

use Core\Annotation\Set;
use Core\Entity;
use Core\Tools\HasName;

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