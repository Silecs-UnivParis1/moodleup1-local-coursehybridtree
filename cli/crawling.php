<?php
/**
 * @package    local_coursehybridtree
 * @copyright  2014-2020 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require(dirname(dirname(dirname(__DIR__))).'/config.php'); // global moodle config file.
require_once($CFG->libdir.'/clilib.php');      // cli only functions


// now get cli options
list($options, $unrecognized) = cli_get_params([
        'help'=>false, 'maxdepth'=>0, 'verbose'=>1]);

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}

$help =
"Course Hybrid Tree Crawler (CLI)

Options:
--help                Print out this help
--maxdepth            Maximal tree depth ; 0=no max.
--verbose             verbosity (0 to ?)

";
// --node                Test the webservice for the given node.
//                      node = eg /cat0 (interpolated), /cat10, /cat14/UP1-PROG12345 ...
//";

if ( ! empty($options['help']) ) {
    echo $help;
    return 0;
}

$crawler = new \local_coursehybridtree\crawler($options['verbose'], $options['maxdepth']);
$crawler->hybridcrawler();
