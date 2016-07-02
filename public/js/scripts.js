/* Menu Scripts */
$(document).ready(function () {
    var url = window.location;
    $('ul.nav a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
    var loginerr = '<?php echo(flash["error"]); ?>';
    if (loginerr) {
        $('#loginerror').append(
            $('<div/>').append('<?php echo(flash["error"]); ?>').addClass('alert alert-danger')
        ).addClass('form-group');
    };
});