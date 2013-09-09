<?php

class LatestBlogs extends Widget {
	static $db = array(
		"WidgetTitle" => "Varchar(255)",
		"NumberToShow" => "Int",
		"Show" => "Enum('All,Events only,No events,Future events,Past events','All')"
	);

	static $defaults = array(
		"NumberToShow" => 10
	);


	static $title = "Latest Blogs";
	static $cmsTitle = "Latest Blogs";
	static $description = "Shows latest posts across all blogs";

	function LatestPosts() {
		$filter = "";
		switch($this->Show) {
			case 'Events only':
				$filter = "`EventStart` IS NOT NULL OR `EventEnd` IS NOT NULL";
			break;
			case 'No events':
				$filter = "`EventStart` IS NULL AND `EventEnd` IS NULL";
			break;
			case 'Future events':
				$filter = "`EventStart` >= NOW() OR `EventEnd` >= NOW()";
			break;
			case 'Past events':
				$filter = "`EventStart` <= NOW() OR `EventEnd` <= NOW()";
			break;
			default:
				$filter = "";
			break;
		}
		$entries = DataObject::get("BlogEntry", $filter, "Date DESC", "", $this->NumberToShow);
		return $entries;
	}

	function Title() {
		return $this->WidgetTitle ? $this->WidgetTitle : self::$title;
	}

	function getCMSFields() {
		return new FieldSet(
			new TextField("WidgetTitle", "Title"),
			new NumericField("NumberToShow", "Number posts to Show"),
			new DropdownField("Show", "Show", $this->dbObject('Show')->enumValues())
		);
	}
}

?>