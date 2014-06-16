function set_form_submit() {
        $('#siblings-form').submit(function() {                                                   
                $.post($(this).attr('action'), $(this).serialize());                              
                reload_sibs();
                return false;
        } );
}
function set_button_click() {                                                                     
        $('#siblings-grid td.button-column a').click(function() {                                 
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {                              
                                $('#sib-edit').html(data);
                                set_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));                                             
                        reload_sibs();
                }
                return false;                                                                     
        } );
}
function reload_sibs() {                                                                          
        $.get($('#add-sibs').attr('href'), function(data) {                                       
                $('#siblings-view').html(data);
                set_button_click();
                set_form_submit();
        } );
}

