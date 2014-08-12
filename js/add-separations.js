function set_separations_form_submit() {
        $('#separations-form').submit(function() {
		try {
                $.post($(this).attr('action'), $(this).serialize(), function(data) {
			console.log("Returned: " + data);
		} );
		}
		catch (err) {
			console.log("Caught error: " + err.message);
		}
                reload_separationss();
                return false;
        } );
}
function set_separations_button_click() {
	$('#separations-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#separations-view').html(data);
			set_separations_button_click();
			set_separations_form_submit();
		} );
		return false;
	} );
        $('#separations-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#separations-edit').html(data);
                                set_separations_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_separationss();
                }
                return false;
        } );
}
function reload_separationss() {
        $.get($('#add-separations').attr('href'), function(data) {
                $('#separations-view').html(data);
                set_separations_button_click();
                set_separations_form_submit();
        } );
}

