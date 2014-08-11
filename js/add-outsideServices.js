function set_os_form_submit() {
        $('#outsideServices-form').submit(function() {
		try {
                $.post($(this).attr('action'), $(this).serialize(), function(data) {
			console.log("Returned: " + data);
		} );
		}
		catch (err) {
			console.log("Caught error: " + err.message);
		}
                reload_oss();
                return false;
        } );
}
function set_os_button_click() {
	$('#outsideServices-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#outsideServices-view').html(data);
			set_os_button_click();
			set_os_form_submit();
			set_os_autocomplete();
		} );
		return false;
	} );
        $('#outsideServices-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#outsideServices-edit').html(data);
                                set_os_form_submit();
				set_os_autocomplete();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_oss();
                }
                return false;
        } );
}
function reload_oss() {
        $.get($('#add-outside-services').attr('href'), function(data) {
                $('#outsideServices-view').html(data);
                set_os_button_click();
                set_os_form_submit();
		set_os_autocomplete();
        } );
}

