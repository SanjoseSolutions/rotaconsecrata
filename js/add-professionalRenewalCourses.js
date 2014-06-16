function set_professional_course_form_submit() {
        $('#professionalRenewalCourses-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_professional_courses();
                return false;
        } );
}
function set_professional_course_button_click() {
	$('#professionalRenewalCourses-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#professionalRenewalCourses-view').html(data);
			set_professional_course_button_click();
			set_professional_course_form_submit();
		} );
		return false;
	} );
        $('#professionalRenewalCourses-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#professionalRenewalCourses-edit').html(data);
                                set_professional_course_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_professional_courses();
                }
                return false;
        } );
}
function reload_professional_courses() {
        $.get($('#add-professional-courses').attr('href'), function(data) {
                $('#professionalRenewalCourses-view').html(data);
                set_professional_course_button_click();
                set_professional_course_form_submit();
        } );
}

