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
 * Simple Offer Professor Model & Manager
 *
 * Class Professor
 * @package APP\Model\Offer
 */
class Professor extends Model
{
    public $offer_id;
    public $professor_id;

    /**
     * Simple Professor Fetcher by offers ids
     *
     * Created this for visibility purposes
     * Better to fetch data separately (on big data & high Load)
     *
     * @todo set up and use replica
     * @todo build indexes on used columns and follow theirs order
     * @todo cache.. (cache lists results and each entity, if we are using multi get/set cache..)
     * @todo use nice rdbms manager... (Symfony or even Laravel layers much better)
     * @todo need to check if better to fetch grouped professors ids and professors separately...
     * @todo if we are under high-load - better to group on the php side...
     * @todo use normal query-builder when nice mangers available..
     *
     * @param array $offersIds
     * @param RDBMS $rdbms
     * @return array[] - arrays with keys: offer_id, professor_ids(concatenated with ','), professor_name(with ',')
     */
    public static function readByOffersIdsAddNames(array $offersIds, RDBMS $rdbms)
    {
        return $rdbms->make(join(' ', array(
            'SELECT ' . join(', ', array(
                $rdbms->quote('offer_id'),
                'GROUP_CONCAT(' . $rdbms->quote('professor_id') . ') AS ' . $rdbms->quote('professor_ids'),
                'GROUP_CONCAT(' . $rdbms->quote('name') . ') AS ' . $rdbms->quote('professor_names')
            )),
            'FROM ' . $rdbms->quote('offer_professor'),
            'INNER JOIN ' . $rdbms->quote('professor') . ' ON ' . $rdbms->quote('professor_id', 'offer_professor') . ' = ' . $rdbms->quote('id', 'professor'),
            //@todo use bind params (prepared statements, for caching query templates)
            'WHERE ' . $rdbms->quote('offer_id') . ' IN (' . join(', ', $offersIds) . ')',
            'GROUP BY ' . $rdbms->quote('offer_id')
        )))->getAffectedRows();
    }
}