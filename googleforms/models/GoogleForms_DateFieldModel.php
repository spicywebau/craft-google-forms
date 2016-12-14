<?php
namespace Craft;

class GoogleForms_DateFieldModel extends GoogleForms_BaseFieldModel
{
	public function getType()
	{
		return 'date';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
