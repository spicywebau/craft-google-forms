<?php
namespace Craft;

class GoogleForms_TimeFieldModel extends GoogleForms_BaseFieldModel
{
	public function getType()
	{
		return 'time';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
