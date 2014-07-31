function set_book_written_form_submit() {
        $('#booksWritten-form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize());
                reload_books_written();
                return false;
        } );
}
function set_book_written_button_click() {
	$('#booksWritten-grid a.sort-link').click(function() {
		$.get($(this).attr('href'), function(data) {
			$('#booksWritten-view').html(data);
			set_book_written_button_click();
			set_book_written_form_submit();
		} );
		return false;
	} );
        $('#booksWritten-grid td.button-column a').click(function() {
                if ($(this).hasClass('update')) {
                        $.get($(this).attr('href'), function(data) {
                                $('#booksWritten-edit').html(data);
                                set_book_written_form_submit();
                        } );
                } else {
                        $.post($(this).attr('href'));
                        reload_books_written();
                }
                return false;
        } );
}
function reload_books_written() {
        $.get($('#add-books-written').attr('href'), function(data) {
                $('#booksWritten-view').html(data);
                set_book_written_button_click();
                set_book_written_form_submit();
        } );
}

