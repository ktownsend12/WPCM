<?PHP

//replaces one (1) new-line in a text with <br> tag
//replaces two (2) new-lines in a text with </p><p> tags.
//this assumes that the text will be put inside <p> tags in the page where it will be displayed.
function text2html($text)
{
	$text = str_replace("\r\n\r\n","</p><p>",$text);
	$text = str_replace("\r\n","<br/>",$text);
	return $text;
}

//Triggered by shortcode wpcm_lecturers (defined in wp-course-manager.php)
function WPCM_list_lecturers($content=null) {
	$lecturer = $_REQUEST['lecturer'];	
	
	if ($lecturer) {
		$output = WPCM_show_one_lecturer($lecturer);
	}
	else {
		$output = WPCM_list_all_lecturers();
	}
	return $output;
}	


function WPCM_list_all_lecturers() {
	$lecturers = get_lecturers();

	$output = "<div class='WPCM_content WPCM_lecturers'>";	
	$output .= "<ul>";
	
	foreach ($lecturers as $l) {
		$output .= "<li><a href='?lecturer=$l->id'>$l->name</a></li>";		
		
		}

	$output .= "</ul>";
	$output .= "</div>";	
	
	return $output;
	}
	
function WPCM_show_one_lecturer($id) {
	$lecturers = get_lecturers($id);
	$courses = get_lecturers_courses($id);
	
	$name = stripslashes($lecturers[0]->name);
	$image = $lecturers[0]->image;
	$description = text2html(stripslashes($lecturers[0]->description));
	$url = $lecturers[0]->url;
	
	
	$output = "<div class='WPCM_content WPCM_lecturers'>";
	
	$output .= "<h2>".$name."</h2>";		
	$output .= "<div id='WPCM_lecturer_image'>";
	$output .= "<img src='".$image."' alt='".__("Portrait of the lecturer")."' title='".$name."' />";
	$output .= "</div>";
	$output .= "<p>";
	$output .= $description;
	$output .= "</p>";
	$output .= "<div>";
	$output .= __("Home page").": <a href='". $url ."' target='_blank' title='".$url."'>".$url."</a>";
	$output .= "</div>";
	
	$output .= "<h3>".__("Courses")."</h3>";
	$output .= "<p>" . $name . " " . __("holds the following courses:") ."</p>";
	$output .= "<ul>";
	foreach ($courses as $course)
	{
		$output .= "<li><a href=\"?course=$course->id\" title=\"$course->title\">$course->title</a></li>";
	}
	$output .= "</ul>";
	
	$output .= "</div>";	
		
	return $output;
	
	}	
	
//Triggered by shortcode wpcm_courses (defined in wp-course-manager.php)
function WPCM_list_courses($conten=null){
	return "ToDo: List all courses.";	
	}	

//Triggered by shortcode wpcm_schedule (defined in wp-course-manager.php)
function WPCM_list_schedule($content=null){
	return "ToDo: List the schedule.";
	
	}
	
	
?>