<?php
namespace Craft;

class GoogleFormsService extends BaseApplicationComponent
{
	/**
	 * Retrieves a Google form model from an ID.
	 * 
	 * @param $formId
	 * @return bool|GoogleForms_FormModel
	 */
	public function getForm($formId)
	{
		$data = $this->_extractFormData($formId);

		if($data)
		{
			$form = new GoogleForms_FormModel();
			$form->id = $data[14];
			$form->title = $data[3];
			$form->description = $data[1][0];
			$form->owner = $data[11];
			$form->ownerName = $data[12];
			$form->sections = [];

			$currentSection = new GoogleForms_SectionModel();
			$currentSection->title = $form->title;
			$currentSection->description = $form->description;
			$form->addSection($currentSection);

			foreach($data[1][1] as $itemData)
			{
				$item = null;
				$itemType = $itemData[3];

				switch($itemType)
				{
					case 0: $item = new GoogleForms_ShortAnswerFieldModel(); break;
					case 1: $item = new GoogleForms_ParagraphFieldModel(); break;
					case 2: $item = new GoogleForms_MultipleChoiceFieldModel(); break;
					case 3: $item = new GoogleForms_DropdownFieldModel(); break;
					case 4: $item = new GoogleForms_CheckboxesFieldModel(); break;
					case 5: $item = new GoogleForms_LinearScaleFieldModel(); break;
					case 6: $item = new GoogleForms_TextItemModel(); break;
					case 7: $item = new GoogleForms_MultipleChoiceGridFieldModel(); break;
					case 8:
					{
						$currentSection = new GoogleForms_SectionModel();
						$currentSection->id = $itemData[0];
						$currentSection->title = $itemData[1];
						$currentSection->description = $itemData[2];
						$form->addSection($currentSection);
					}
					break;
					case 9: $item = new GoogleForms_DateFieldModel(); break;
					case 10: $item = new GoogleForms_TimeFieldModel(); break;
				}

				if($item)
				{
					$item->setFromData($itemData);
					$currentSection->addItem($item);
				}
			}

			return $form;
		}

		return false;
	}

	/**
	 * Extracts the raw form data from a Google form.
	 *
	 * @param $formId
	 * @return bool|mixed
	 */
	private function _extractFormData($formId)
	{
		$url = 'https://docs.google.com/forms/d/' . $formId . '/viewform';
		$html = $this->_readDataFromUrl($url);
		$data = false;

		if($html)
		{
			$doc = new \DOMDocument();
			$internalErrors = \libxml_use_internal_errors(true);
			$doc->loadHTML($html);
			\libxml_use_internal_errors($internalErrors);
			$xml = \simplexml_import_dom($doc);

			foreach($xml->xpath('//script[not(@src)]') as $node)
			{
				$js = \dom_import_simplexml($node)->nodeValue;
				preg_match('/var\s+FB_PUBLIC_LOAD_DATA_\s*=\s*(.+);/s', $js, $matches);

				if(!empty($matches))
				{
					$json = $matches[1];
					$data = JsonHelper::decode($json);

					break;
				}
			}
		}

		return $data;
	}

	/**
	 * Reads in data from an external link.
	 *
	 * @param $url
	 * @return bool|mixed|string
	 */
	private function _readDataFromUrl($url)
	{
		if(function_exists('curl_init'))
		{
			GoogleFormsPlugin::log("Reading file with `curl`");

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			$data = curl_exec($ch);
			$error = curl_error($ch);

			if(!empty($error))
			{
				GoogleFormsPlugin::log("Error reading file (\"{$error}\")", LogLevel::Error);

				$data = false;
			}

			curl_close($ch);

			return $data;
		}

		$allowUrlFopen = preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen'));
		if($allowUrlFopen)
		{
			GoogleFormsPlugin::log("Reading file with `file_get_contents`");

			return @file_get_contents($url);
		}

		return false;
	}
}
