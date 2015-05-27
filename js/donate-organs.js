$(document).ready(function() {
  $('#Members_donate_organs').change(function(e) {
    if (this.checked) {
      $('#organs-div').show();
    } else {
      $('#organs-div input:checkbox').each(function(i, e) { e.checked = false; } );
      $('#organs-div').hide();
    }
  } );
  $('#Members_donate_organs').each(function(i, e) { if (!e.checked) $('#organs-div').hide(); } );
} );
