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
 * Form for editing HTML block instances.
 *
 * @package   moodlecore
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Form for editing Random glossary entry block instances.
 *
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_glossary_export_to_quiz_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $DB, $SESSION;
        $SESSION->block_glossary_export_to_quiz->status = 'defined';
        // Fields for editing HTML block title and contents.

        // Select glossaries to put in dropdown box ...
        $glossaries = $DB->get_records_menu('glossary', array('course' => $this->block->course->id), 'name', 'id,name');
        if (!$glossaries) {
        	$mform->addElement('header', 'config_noglossaries', get_string('noglossaries', 'block_glossary_export_to_quiz'));
        } else {
            $numglossaries = $DB->count_records('glossary', array('course' => $this->block->course->id));
	        foreach($glossaries as $key => $value) {
	            $glossaries[$key] = strip_tags(format_string($value, true));
	        }
	        
	        // build dropdown list array for choose_from_menu_nested () in config_instance file
	        $categoriesarray = array();
	        $categoriesarray[''][0] = get_string('choosedots');
	        
	        // TODO check if no glossaries available
	        $totalnumentries = 0;
	        foreach($glossaries as $key => $value) {
	            $glossarystring = $value;
	            $numentries = $DB->count_records('glossary_entries', array('glossaryid'=>$key));
	            $totalnumentries += $numentries; 
	            if ($numentries) {
	                $categoriesarray[$glossarystring][$key] = $glossarystring.' * '.get_string('allentries','block_glossary_export_to_quiz').' ('.$numentries.')';
		            $select = 'glossaryid='.$key;
		            $categories = $DB->get_records_select('glossary_categories', $select, null, 'name ASC');       
		            if(!empty($categories)) {
	                    $categoriesarray[$glossarystring][$key] = $glossarystring.' * '.get_string('allentries','block_glossary_export_to_quiz').' ('.$numentries.')';
	                	foreach ($categories as $category) {
		                   $cid = $category->id;
		                   $numentries = $DB->count_records('glossary_entries_categories', array('categoryid' => $category->id));                  
		                   $categoriesarray[$glossarystring][$key.','.$cid] = $glossarystring.' :: '.$category->name.' ('.$numentries.')';
	                    }
		            }
	            }
            }
            if ($totalnumentries === 0) {
            	if ($numglossaries == 1) {
                    $emptyglossaries = 'emptyglossary'; 
            	} else {
            		$emptyglossaries = 'emptyglossaries';
            	}
            	$mform->addElement('header', 'configheader', get_string($emptyglossaries, 'block_glossary_export_to_quiz'));
            } else {
                $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
		        $group = array($mform->createElement('selectgroups', 'config_glossary', '', $categoriesarray) );
		        $mform->addGroup($group, 'selectglossary', get_string('selectglossary', 'block_glossary_export_to_quiz'), '', false);
		        // and select sortorder types to put in dropdown box
		        
		        // help icons removed pending fix of  
		        $mform->addHelpButton('selectglossary', 'selectglossary', 'block_glossary_export_to_quiz');
		        $types = array(
		            0 => get_string('concept','block_glossary_export_to_quiz'),
		            1 => get_string('lastmodified','block_glossary_export_to_quiz'),
		            2 => get_string('firstmodified','block_glossary_export_to_quiz'),
		            3 => get_string('random','block_glossary_export_to_quiz')
		        );
		        $mform->addElement('select', 'config_sortingorder', get_string('sortingorder', 'block_glossary_export_to_quiz'), $types);
		        $mform->addHelpButton('config_sortingorder', 'sortingorder', 'block_glossary_export_to_quiz');
		        $mform->addElement('text', 'config_limitnum', get_string('limitnum', 'block_glossary_export_to_quiz'), array('size' => 5));
                $mform->addHelpButton('config_limitnum', 'limitnum', 'block_glossary_export_to_quiz');
		        $mform->setDefault('config_limitnum', 0);
		        $mform->setType('config_limitnum', PARAM_INTEGER);
		
		        // and select question types to put in dropdown box
		        $types = array(
                    0 => get_string('multichoice','block_glossary_export_to_quiz').' ('.get_string('answernumberingabc', 'qtype_multichoice').')',
                    1 => get_string('multichoice','block_glossary_export_to_quiz').' ('.get_string('answernumberingABCD', 'qtype_multichoice').')',
                    2 => get_string('multichoice','block_glossary_export_to_quiz').' ('.get_string('answernumbering123', 'qtype_multichoice').')',
                    3 => get_string('multichoice','block_glossary_export_to_quiz').' ('.get_string('answernumberingnone', 'qtype_multichoice').')',
                    4 => get_string('shortanswer_0','block_glossary_export_to_quiz'),
		            5 => get_string('shortanswer_1','block_glossary_export_to_quiz')
		        );
		        $mform->addElement('select', 'config_questiontype', get_string('questiontype', 'block_glossary_export_to_quiz'), $types);
                $mform->addHelpButton('config_questiontype', 'questiontype', 'block_glossary_export_to_quiz');
	        }
        }
    }
}
