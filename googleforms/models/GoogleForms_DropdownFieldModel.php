<?php
namespace Craft;

class GoogleForms_DropdownFieldModel extends GoogleForms_BaseFieldModel
{
	public function getType()
	{
		return 'dropdown';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
