function set_academic_course_form_submit() {
        $('#academicCourses-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_academic_courses();
                return false;
        } );
}
function set_academic_course_button_click() {
	$('#academicCourses-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#academicCourses-view').html(data);
			set_academic_course_button_click();
			set_academic_course_form_submit();
		} );
		return false;
	} );
        $('#academicCourses-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#academicCourses-edit').html(data);
                                set_academic_course_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_academic_courses();
                }
                return false;
        } );
}
function reload_academic_courses() {
        $.get($('#add-academic-courses').attr('href'), function(data) {
                $('#academicCourses-view').html(data);
                set_academic_course_button_click();
                set_academic_course_form_submit();
        } );
}

