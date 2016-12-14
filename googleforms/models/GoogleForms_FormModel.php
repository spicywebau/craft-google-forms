<?php
namespace Craft;

class GoogleForms_FormModel extends BaseModel
{
	public function addSection(GoogleForms_SectionModel $section)
	{
		$sections = $this->getAttribute('sections');

		if($sections)
		{
			$sections[] = $section;
		}
		else
		{
			$sections = [$section];
		}

		$this->setAttribute('sections', $sections);
	}

	protected function defineAttributes()
	{
		return [
			'id' => AttributeType::String,
			'title' => AttributeType::String,
			'description' => AttributeType::String,
			'sections' => AttributeType::Mixed,
			'owner' => AttributeType::String,
			'ownerName' => AttributeType::String,
		];
	}
}
