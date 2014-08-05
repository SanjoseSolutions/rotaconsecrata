function set_multi_field_data_form_submit(fld) {
        $('#'+fld+'-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_multi_field_data(fld);
                return false;
        } );
}
function set_multi_field_data_button_click(fld) {
	$('#'+fld+'-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#'+fld+'-view').html(data);
			set_multi_field_data_button_click(fld);
			set_multi_field_data_form_submit(fld);
		} );
		return false;
	} );
        $('#'+fld+'-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#'+fld+'-edit').html(data);
                                set_multi_field_data_form_submit(fld);
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_multi_field_data(fld);
                }
                return false;
        } );
}
function reload_multi_field_data(fld) {
        $.get($('#add-'+fld).attr('href'), function(data) {
                $('#'+fld+'-view').html(data);
                set_multi_field_data_button_click(fld);
                set_multi_field_data_form_submit(fld);
        } );
}

