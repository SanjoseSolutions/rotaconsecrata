function set_academic_course_form_submit(course) {
        $('#'+course+'Courses-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_academic_courses(course);
                return false;
        } );
}

function set_academic_course_button_click(course) {
	$('#'+course+'Courses-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#'+course+'Courses-view').html(data);
			set_academic_course_button_click(course);
			set_academic_course_form_submit(course);
		} );
		return false;
	} );
	console.log("Connecting "+course+" button");
        $('#'+course+'Courses-grid td.button-column a').click(function() {
		console.log('Course link clicked for url:'+$(this).attr('href'));
                if ($(this).hasClass('update')) {
			console.log("Update clicked");
                        $.get($(this).attr('href'), function(data) {
                                $('#'+course+'Courses-edit').html(data);
                                set_academic_course_form_submit(course);
                        } );
                } else {
			console.log("Not update must be delete");
                        $.post($(this).attr('href'));
                        reload_academic_courses(course);
                }
                return false;
        } );
}

function reload_academic_courses(course) {
        $.get($('#add-'+course+'-courses').attr('href'), function(data) {
                $('#'+course+'Courses-view').html(data);
                set_academic_course_button_click(course);
                set_academic_course_form_submit(course);
        } );
}

