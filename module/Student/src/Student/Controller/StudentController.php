<?php
namespace Student\Controller;

use Student\Model\Student;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\AcceptableViewModelSelector;
use Zend\View\Model\ViewModel;
use Zend\Validator\Digits;
use Zend\I18n\Validator\Alpha;
use Zend\I18n\Validator\Alnum;

class StudentController extends AbstractActionController
{
	protected $studentTable;

    public function addAction()
    {
    }

    public function addstudentAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
        $id = $this->getRequest()->getpost('id');
        $name = $this->getRequest()->getpost('name');
        $address = $this->getRequest()->getpost('address');
        }

        $digit = new Digits();
        $alpha1 = new Alpha();

        if ($digit->isValid($id) && $alpha1->isValid($name) && $address) {
            $st1 = new Student();
            $st1->id = $id;
            $st1->name = $name;
            $st1->address = $address;

            try {
                $status = $this->getStudentTable()->addStudent($st1);
            } catch(\Exception $ex) {
                return new viewmodel(array('status' => 'Student Details Failed to Insert'));
            }

            return new ViewModel(array('status' => 'Student Details Inserted Successfully'));
         } else {
            $this->redirect()->toRoute('student');
         }
    }
	
    public function indexAction()
    {

        return new ViewModel(array(
			'student1' => $this->getStudentTable()->fetchAll(),
        ));
    }

    public function editAction()
    {
	    $id = (int) $this->params()->fromRoute('id', 0);

        if ($id != 0) {

            return new ViewModel(array(
			'student1' => $this->getStudentTable()->getStudent($id),
            ));

        } else {
             $this->redirect()->toRoute('student');
        }
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id != 0) {
            try{
                $status = $this->getStudentTable()->deleteStudent($id);
            } catch(\Exception $ex) {

                return new viewmodel(array('status' => 'Student Details Failed to Delete'));
            }

            return new ViewModel(array('status' => 'Student Details Deleted Successfully'));
        } else {
            $this->redirect()->toRoute('student');
        }

    }

    public function saveAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
        $id = $this->getRequest()->getpost('id');
        $name = $this->getRequest()->getpost('name');
        $address = $this->getRequest()->getpost('address');
        }

        $digit = new Digits();
        $alpha1 = new Alpha();

        if ($digit->isValid($id) && $alpha1->isValid($name) && $address) {
            $st1 = new Student();
            $st1->id = $id;
            $st1->name = $name;
            $st1->address = $address;

            try {
                $status = $this->getStudentTable()->saveStudent($st1);
            } catch(\Exception $ex) {

                return new viewmodel(array('status' => 'Student Details Failed to Update'));
            }

            return new ViewModel(array('status' => 'Student Details Updated Successfully'));
        }
    }


    public function getStudentTable()
    {
        if (!$this->studentTable) {
            $sm = $this->getServiceLocator();
            $this->studentTable = $sm->get('Student\Model\StudentTable');
        }

        return $this->studentTable;
    }
}