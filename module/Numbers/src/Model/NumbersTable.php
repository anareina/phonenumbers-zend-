<?php

namespace Numbers\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class NumbersTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getNumbers($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveNumbers(Numbers $numbers)
    {
        $data = [
            'countrycode' => $numbers->countrycode,
            'phone'  => $numbers->phone,
        ];

        $id = (int) $numbers->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getNumbers($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update numbers with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteNumbers($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}