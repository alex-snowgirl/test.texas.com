<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 1:06 AM
 */
namespace APP\Model;

use APP\Model\Offer\Datetime;
use CORE\Model;
use CORE\RDBMS;
use APP\Model\Offer\Rating;
use APP\Model\Offer\Professor as ProfessorOffer;

/**
 * Simple Offer Model & Manager
 * @todo think about unique keys...
 *
 * Class Offer
 * @package APP\Model
 * @property mixed $user_mark
 * @property mixed $datetime
 * @property mixed $professor
 * @todo pass IDs only, professors should be passed separately outside of this Entity
 * @property array $professor_id_to_name
 * @property array $datetime_to_duration
 */
class Offer extends Model
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $rating = 0;
    public $vote_count = 0;

    /**
     * Simple Offers Fetcher for Catalog List
     * @todo implement JOINS and compare performance on Big Data
     * @todo sorting... (order by)
     * @todo pagination... (limit)
     * @todo set up and use replica
     * @todo build indexes on used columns ..force them if needed
     * @todo cache.. (cache lists results and each entity, especially if we are using multi get/set cache..)
     * @todo split into several functions..
     * @todo use nice rdbms manager... (Symfony or even Laravel layers much better) !!!!
     * @todo check by EXPLAIN and optimize...
     *
     * @param Offer $offer
     * @param User $user
     * @param array $sort
     * @param array $limit
     * @param RDBMS $rdbms
     * @return Offer[]
     */
    public static function readForCatalogList(Offer $offer, User $user, array $sort = null, array $limit = null, RDBMS $rdbms)
    {
        /** @var Offer[] $offers */
//        if ($sort || $limit) {
//            $offers = static::readWithOrderWithLimit($offer, $sort, $limit, $rdbms);
//        } else {
            $offers = parent::read($offer, $rdbms);
//        }

        $offers = static::mapAsKeyToItem($offers);

        $offersIds = array_keys($offers);

        $offersProfessors = ProfessorOffer::readByOffersIdsAddNames($offersIds, $rdbms);
        $offersProfessors = static::mapAsKeyToItem($offersProfessors, 'offer_id');

        $offersDateTimes = Datetime::readByOffersIds($offersIds, $rdbms);
        $offersDateTimes = static::mapAsKeyToItem($offersDateTimes, 'offer_id');

        $rating = new Rating(array('user_id' => $user->id));
        $userRatings = Rating::read($rating, $rdbms);
        $userRatings = static::mapAsKeyToItem($userRatings, 'offer_id');

        foreach ($offers as $offer) {
            if (isset($offersProfessors[$offer->id])) {
                /**
                 * For simplicity we pass duplicate data
                 */
                //@todo pass IDs only, professors data should be passed separately
                $offer->professor_id_to_name = array_combine(
                    explode(',', $offersProfessors[$offer->id]['professor_ids']),
                    explode(',', $offersProfessors[$offer->id]['professor_names'])
                );
            }

            if (isset($offersDateTimes[$offer->id])) {
                //@todo pass IDs only, datetime data should be passed separately
                $offer->datetime_to_duration = array_combine(
                    explode(',', $offersDateTimes[$offer->id]['datetimes']),
                    explode(',', $offersDateTimes[$offer->id]['durations'])
                );
            }

            if (isset($userRatings[$offer->id])) {
                $offer->user_mark = $userRatings[$offer->id]->mark;
            }
        }

        return $offers;
    }

    /**
     * Simple Fetcher with Order ans Limit
     * @todo...
     * @todo use nice rdbms layer with builders and other nice stuff...
     * @todo add indexes.. and force if needed
     * @todo use replica...
     * @todo cache list ids.. cache offers...
     *
     * @param Offer $offer
     * @param array|null $sort - as array(sort_by => sort_dir), sort_dir: SORT_ASC or SORT_DESC
     * @param array|null $limit - as array(page => per_page)
     * @param RDBMS $rdbms
     * @return array
     */
    public static function readWithOrderWithLimit(Offer $offer, array $sort = null, array $limit = null, RDBMS $rdbms)
    {
        $where = self::makeArray($offer, false, null);

        $bind = array();

        return static::makeItems($rdbms->make(join(' ', array(
            'SELECT *',
            'FROM ' . $rdbms->quote('offer'),
            ($tmp = $rdbms->makeWhereClauseQuery($where, $bind)) ? ('WHERE ' . $tmp) : '',
        )))->getAffectedRows());
    }
}