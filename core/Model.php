<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 1:27 PM
 */
namespace CORE;

/**
 * Simple Model class
 * Simple Model Manager Class
 *
 * Very simple, coz written in a hurry(!)
 *
 * @todo split...
 * @todo improve...
 *
 * Class Model
 * @package CORE
 * @property integer $id
 */
abstract class Model extends ConfigurableObject
{
    /**
     * Simple Model Creator
     *
     * @param Model $model
     * @param RDBMS $rdbms
     * @return mixed
     */
    public static function create(Model $model, RDBMS $rdbms)
    {
        $table = self::makeTable($model);
        $values = self::makeArray($model, 'id');
        return $rdbms->create($table, $values);
    }

    /**
     * Simple Models Fetcher
     *
     * @param Model $model
     * @param RDBMS $rdbms
     * @return Model|Model[]
     */
    public static function read(Model $model, RDBMS $rdbms)
    {
        $table = self::makeTable($model);
        $where = self::makeArray($model, false, null);
        $source = $rdbms->read($table, $where);
        return $model::makeItems($source);
    }

    /**
     * Simple Model Updater
     *
     * @param Model $model
     * @param RDBMS $rdbms
     * @return mixed
     */
    public static function update(Model $model, RDBMS $rdbms)
    {
        $table = self::makeTable($model);
        $values = self::makeArray($model, 'id');
        $where = array('id' => $model->id);
        return $rdbms->update($table, $values, $where);
    }

    /**
     * Simple Model Deleter
     *
     * @param Model $model
     * @param RDBMS $rdbms
     * @return mixed
     */
    public static function delete(Model $model, RDBMS $rdbms)
    {
        $table = self::makeTable($model);
        $where = array('id' => $model->id);
        return $rdbms->delete($table, $where);
    }

    /**
     * Factory method - from request
     *
     * @param Request $request
     * @return Model
     */
    public static function makeFromRequest(Request $request)
    {
        $model = new static;

        foreach ($model as $k => $v) {
            if (isset($request->$k)) {
                $model->$k = $request->$k;
            }
        }

        return $model;
    }

    protected static function makeTable(Model $model)
    {
        return strtolower(join('_', explode('\\', str_replace('APP\\Model\\', '', get_class($model)))));
    }

    protected static function makeArray(Model $model, $skipKeys = false, $skipValues = false)
    {
        $output = (array)$model;

        if (false !== $skipKeys) {
            if (!is_array($skipKeys)) {
                $skipKeys = array($skipKeys);
            }

            $output = array_filter($output, function ($key) use ($skipKeys) {
                return !in_array($key, $skipKeys);
            }, ARRAY_FILTER_USE_KEY);
        }

        if (false !== $skipValues) {
            if (!is_array($skipValues)) {
                $skipValues = array($skipValues);
            }

            $output = array_filter($output, function ($value) use ($skipValues) {
                return !in_array($value, $skipValues);
            });
        }

        return $output;
    }

    /**
     * Simple Universal Key Mapper
     *
     * @param array|Model[] $models
     * @param string $key
     * @return Model[]
     */
    public static function mapAsKeyToItem($models, $key = 'id')
    {
        if (!$models) {
            return array();
        }

        $ids = array();

        foreach ($models as $model) {
            $ids[] = is_array($model) ? $model[$key] : $model->$key;
        }

        $output = array_combine($ids, $models);

        return $output;
    }

    protected static function makeItems(array $items)
    {
        $output = array();

        foreach ($items as $item) {
            $model = new static;

            foreach ($item as $k => $v) {
                $model->$k = $v;
            }

            $output[] = $model;
        }

        return $output;
    }
}