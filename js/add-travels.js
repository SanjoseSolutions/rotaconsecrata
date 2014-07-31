function set_travel_form_submit() {
        $('#travels-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_travels();
                return false;
        } );
}
function set_travel_button_click() {
	$('#travels-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#travels-view').html(data);
			set_travel_button_click();
			set_travel_form_submit();
		} );
		return false;
	} );
        $('#travels-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#travels-edit').html(data);
                                set_travel_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_travels();
                }
                return false;
        } );
}
function reload_travels() {
        $.get($('#add-travels').attr('href'), function(data) {
                $('#travels-view').html(data);
                set_travel_button_click();
                set_travel_form_submit();
        } );
}

