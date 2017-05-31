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
 * Simple Offer Datetime Model & Manager
 * Class Datetime
 * @todo think about de-normalization of this table - split into datetime and offer_datetime
 *
 * @package APP\Model\Offer
 */
class Datetime extends Model
{
    public $offer_id;
    public $datetime;
    public $duration;

    /**
     * Simple Datetime Fetcher by offers ids
     * @todo set up and use replica
     * @todo build indexes on used columns
     * @todo cache.. (cache lists results and each entity, if we are using multi get/set cache..)
     * @todo use nice rdbms manager... (Symfony or even Laravel layers much better)
     *
     * @param array $offersIds
     * @param RDBMS $rdbms
     * @return array[] - arrays with keys: offer_id, datetimes(concatenated with ','), durations (with ',')
     */
    public static function readByOffersIds(array $offersIds, RDBMS $rdbms)
    {
        return $rdbms->make(join(' ', array(
            'SELECT ' . join(', ', array(
                $rdbms->quote('offer_id'),
                'GROUP_CONCAT(' . $rdbms->quote('datetime') . ') AS ' . $rdbms->quote('datetimes'),
                'GROUP_CONCAT(' . $rdbms->quote('duration') . ') AS ' . $rdbms->quote('durations')
            )),
            'FROM ' . $rdbms->quote('offer_datetime'),
            //@todo use bind params (prepared statements, for caching query templates)
            'WHERE ' . $rdbms->quote('offer_id') . ' IN (' . join(', ', $offersIds) . ')',
            'GROUP BY ' . $rdbms->quote('offer_id')
        )))->getAffectedRows();
    }
}