<?php

if (!isset($GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumnstx_newsabstract_tx_news_domain_model_news = array();
	$tempColumnstx_newsabstract_tx_news_domain_model_news[$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:news_abstract/Resources/Private/Language/locallang_db.xlf:tx_newsabstract.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => array(
				array('NewsAbstract','Tx_NewsAbstract_NewsAbstract')
			),
			'default' => 'Tx_NewsAbstract_NewsAbstract',
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $tempColumnstx_newsabstract_tx_news_domain_model_news, 1);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'tx_news_domain_model_news',
	$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type'],
	'',
	'after:' . $GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['label']
);

$tmp_news_abstract_columns = array(

	'abstract' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:news_abstract/Resources/Private/Language/locallang_db.xlf:tx_newsabstract_domain_model_newsabstract.abstract',
		'config' => array(
			'type' => 'text',
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim'
		)
	),
	'subheadline' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:news_abstract/Resources/Private/Language/locallang_db.xlf:tx_newsabstract_domain_model_newsabstract.subheadline',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news',$tmp_news_abstract_columns);

/* \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tx_news_domain_model_news',
        'paletteArchive',
        '--linebreak--,abstract,--linebreak--,subheadline',
        'after:archive'
); */

/* inherit and extend the show items from the parent class */

if(isset($GLOBALS['TCA']['tx_news_domain_model_news']['types']['1']['showitem'])) {
	$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_NewsAbstract_NewsAbstract']['showitem'] = $GLOBALS['TCA']['tx_news_domain_model_news']['types']['1']['showitem'];
} elseif(is_array($GLOBALS['TCA']['tx_news_domain_model_news']['types'])) {
	// use first entry in types array
	$tx_news_domain_model_news_type_definition = reset($GLOBALS['TCA']['tx_news_domain_model_news']['types']);
	$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_NewsAbstract_NewsAbstract']['showitem'] = $tx_news_domain_model_news_type_definition['showitem'];
} else {
	$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_NewsAbstract_NewsAbstract']['showitem'] = '';
}
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_NewsAbstract_NewsAbstract']['showitem'] .= ',--div--;LLL:EXT:news_abstract/Resources/Private/Language/locallang_db.xlf:tx_newsabstract_domain_model_newsabstract,';
$GLOBALS['TCA']['tx_news_domain_model_news']['types']['Tx_NewsAbstract_NewsAbstract']['showitem'] .= 'abstract, subheadline';

$GLOBALS['TCA']['tx_news_domain_model_news']['columns'][$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:news_abstract/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.tx_extbase_type.Tx_NewsAbstract_NewsAbstract','Tx_NewsAbstract_NewsAbstract');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
	'',
	'EXT:/Resources/Private/Language/locallang_csh_.xlf'
);