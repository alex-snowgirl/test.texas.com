<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 2:05 PM
 */
namespace CORE;

/**
 * Simple RDBMS class (for the purpose of SOLID principles)
 * @todo implement setters, e.g. setHost, setSchema.. and validate (like setUser)
 * @todo transfer as much as possible common things to this class from child ones...
 * @todo add validations...
 * @todo improve functions...
 * @todo error handlers..
 *
 * Class RDBMS
 * @package CORE
 */
abstract class RDBMS extends ConfigurableObject
{
    const EVENT_COMPLETE = 1;

    protected $host;
    protected $port;
    protected $user;
    protected $password;
    protected $charset;
    protected $schema;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Simple RDBMS User setter
     * @todo add other validates if needed over here..
     *
     * @param $value
     * @return $this
     * @throws Exception
     */
    protected function setUser($value)
    {
        $value = trim($value);

        if (0 == strlen($value)) {
            // @todo create RDBMS Exception (or Invalid Configurable Option) and implement instead...
            throw new Exception('inv user');
        }

        $this->user = $value;
        return $this;
    }

    abstract protected function getLastInsertedId();

    abstract protected function getAffectedRowsCount();

    abstract public function getAffectedRows();

    abstract public function quote($v, $table = null);

    /*  Simple CRUD  */

    abstract public function create($table, array $values);

    abstract public function read($table, $where);

    abstract public function update($table, array $values, $where);

    abstract public function delete($table, $where = null);

    abstract protected function _openConnection();

    /**
     * Simple Open Connection method
     *
     * @return $this
     * @throws Exception
     */
    protected function openConnection()
    {
//        try {
        $this->_openConnection();
//        } catch (\Exception $ex) {
//            throw new Exception($ex->getMessage(), $ex->getCode(), $ex);
//        }

        return $this;
    }

    abstract protected function dropConnection();

    abstract protected function _make($query, $bind = array());

    protected $req;

    protected function dropPrevious()
    {
        $this->req = null;
        return $this;
    }

    /**
     * Main Request function
     * @param $query
     * @param array $bind
     * @return $this
     */
    public function make($query, $bind = array())
    {
        $this->log($query . ' [' . join(', ', $bind) . ']');

        $this->openConnection()
            ->dropPrevious();

        $this->req = $this->_make($query, $bind);

        return $this;
    }

    public function __destruct()
    {
        $this->dropConnection();
    }

    protected $isTransactionOpened;

    protected function isTransactionOpened()
    {
        return $this->isTransactionOpened;
    }

    abstract protected function _openTransaction();

    public function openTransaction()
    {
        $this->log(__FUNCTION__);

        if ($this->isTransactionOpened()) {
            $this->log('Previous transaction is not closed');
        }

        $this->isTransactionOpened = true;
        $this->openConnection();
        $this->_openTransaction();
        $this->off(self::EVENT_COMPLETE);
        return $this;
    }

    abstract protected function _commitTransaction();

    public function commitTransaction()
    {
        $this->log(__FUNCTION__);
        $this->isTransactionOpened = false;
        $this->openConnection();
        $this->_commitTransaction();
        $this->trigger(self::EVENT_COMPLETE);
        return $this;
    }

    abstract protected function _rollBackTransaction();

    public function rollBackTransaction()
    {
        $this->log(__FUNCTION__);
        $this->isTransactionOpened = false;
        $this->openConnection();
        $this->_rollBackTransaction();
        return $this;
    }

    public function makeTransaction(\Closure $fnOk, $default = null)
    {
        $this->openTransaction();
        try {
            try {
                $output = $fnOk($this);
                $this->commitTransaction();
            } catch (\Exception $ex) {
                throw new Exception($ex->getMessage(), $ex->getCode(), $ex);
            }
        } catch (Exception $ex) {
            $this->logger->makeException($ex);
            $this->rollBackTransaction();
            $output = $default;
        }

        return $output;
    }

    /**
     * We do use trait coz we already have an ancestor
     * This is for overloading Event Emitters actions... (+log)
     */
    use Observable {
        on as protected observableOn;
        off as protected observableOff;
        trigger as protected observableTrigger;
    }

    public function on($event, \Closure $callback)
    {
        $this->log(__FUNCTION__);
        return $this->observableOn($event, $callback);
    }

    public function off($event)
    {
        $this->log(__FUNCTION__);
        return $this->observableOff($event);
    }

    public function trigger($event)
    {
        $this->log(__FUNCTION__);
        return $this->observableTrigger($event);
    }

    protected function log($msg)
    {
        $this->logger->make('DB[' . get_called_class() . ']: ' . $msg);
        return $this;
    }

    public function makeWhereClauseQuery($where = null, array &$bind, $isOr = false)
    {
        if (!$where) {
            return null;
        }

        if (!is_array($where)) {
            $where = array($where);
        }

        $query = array();

        foreach ($where as $k => $v) {
            $k = $this->quote($k);

            if (is_array($v)) {
                if (sizeof($v)) {
                    if (sizeof($v) == 1) {
                        $query[] = $k . ' = ?';
                        $bind[] = $v[0];
                    } else {
                        $query[] = $k . ' IN (' . join(', ', array_fill(0, sizeof($v), '?')) . ')';
                        $bind = array_merge($bind, $v);
                    }
                }
            } elseif (null === $v) {
                $query[] = $k . ' IS NULL';
            } else {
                $query[] = $k . ' = ?';
                $bind[] = $v;
            }
        }

        return join($isOr ? ' OR ' : ' AND ', $query);
    }
}