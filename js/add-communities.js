function set_comm_form_submit() {
        $('#community-terms-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_comms();
                return false;
        } );
}
function set_comm_button_click() {
	$('#communities-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#communities-view').html(data);
			set_comm_button_click();
			set_comm_form_submit();
			set_comm_autocomplete();
		} );
		return false;
	} );
        $('#communities-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#communities-edit').html(data);
                                set_comm_form_submit();
				set_comm_autocomplete();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_comms();
                }
                return false;
        } );
}
function reload_comms() {
        $.get($('#add-comms').attr('href'), function(data) {
                $('#communities-view').html(data);
                set_comm_button_click();
                set_comm_form_submit();
		set_comm_autocomplete();
        } );
}

