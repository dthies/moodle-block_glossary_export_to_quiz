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
 * Glossary export to question version details.
 *
 * @package    block_glossary_export_to_quiz
 * @copyright  2016 onward Daniel Thies <dthies@ccal.edu>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2018080400;        // The current plugin version (Date: YYYYMMDDXX).
$plugin->requires  = 2014111000;        // Requires Moodle >= 2.8 version.
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = 2018080400;         // Version for Moodle 2.8 to 3.5
$plugin->component = 'block_glossary_export_to_quiz';  // Full name of the plugin (used for diagnostics).
