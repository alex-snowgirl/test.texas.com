<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 15:56 PM
 */
namespace CORE\RDBMS;

use CORE\RDBMS;

/**
 * Simple MySQL Client class
 * @todo replace PDO with native mysqli (pdo taken for simplicity)
 * @todo transfer as much as possible common things to the parent class...
 * @todo add validations...
 * @todo improve functions...
 * @todo error handlers..
 *
 * Class MySQL
 * @package CORE\RDBMS
 * @property \PDOStatement $req
 */
class MySQL extends RDBMS
{
    /**
     * @var \PDO
     */
    protected $pdo;

    protected function _openConnection()
    {
        if (null === $this->pdo) {
            $this->pdo = new \PDO($this->makePdoConnectionQuery(), $this->user, $this->password, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ));
        }
    }

    protected function makePdoConnectionQuery()
    {
        $pdoNameToRdbmsName = array(
            'dbname' => 'schema'
        );

        return 'mysql:' . join(';', array_filter(array_map(function ($name) use ($pdoNameToRdbmsName) {
            $rawName = $name;
            $name = isset($pdoNameToRdbmsName[$name]) ? $pdoNameToRdbmsName[$name] : $name;
            return $this->$name ? ($rawName . '=' . $this->$name) : null;
        }, array('host', 'port', 'dbname', 'charset')), function ($value) {
            return null !== $value;
        }));
    }

    protected function dropConnection()
    {
        if (null !== $this->pdo) {
            $this->pdo = null;
        }
    }

    protected function getLastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }

    protected function getAffectedRowsCount()
    {
        return $this->req->rowCount();
    }

    public function getAffectedRows()
    {
        return $this->req->fetchAll();
    }

    /**
     * Simple Create(Insert) method
     * @todo transfer common logic to RDBMS (for example - left query generator only)...
     *
     * @param $table
     * @param array $values
     * @return int
     */
    public function create($table, array $values)
    {
        $bind = $setC = $setV = array();

        foreach ($values as $k => $v) {
            $setC[] = $this->quote($k);
            $setV[] = '?';
            $bind[] = $v;
        }

        //@todo remove IGNORE (temporary solution)
        return $this->make(join(' ', array(
            'INSERT IGNORE ' . 'INTO ' . $this->quote($table),
            '(' . join(', ', $setC) . ')',
            'VALUES',
            '(' . join(', ', $setV) . ')'
        )), $bind)->getLastInsertedId();
    }

    /**
     * Simple Read(Select) method
     * @todo transfer common logic to RDBMS (for example - left query generator only)...
     *
     * @param $table
     * @param $where
     * @return array
     */
    public function read($table, $where)
    {
        $bind = array();

        return $this->make(join(' ', array(
            'SELECT *',
            'FROM ' . $this->quote($table),
            ($tmp = $this->makeWhereClauseQuery($where, $bind)) ? ('WHERE ' . $tmp) : ''
        )), $bind)->getAffectedRows();
    }

    /**
     * Simple Update method
     * @todo transfer common logic to RDBMS (for example - left query generator only)...
     *
     * @param $table
     * @param array $values
     * @param $where
     * @return int
     */
    public function update($table, array $values, $where)
    {
        $bind = array();
        $set = array();

        foreach ($values as $k => $v) {
            $set[] = $this->quote($k) . ' = ?';
            $bind[] = $v;
        }

        return $this->make(join(' ', array(
            'UPDATE ' . $this->quote($table),
            'SET ' . join(', ', $set),
            ($tmp = $this->makeWhereClauseQuery($where, $bind)) ? ('WHERE ' . $tmp) : ''
        )), $bind)->getAffectedRowsCount();
    }

    /**
     * Simple Delete method
     * @todo transfer common logic to RDBMS (for example - left query generator only)...
     *
     * @param $table
     * @param null $where
     * @return int
     */
    public function delete($table, $where = null)
    {
        $bind = array();

        return $this->make(join(' ', array(
            'DELETE ' . 'FROM ' . $this->quote($table),
            ($tmp = $this->makeWhereClauseQuery($where, $bind)) ? ('WHERE ' . $tmp) : ''
        )), $bind)->getAffectedRowsCount();
    }

    protected function _make($query, $bind = array())
    {
        if ($bind) {
            $tmp = $this->pdo->prepare($query);
            $tmp->execute($bind);
            return $tmp;
        }

        return $this->pdo->query($query);
    }

    protected function _openTransaction()
    {
        $this->pdo->beginTransaction();
    }

    protected function _rollBackTransaction()
    {
        $this->pdo->rollBack();
    }

    protected function _commitTransaction()
    {
        $this->pdo->commit();
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

    public function quote($v, $table = null)
    {
        return ($table ? ($this->quote($table) . '.') : '') . '`' . $v . '`';
    }
}