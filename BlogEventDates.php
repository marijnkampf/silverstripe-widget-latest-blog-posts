<?php

class BlogEventDates extends DataObjectDecorator {
	function extraStatics() {
		return array(
			'db' => array (
				'EventStart' => 'Date',
				'EventEnd' => 'Date'
			)
		);
	}

	function isEvent() {
		return (!empty($this->owner->EventStart) || !empty($this->owner->EventEnd));
	}

	/**
	* Outputs date span or single date if no end date defined
	*/
	function EventDateRange() {
			$start = new Date();
			$start->setValue($this->owner->EventStart);

			if (!is_null($this->owner->EventEnd)) { // Check if there is an end date
				 $end = new Date();
				 $end->setValue($this->owner->EventEnd);
				 return $start->RangeString($end);
			} else {
				 return $start->Full();
			}
	}

	public function updateCMSFields(FieldSet $fields) {
		$fields->addFieldToTab("Root.Content.Main", $dateField = new DatetimeField("Date", "Publication Date"),"Author");
		$dateField->getDateField()->setConfig('showcalendar', true);
		$dateField->getTimeField()->setConfig('showdropdown', true);

		$fields->addFieldToTab("Root.Content.Main", $dateField = new DatetimeField("EventStart", "Event Start Date (Leave empty for non-events)"),"Author");
		$dateField->getDateField()->setConfig('showcalendar', true);
		$dateField->getTimeField()->setConfig('showdropdown', true);

		$fields->addFieldToTab("Root.Content.Main", $dateField = new DatetimeField("EventEnd", "Event End Date"),"Author");
		$dateField->getDateField()->setConfig('showcalendar', true);
		$dateField->getTimeField()->setConfig('showdropdown', true);

		return $fields;
	}

}