<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'NewsAbstract.' . $_EXTKEY,
	'Newsabstract',
	array(
		'NewsAbstract' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'NewsAbstract' => 'update',
		
	)
);
