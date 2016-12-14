<?php
namespace Craft;

abstract class GoogleForms_BaseFieldModel extends GoogleForms_BaseItemModel
{
	public function setFromData(array $data)
	{
		parent::setFromData($data);

		//$this->name = $data[0];
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [
			'name' => AttributeType::String,
		]);
	}
}
