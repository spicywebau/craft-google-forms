<?php
namespace Craft;

class GoogleForms_ValidationModel extends BaseModel
{
	public static $typeMap = [
		1 => 'number',
		2 => 'text',
		4 => 'pattern',
		6 => 'length',
	];

	public static $ruleMap = [

		// Number
		1 => 'gt',
		2 => 'gte',
		3 => 'lt',
		4 => 'lte',
		5 => 'eq',
		6 => 'neq',
		7 => 'bt',
		8 => 'nbt',
		9 => null, // Is number
		10 => 'int',

		// Text
		100 => 'contains',
		101 => 'notContains',
		102 => 'email',
		103 => 'url',

		// Length
		202 => 'max',
		203 => 'min',

		// Pattern
		299 => 'contains',
		300 => 'notContains',
		301 => 'matches',
		302 => 'notMatches',
	];

	public function setFromData(array $data)
	{
		$this->type = self::$typeMap[ $data[0] ];
		$this->rule = self::$ruleMap[ $data[1] ];
		$this->ruleData = isset($data[2]) ? $data[2] : null;
		$this->errorMessage = isset($data[3]) ? $data[3] : null;
	}

	public function validate($value)
	{
		// TODO

		return true;
	}

	protected function defineAttributes()
	{
		return [
			'type' => AttributeType::String,
			'rule' => AttributeType::String,
			'ruleData' => AttributeType::Mixed,
			'errorMessage' => AttributeType::String,
		];
	}
}
