<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 1:06 AM
 */
namespace APP\Model\Offer;

use APP\Model\Offer;
use CORE\Model;
use CORE\RDBMS;

/**
 * Class Rating
 * @package APP\Model\Offer
 */
class Rating extends Model
{
    public $offer_id;
    public $user_id;
    public $mark;

    /**
     * Simple Rating Creator
     * @todo check marks...
     * @todo validation...
     * @todo check consistency...
     *
     * @param Model $rating
     * @param RDBMS $rdbms
     * @return bool
     */
    public static function create(Model $rating, RDBMS $rdbms)
    {
        /** @var Rating $rating */
        return $rdbms->makeTransaction(function (RDBMS $rdbms) use ($rating) {
            Model::create($rating, $rdbms);

            //update offer rating
            /** @var Offer $offer */
            $offer = Model::read(new Offer(array('id' => $rating->offer_id)), $rdbms)[0];

            $offer->rating += $rating->mark;
            $offer->vote_count += 1;

            Offer::update($offer, $rdbms);

            return true;
        });
    }
}