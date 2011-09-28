jQuery(document).ready(function($) {
    if (prettyPrint && typeof prettyPrint === 'function') {
        prettyPrint();
    }

    // Enable dropdown menu
    $('.topbar').dropdown();

    // Figure out which body that should be inited
    var body = $('body');

    if (body.hasClass('cronjob-list')) {
        var activeList = body.find('table.active');
        var inactiveList = body.find('table.inactive');

        body.find('.toggleJob').bind('click', function(e) {
            $.ajax(this.href, {
                context: this,
                success: function(data) {
                    var row = $(this).closest('tr');
                    var currentList = row.closest('table');

                    if (currentList.hasClass('active')) {
                        inactiveList.prepend(row);
                        $(this).removeClass('danger').addClass('primary').text('Enable');
                    } else {
                        activeList.prepend(row);
                        $(this).removeClass('primary').addClass('danger').text('Disable');
                    }
                }
            });

            e.preventDefault();
        });
    }
});
