<?php
namespace App\User\Entity;

use TuxBoy\Annotation\Set;
use TuxBoy\Annotation\Option;
use TuxBoy;

/**
 * User
 *
 * @Set(tableName="users")
 */
class User extends TuxBoy\User\User
{

    /**
		 * @Option(placeholder="Email")
     * @var string
     */
    public $email;

}