<?php
namespace Craft;

abstract class GoogleForms_BaseItemModel extends BaseModel
{
	abstract public function getType();

	protected function defineAttributes()
	{
		return [
			'id' => AttributeType::String,
			'title' => AttributeType::String,
			'description' => AttributeType::String,
		];
	}
}
