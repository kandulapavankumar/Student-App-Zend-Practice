<?php
namespace Student\Model;

use Zend\Db\TableGateway\TableGateway;

class StudentTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();

        return $resultSet;
    }

    public function getStudent($id)
    {
        $id  = (int) $id;

        if (!$id) {
            throw new \Exception("Could not find $id");
        }

        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function saveStudent(Student $student)
    {
		$data = $student->getArrayCopy();

       $status = $this->tableGateway->update($data, array('id' => $student->id));

        if (!$status) {
            throw new \Exception('Student id does not exist');
        }
    }

    public function addStudent(Student $student)
    {
        $data = $student->getArrayCopy();
        $status = $this->tableGateway->insert($data);

        if (!$status) {
            throw new \Exception('Student details not inserted');
        }
    }

    public function deleteStudent($id)
    {
        if (!$id) {
            throw new \Exception('Could not found proper id');
        }

        $status = $this->tableGateway->delete(array('id' => $id));

        if (!$status) {
            throw new \Exception('Student details not Deleted');
        }
    }
}