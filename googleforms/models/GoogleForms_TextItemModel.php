<?php
namespace Craft;

class GoogleForms_TextItemModel extends GoogleForms_BaseItemModel
{
	public function getType()
	{
		return 'text';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
