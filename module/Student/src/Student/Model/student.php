<?php
namespace Student\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Student 
{
    public $name;
    public $id;
	public $address;
	
    public function exchangeArray($data)
    {
        $this->id       = (!empty($data['id'])) ? $data['id'] : null;
        $this->name     = (!empty($data['name'])) ? $data['name'] : null;
        $this->address  = (!empty($data['address'])) ? $data['address'] : null;
    }
		
	public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
?>