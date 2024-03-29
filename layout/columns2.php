<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A two column layout for the boost theme.
 *
 * @package   theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if (isloggedin()) {
    $courseindexopen = (get_user_preferences('drawer-open-index', true) == true);
    $blockdraweropen = (get_user_preferences('drawer-open-block', true) == true);
} else {
    $courseindexopen = false;
    $blockdraweropen = false;
}

require_once($CFG->dirroot . '/course/lib.php');

$extraclasses = [];

$PAGE->requires->js_call_amd('theme_telaformation/telaformation', 'init');
$PAGE->requires->js_call_amd('theme_telaformation/completion', 'init');

$bodyattributes = $OUTPUT->body_attributes($extraclasses);

// Handle blockDrawer.
$addblockbutton = $OUTPUT->addblockbutton();

$blockshtml = $OUTPUT->blocks('side-pre');

$hasblocks = (strpos($blockshtml, 'data-block=') !== false || !empty($addblockbutton));
if (!$hasblocks) {
    $blockdraweropen = false;
}

$courseindex = core_course_drawer();

if (!$courseindex) {
    $courseindexopen = false;
}
$forceblockdraweropen = $OUTPUT->firstview_fakeblocks();

$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions()
    && !$PAGE->has_secondary_navigation();

// If the settings menu will be included in the header then don't add it here.
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

$renderer = $PAGE->get_renderer('core');
$primary = new core\navigation\output\primary($PAGE);
$primarymenu = $primary->export_for_template($renderer);

$overflow = '';

$secondarynavigation = false;
if ($PAGE->has_secondary_navigation()) {
    $moremenu =
        new core\navigation\output\more_menu($PAGE->secondarynav,
            'nav-tabs');
    $secondarynavigation = $moremenu->export_for_template($OUTPUT);
}

$theme = theme_config::load('telaformation');

$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

$templatecontext = [
    'sitename' => format_string(
        $SITE->shortname,
        true,
        ['context' => context_course::instance(SITEID), "escape" => false]
    ),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'primarymoremenu' => $primarymenu['moremenu'],
    'secondarymoremenu' => $secondarynavigation ?: false,
    'blockdraweropen' => $blockdraweropen,
    'usermenu' => $primarymenu['user'],
    'langmenu' => $primarymenu['lang'],
    'hasfrontpageregions' => !empty($hasfrontpageregions),
    'courseindexopen' => $courseindexopen,
    'courseindex' => $courseindex,
    'mobileprimarynav' => $primarymenu['mobileprimarynav'],
    'headercontent' => $headercontent,
    'forceblockdraweropen' => $forceblockdraweropen,
    'addblockbutton' => $addblockbutton,
    'overflow' => $overflow,
];

echo $OUTPUT->render_from_template('theme_boost/columns2', $templatecontext);
