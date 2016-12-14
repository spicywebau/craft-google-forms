<?php
namespace Craft;

abstract class GoogleForms_BaseItemModel extends BaseModel
{
	abstract public function getType();

	public function setFromData(array $data)
	{
		$this->id = $data[0];
		$this->title = $data[1];
		$this->description = $data[2];
	}

	protected function defineAttributes()
	{
		return [
			'id' => AttributeType::String,
			'title' => AttributeType::String,
			'description' => AttributeType::String,
		];
	}
}
