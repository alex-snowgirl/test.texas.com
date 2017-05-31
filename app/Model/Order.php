<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 1:06 AM
 */
namespace APP\Model;

use CORE\Model;
use CORE\RDBMS;

use APP\Model\Order\Offer as OrderOffer;

/**
 * Simple Order Model & Manager
 *
 * Class Order
 * @package APP\Model
 */
class Order extends Model
{
    public $id;
    public $user_id;

    /**
     * Simple Order Creator
     * @todo validation...
     * @todo check consistency...
     *
     * @param Order $order
     * @param $offerIdToQuantity
     * @param RDBMS $rdbms
     * @return mixed
     */
    public static function createCustom(Order $order, $offerIdToQuantity, RDBMS $rdbms)
    {
        return $rdbms->makeTransaction(function (RDBMS $rdbms) use ($order, $offerIdToQuantity) {
            //create order record
            $id = static::create($order, $rdbms);

            //create order_offer records
            foreach ($offerIdToQuantity as $offerId => $quantity) {
                $orderOffer = new OrderOffer();
                $orderOffer->order_id = $id;
                $orderOffer->offer_id = $offerId;
                $orderOffer->quantity = $quantity;

                OrderOffer::create($orderOffer, $rdbms);
            }

            //update user balance
            /** @var Offer[] $offers */
            $offers = Model::read(new Offer(array('id' => array_keys($offerIdToQuantity))), $rdbms);

            $total = 0;

            foreach ($offers as $offer) {
                $total += $offer->price * $offerIdToQuantity[$offer->id];
            }

            /** @var User $user */
            $user = Model::read(new User(array('id' => $order->user_id)), $rdbms)[0];

            $user->balance -= $total;

            User::update($user, $rdbms);

            return $id;
        });
    }
}