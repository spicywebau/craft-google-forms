<?php
namespace Craft;

class GoogleForms_CheckboxesFieldModel extends GoogleForms_BaseItemModel
{
	public function getType()
	{
		return 'checkboxes';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
