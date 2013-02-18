<?php
/**
 * April
 *
 * @package April
 */

elgg_register_event_handler('init', 'system', 'april_init');

/**
 * Initialize the plugin.
 */
function april_init() {
	april_get_views();
}

/**
 * Register rewrite hook to chosen views. 
 */
function april_get_views() {
	$views = array(
		'output/longtext',
		'output/text',
		'output/tag',
		'output/tags',
		'output/tagcloud',
		'page/components/image_block',
		'page/elements/title',
		'page/elements/messages',
		'river/elements/summary',
		'object/elements/summary',
	);

	foreach ($views as $view) {
		elgg_register_plugin_hook_handler('view', $view, 'april_rewrite');
	}
}

/**
 * Replace strings with others.
 */
function april_rewrite($hook, $type, $value, $params) {
	$strings = array(
		'hallitus' => 'jargonsananeuvosto',
		'tarjous' => 'huijaus',
		'tarjouksen' => 'huijauksen',
		'koulutus' => 'peukalonpyöritys',
		'kehittämistoimet' => 'pyllynrytkytystoimet',
		'aprillipäivä' => 'perseenraapimispäivä',
		'aprillia' => 'prut bröööt',
		'silliä' => 'aurinkokuivattuja tomaatteja',
		'blogiviestin' => 'random avautumisen',
		'tampere' => 'mansesteri',
		'hämeenlinna' => 'tavastehus',
	);

	$patterns = array();
	$replacements = array();
	foreach ($strings as $pattern => $replacement) {
		$pattern = str_replace(array('ä', 'ö'), array('&auml;', '&ouml;'), $pattern);
		$patterns[] = "/$pattern/i";
		$replacements[] = $replacement;
	}

	//$value = str_ireplace($patterns, $replacements, $value);
	$value = preg_replace($patterns, $replacements, $value);

	return $value;
}
