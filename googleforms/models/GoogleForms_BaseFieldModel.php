<?php
namespace Craft;

abstract class GoogleForms_BaseFieldModel extends GoogleForms_BaseItemModel
{
	public function setFromData(array $data)
	{
		parent::setFromData($data);

		$fieldData = $data[4][0];

		$this->name = 'entry.' . $fieldData[0];
		$this->required = (bool) $fieldData[2];

		if(isset($fieldData[4]))
		{
			$this->validation = new GoogleForms_ValidationModel();
			$this->validation->setFromData($fieldData[4][0]);
		}
	}

	public function validate($value)
	{
		$valid = true;

		if($valid && $this->required)
		{
			$valid = !empty($value);
		}

		if($valid && $this->validation)
		{
			$valid = $this->validation->validate($value);
		}

		return $valid;
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [
			'name' => AttributeType::String,
			'required' => AttributeType::Bool,
			'validation' => AttributeType::Mixed,
		]);
	}
}
