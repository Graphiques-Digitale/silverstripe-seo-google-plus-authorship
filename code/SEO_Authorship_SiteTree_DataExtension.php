<?php

/**
 * SEO_Authorship_SiteTree_DataExtension
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

class SEO_Authorship_SiteTree_DataExtension extends DataExtension {


	/* Overload Variable
	------------------------------------------------------------------------------*/

	private static $many_many = array(
		'Authors' => 'Member',
	);


	/* Overload Methods
	------------------------------------------------------------------------------*/

	// CMS Fields
	public function updateCMSFields(FieldList $fields) {

		// variables
// 		$config = SiteConfig::current_site_config();
		$owner = $this->owner;

		//// Authorship

		$tab = 'Root.SEO.Authorship';

		//
		$authorsConfig = new GridFieldConfig_RelationEditor();
		$authorsConfig->removeComponentsByType('GridFieldAddNewButton');
		//
		$fields->addFieldsToTab($tab, array(
			GridField::create('Authors', 'Authors', $owner->Authors(), $authorsConfig)
		));

	}


	/* Template Methods
	------------------------------------------------------------------------------*/

	/**
	 * @name updateMetadata
	 *
	 * Extends $owner Metdata() function with Authorship values.
	 *
	 * @param string $metadata
	 * @param SiteTree $owner
	 * @param SiteConfig $config
	 * @return string
	 */
	public function updateMetadata(&$metadata, $owner, $config) {

		// variables
// 		$config = SiteConfig::current_site_config();
// 		$owner = $this->owner;

		$authors = $owner->Authors();
		$metadata .= $owner->MarkupHeader('Google+ Authorship');

		// Facebook Authors
		foreach ($authors as $author) {
			if ($author->FacebookProfileID) {
				$metadata .= $owner->MarkupFacebook('article:author', $author->FacebookProfileID, false);
				break;
			}
		}

		// Google+ Authors
		foreach ($authors as $author) {
			if ($author->GoogleProfileID) {
				$profile = 'https://plus.google.com/' . $author->GoogleProfileID . '/';
				$metadata .= $owner->MarkupRel('author', $profile);
				// @todo kinda - Google+ does not support multiple authors - break loop
				break;
			}
		}

		// Google+ Publisher
		if ($config->GoogleProfileID) {
			$profile = 'https://plus.google.com/' . $config->GoogleProfileID . '/';
			$metadata .= $owner->MarkupRel('publisher', $profile);
		}

		// return
		return $metadata;

	}

}