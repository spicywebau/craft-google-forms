<?php
namespace Craft;

class GoogleForms_SectionModel extends BaseModel
{
	public function addItem(GoogleForms_BaseItemModel $item)
	{
		$items = $this->getAttribute('items');

		if($items)
		{
			$items[] = $item;
		}
		else
		{
			$items = [$item];
		}

		$this->setAttribute('items', $items);
	}

	protected function defineAttributes()
	{
		return [
			'id' => AttributeType::String,
			'title' => AttributeType::String,
			'description' => AttributeType::String,
			'items' => AttributeType::Mixed,
		];
	}
}
