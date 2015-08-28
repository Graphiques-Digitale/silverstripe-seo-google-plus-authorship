<?php

/**
 * SEO_Authorship_SiteConfig_DataExtension
 *
 * @todo add description
 *
 * @package silverstripe-seo
 * @subpackage authorship
 * @author Andrew Gerber <atari@graphiquesdigitale.net>
 * @version 1.0.0
 *
 * @todo lots
 *
 */

class SEO_Authorship_SiteConfig_DataExtension extends DataExtension {


	/* Overload Model
	------------------------------------------------------------------------------*/

	private static $db = array(
		'GoogleProfileID' => 'Varchar(128)',
	);


	/* Overload Methods
	------------------------------------------------------------------------------*/

	// CMS Fields
	public function updateCMSFields(FieldList $fields) {

		// owner
		$owner = $this->owner;

		//// Authorship

		$tab = 'Root.SEO.Authorship';

		// add fields
		$fields->addFieldsToTab($tab, array(
			TextField::create('GoogleProfileID', 'Publisher Google+ Profile ID'),
		));

	}

}