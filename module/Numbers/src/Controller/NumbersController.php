<?php

namespace Numbers\Controller;

use Numbers\Model\NumbersTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NumbersController extends AbstractActionController
{

		private $table;

		 public function __construct(NumbersTable $table)
    {
        $this->table = $table;
    }

  	public function indexAction()
    {
        return new ViewModel([
            'numbers' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}