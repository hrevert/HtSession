<?php

namespace HtSession\Session\SaveHandler;

use Doctrine\DBAL\Connection;

/**
 * DB Table Gateway session save handler
 */
class DoctrineDbal extends \Zend\Session\SaveHandler\DbTableGateway
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * Constructor
     *
     * @param  EntityManagerInterface          $connection
     * @param  DoctrineDbalOptions $options
     * @return void
     */
    public function __construct(Connection $connection, DoctrineDbalOptions $options)
    {
        $this->connection = $connection;
        $this->options      = $options;
    }

    /**
     * gets connection
     *
     * @return EntityManagerInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * gets DoctrineDbalOptions
     *
     * @return DoctrineDbalOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    protected function find($id)
    {
        $queryBuilder = $this->getConnection()->createQueryBuilder();

        return $queryBuilder
            ->select('*')
            ->from($this->getOptions()->getTableName(), 's')
            ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq($this->getOptions()->getIdColumn(), '?'),
                    $queryBuilder->expr()->eq($this->getOptions()->getNameColumn(), '?')
                )
            )
            ->setParameter(0, $id)
            ->setParameter(1, $this->sessionName)
            ->execute()
            ->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * {@inheritDoc}
     */
    public function read($id)
    {
        if ($row = $this->find($id)) {
            if ($row[$this->getOptions()->getModifiedColumn()] + $row[$this->getOptions()->getLifetimeColumn()] > time()) {
                return $row[$this->getOptions()->getDataColumn()];
            }
            $this->destroy($id);
        }

        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function write($id, $data)
    {
        $data = array(
            $this->getOptions()->getModifiedColumn() => time(),
            $this->getOptions()->getDataColumn()     => (string) $data,
        );

        if ($this->find($id)) {
            return $this->getConnection()->update(
                $this->getOptions()->getTableName(),
                $data,
                array(
                    $this->getOptions()->getIdColumn()   => $id,
                    $this->getOptions()->getNameColumn() => $this->sessionName,
                )
            );

        }

        $data[$this->getOptions()->getLifetimeColumn()] = $this->lifetime;
        $data[$this->getOptions()->getIdColumn()]       = $id;
        $data[$this->getOptions()->getNameColumn()]     = $this->sessionName;
        $this->getConnection()->insert($this->getOptions()->getTableName(), $data);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function destroy($id)
    {
        return (bool) $this->getConnection()->delete($this->getOptions()->getTableName(), array(
            $this->getOptions()->getIdColumn()   => $id,
            $this->getOptions()->getNameColumn() => $this->sessionName,
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function gc($maxlifetime)
    {
        $queryBuilder = $this->getConnection()->createQueryBuilder();
        $queryBuilder->delete($this->getOptions()->getTableName())
            ->where(sprintf(
                    '%s + %s < %s',
                    $this->getConnection()->quoteIdentifier($this->options->getModifiedColumn()),
                    $this->getConnection()->quoteIdentifier($this->options->getLifetimeColumn()),
                    time()
            ));

        return $queryBuilder->execute();
    }

}
