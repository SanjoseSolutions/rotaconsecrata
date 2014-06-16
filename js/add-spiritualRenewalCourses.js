function set_spiritual_course_form_submit() {
        $('#spiritualRenewalCourses-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_spiritual_courses();
                return false;
        } );
}
function set_spiritual_course_button_click() {
	$('#spiritualRenewalCourses-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#spiritualRenewalCourses-view').html(data);
			set_spiritual_course_button_click();
			set_spiritual_course_form_submit();
		} );
		return false;
	} );
        $('#spiritualRenewalCourses-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#spiritualRenewalCourses-edit').html(data);
                                set_spiritual_course_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_spiritual_courses();
                }
                return false;
        } );
}
function reload_spiritual_courses() {
        $.get($('#add-spiritual-courses').attr('href'), function(data) {
                $('#spiritualRenewalCourses-view').html(data);
                set_spiritual_course_button_click();
                set_spiritual_course_form_submit();
        } );
}

