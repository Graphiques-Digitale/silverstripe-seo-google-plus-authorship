<?php

/**
 * SEO_Authorship_Member_DataExtension
 *
 * @todo add description
 *
 * @package silverstrip-seo
 * @subpackage authorship
 * @author Andrew Gerber <atari@graphiquesdigitale.net>
 * @version 1.0.0
 *
 * @todo lots
 *
 */

class SEO_Authorship_Member_DataExtension extends DataExtension {

	/* Overload Variable
	 ------------------------------------------------------------------------------*/

	private static $db = array(
		// Author Google+ ID
		'FacebookProfileID' => 'Varchar(128)',
		'GoogleProfileID' => 'Varchar(128)',
	);
	private static $belongs_many_many = array(
		// pages authored
		'Authored' => 'SiteTree',
	);


	/* Overload Methods
	------------------------------------------------------------------------------*/

	// CMS Fields
	public function updateCMSFields(FieldList $fields) {

		$tab = 'Root.SEO';

		// Profile ID
		$fields->addFieldsToTab($tab, array(
			TextField::create('FacebookProfileID', 'Facebook Profile ID'),
			TextField::create('GoogleProfileID', 'Google+ Profile ID'),
		));

		// Pages Authored
		// remove
		$fields->removeByName(array('Authored'));
		// add
		$fields->addFieldsToTab($tab, array(
			GridField::create('Authored', 'Pages Authored', $this->owner->Authored())
				->setConfig(GridFieldConfig_RelationEditor::create())
		));

	}

}