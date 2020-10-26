<?php
/**
 * @package    local
 * @subpackage coursehybridtree
 * @copyright  2014 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2020100300;        // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2020060900;        // Requires this Moodle version
$plugin->component = 'local_coursehybridtree';       // Full name of the plugin (used for diagnostics)

$plugin->dependencies = [
	'local_roftools' => 2020100300,
	'local_up1_courselist' => 2020100300,
	'report_up1hybridtree' => 2020102401
];
