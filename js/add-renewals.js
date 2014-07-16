function set_renewal_form_submit() {
        $('#renewals-form').submit(function() {                                                   
                $.post($(this).attr('action'), $(this).serialize());                              
                reload_renewals();
                return false;
        } );
}
function set_renewal_button_click() {
	$('#renewals-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#renewals-view').html(data);
			set_renewal_button_click();
			set_renewal_form_submit();
		} );
		return false;
	} );
        $('#renewals-grid td.button-column a').click(function() {                                 
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {                              
                                $('#renewal-edit').html(data);
                                set_renewal_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));                                             
                        reload_renewals();
                }
                return false;                                                                     
        } );
}
function reload_renewals() {                                                                          
        $.get($('#add-renewals').attr('href'), function(data) {                                       
                $('#renewals-view').html(data);
                set_renewal_button_click();
                set_renewal_form_submit();
        } );
}

