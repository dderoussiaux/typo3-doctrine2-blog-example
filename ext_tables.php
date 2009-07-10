<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

/**
 * A fully configured omnipotent plugin
 */
Tx_Extbase_Utility_Plugin::registerPlugin(
	$_EXTKEY,																		// The extension name (in UpperCamelCase) or the extension key (in lower_underscore)
	'Pi1',																			// A unique name of the plugin in UpperCamelCase
	'A Blog Example',																// A title shown in the backend dropdown field
	array(																			// An array holding the controller-action-combinations that are accessible 
		'Blog' => 'index,show,new,create,delete,deleteAll,edit,update,populate',	// The first controller and its first action will be the default 
		'Post' => 'index,show,new,create,delete,edit,update',
		'Comment' => 'create',
		),
	array(																			// An array of non-cachable controller-action-combinations (they must already be enabled)
		'Blog' => 'delete,deleteAll,edit,update,populate',
		'Post' => 'show,delete,edit,update',
		'Comment' => 'create',
		)
);

/**
 * A minimalistic configuration
 */
// Tx_Extbase_Utility_Plugin::registerPlugin('BlogExample', 'Pi1', 'A Blog Example', array('Blog' => 'index,show,edit'));

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Blog Example');

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');

t3lib_extMgm::allowTableOnStandardPages('tx_blogexample_domain_model_blog');
$TCA['tx_blogexample_domain_model_blog'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_blogexample_domain_model_blog.gif'
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_blogexample_domain_model_post');
$TCA['tx_blogexample_domain_model_post'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post',
		'label'				=> 'title',
		'label_alt'			=> 'author',
		'label_alt_force'	=> TRUE,
		'tstamp'            => 'tstamp',
		'crdate'            => 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'delete'            => 'deleted',
		'enablecolumns'     => array(
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_blogexample_domain_model_post.gif'
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_blogexample_domain_model_comment');
$TCA['tx_blogexample_domain_model_comment'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_comment',
		'label'				=> 'date',
		'label_alt'			=> 'author',
		'label_alt_force'	=> TRUE,
		'tstamp'            => 'tstamp',
		'crdate'            => 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'delete'            => 'deleted',
		'enablecolumns'     => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_blogexample_domain_model_comment.gif'
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_blogexample_domain_model_person');
$TCA['tx_blogexample_domain_model_person'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_person',
		'label' 			=> 'lastname',
		'label_alt'			=> 'firstname',
		'label_alt_force'	=> TRUE,
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_blogexample_domain_model_person.gif'
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_blogexample_domain_model_tag');
$TCA['tx_blogexample_domain_model_tag'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_tag',
		'label'				=> 'name',
		'tstamp'            => 'tstamp',
		'crdate'            => 'crdate',
		'delete'            => 'deleted',
		'enablecolumns'     => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_blogexample_domain_model_tag.gif'
	)
);


/* Module */
if (TYPO3_MODE == 'BE') {
    t3lib_extMgm::addModulePath('tools_txblogexampleM1', t3lib_extMgm::extPath($_EXTKEY) . 'Module/BlogModule/');
    t3lib_extMgm::addModule('tools', 'txblogexampleM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'Module/BlogModule/');
}
?>