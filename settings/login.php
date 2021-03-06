<?php
// This file is part of the Telaformation theme for Moodle
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
 * Theme Telaformation settings login file.
 *
 * @package    theme_telaformation
 * @copyright  Tela Botanica 2020
 * @author     Sylvain Revenu - Pimenko 2020 <contact@pimenko.com> <pimenko.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Some parts there are from 'adaptable' theme.
$page = new admin_settingpage('theme_telaformation_login', get_string('loginsettings', 'theme_telaformation'));

// Login page background image.
$name = 'theme_telaformation/loginbgimage';
$title = get_string('loginbgimage', 'theme_telaformation');
$description = get_string('loginbgimagedesc', 'theme_telaformation');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbgimage');
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Login page background style.
$name = 'theme_telaformation/loginbgstyle';
$title = get_string('loginbgstyle', 'theme_telaformation');
$description = get_string('loginbgstyledesc', 'theme_telaformation');
$default = 'cover';
$setting = new admin_setting_configselect($name, $title, $description, $default,
        array(
                'cover' => get_string('stylecover', 'theme_telaformation'),
                'stretch' => get_string('stylestretch', 'theme_telaformation')
        )
);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Login page background opacity.
$opactitychoices = array(
        '0.0' => '0.0',
        '0.1' => '0.1',
        '0.2' => '0.2',
        '0.3' => '0.3',
        '0.4' => '0.4',
        '0.5' => '0.5',
        '0.6' => '0.6',
        '0.7' => '0.7',
        '0.8' => '0.8',
        '0.9' => '0.9',
        '1.0' => '1.0'
);

$name = 'theme_telaformation/loginbgopacity';
$title = get_string('loginbgopacity', 'theme_telaformation');
$description = get_string('loginbgopacitydesc', 'theme_telaformation');
$default = '0.8';
$setting = new admin_setting_configselect($name, $title, $description, $default, $opactitychoices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Top text.
$name = 'theme_telaformation/logintextboxtop';
$title = get_string('logintextboxtop', 'theme_telaformation');
$description = get_string('logintextboxtopdesc', 'theme_telaformation');
$default = '';
$setting = new telaformation_setting_confightmleditor($name, $title, $description, $default);
$page->add($setting);

// Bottom text.
$name = 'theme_telaformation/logintextboxbottom';
$title = get_string('logintextboxbottom', 'theme_telaformation');
$description = get_string('logintextboxbottomdesc', 'theme_telaformation');
$default = '';
$setting = new telaformation_setting_confightmleditor($name, $title, $description, $default);
$page->add($setting);

$settings->add($page);