<?php
/**
 * Gives the possibility to add some notes to a question
 * A simple addon, but useful for workflow and documentation.
 *
 * @author Oskar Villani (o.villani@sdi-research.at)
 * @copyright 2018 Oskar Villani <http://www.sdi-research.at>
 * @license AGPL v3
 * @version 1.0.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */
class AddNotes extends PluginBase {                                         // class name fits to file name

    static protected $name = 'AddNotes';                                    // as shown in plugin manager
    static protected $description = 'Allow to add notes to questions.';     // as shown in plugin manager
        
    protected $storage = 'DbStorage';                                       // to save notes permanently

    /**
    * Add function to be used in beforeQuestionRender event and to attriubute
    */
    public function init()
    {
        $this->subscribe('newQuestionAttributes');                          // subscribe new attributes (i.e. fields
                                                                            //                  in questions options)
    }

    /**
    * add the attributes on question level here
    */
    public function newQuestionAttributes()
    {
        // define the fields
        $questionAttributes = array (
            'addNoteText' => array(                                        // one field for notes
                'types'	    => '15ABCDEFGHIKLMNOPQRSTUWXYZ!:;|*',          // for all question types 
                'category'  => gT('AddNotes'),                             // option category
                'sortorder' => 1,                                          // show at first
                'inputtype' => 'textarea',                                 // as a textarea
                'default'   => '',                                         // empty by default
                'caption'   => 'Notes',                                    // field name above textfield
                'help'	    => 'Edit your notes here'                      // some hint when hovering above caption
            ),
            'addToDoText' => array(                                        // second field for todos
                'types'	    => '15ABCDEFGHIKLMNOPQRSTUWXYZ!:;|*',          // for all question types 
                'category'  => gT('AddNotes'),
                'sortorder' => 2,
                'inputtype' => 'textarea',
                'default'   => '',
                'caption'   => 'ToDo',
                'help'	    => "Edit ToDos here."
            )
        );

        $event = $this->event;                                             // get the event ...
        $event->append('questionAttributes', $questionAttributes);         // ... and append the new fields
    }

}