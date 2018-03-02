<?php
    /**
	*	LS 3.x plugin try
	*   Gives the possibility to add a js script to a question on certain places
	*   based on Denis Chenu <denis@sondages.pro> addScriptToQuestion (not working in LS3.x)
	*
	*	added: switch of/on execution on question level
	*	added: switch on/of execution on global (ls installation) level
	*   added: default placement on global level
	*
	*	consider: switch on/of execution on survey level?
	*   consider: more than one script per question (on different places)?
	*
	*	status: experimental
	*			lots of todo's ;)
	*/
	
	class AdNotes extends PluginBase {
	
        static protected $name 		  = 'AdNotes';
		static protected $description = 'Allow to add notes to questions.';
        
		protected $storage = 'DbStorage';
		
		/**
		* Add function to be used in beforeQuestionRender event and to attriubute
		*/
		public function init()
		{
			$this->subscribe('newQuestionAttributes');			// attributes on global level for all surveys
			$this->subscribe('beforeQuestionRender');			// attributes on question level 
		}
		
		/**
		* We add the attribute here
		*/
		public function newQuestionAttributes()
		{
			$event = $this->event;
			$questionAttributes = array (
				'adNoteText' => array(
					'types'		=> '15ABCDEFGHIKLMNOPQRSTUWXYZ!:;|*', /* All question types */
					'category'  => gT('AdNotes'),
					'sortorder' => 1,
					'inputtype' => 'textarea',
					'default'   => '',
					'caption'	=> 'Notes',
					'help'		=> 'Edit your notes here'
				),
				'adToDoText' => array(
					'types'		=> '15ABCDEFGHIKLMNOPQRSTUWXYZ!:;|*', /* All question types */
					'category'  => gT('AdNotes'),
					'sortorder' => 2,
					'inputtype' => 'textarea',
					'default'   => '',
					'caption'	=> 'ToDo',
					'help'		=> "Edit ToDos here."
				)
			);
				
			$event->append('questionAttributes', $questionAttributes);
		}
		
	}