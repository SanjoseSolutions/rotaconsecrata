function set_lo_form_submit() {
        $('#livingOutside-form').submit(function() {
		try {
                $.post($(this).attr('action'), $(this).serialize(), function(data) {
			console.log("Returned: " + data);
		} );
		}
		catch (err) {
			console.log("Caught error: " + err.message);
		}
                reload_los();
                return false;
        } );
}
function set_lo_button_click() {
	$('#livingOutside-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#livingOutside-view').html(data);
			set_lo_button_click();
			set_lo_form_submit();
			set_lo_autocomplete();
		} );
		return false;
	} );
        $('#livingOutside-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#livingOutside-edit').html(data);
                                set_lo_form_submit();
				set_lo_autocomplete();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_los();
                }
                return false;
        } );
}
function reload_los() {
        $.get($('#add-living-outside').attr('href'), function(data) {
                $('#livingOutside-view').html(data);
                set_lo_button_click();
                set_lo_form_submit();
		set_lo_autocomplete();
        } );
}

