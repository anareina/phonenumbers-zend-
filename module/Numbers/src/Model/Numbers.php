<?php

namespace Numbers\Model;

class Numbers
{
    public $id;
    public $countrycode;
    public $phone;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->countrycode = !empty($data['countrycode']) ? $data['countrycode'] : null;
        $this->phone  = !empty($data['phone']) ? $data['phone'] : null;

    		$array = ['212'=>'Morocco', '258'=>'Mozambique', '256'=>'Nigeria', '251'=>'Ethiopia', '237'=>'Cameroon'];
        $this->array = $array;
				$this->state = !empty($data['phone']) ? count(str_split($data['phone'])) : null;
    }
}