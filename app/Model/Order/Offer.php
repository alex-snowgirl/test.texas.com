<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 1:06 AM
 */
namespace APP\Model\Order;

use CORE\Model;

/**
 * Simple Order Offer Model & Manager
 *
 * Class Offer
 * @package APP\Model\Order
 */
class Offer extends Model
{
    public $order_id;
    public $offer_id;
    //@todo need to find out if this is possible (check business logic)
    public $quantity;
}