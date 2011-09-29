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

    if (body.hasClass('cronjob-create')) {
        var compoundField = body.find('#compound');
        var timeFields = body.find('.timeFragment');

        compoundField.bind('keyup change', function() {
            // Validate input

            // Update fragmented values
            var fieldsData = compoundField.val().split(' ');

            timeFields.each(function(i, el) {
                $(el).val(fieldsData[i]);
            });
        });

        timeFields.bind('keyup', function() {
            // Validate input

            // Update compound value
            var newCompound = '';

            timeFields.each(function(i, el) {
                newCompound += $(el).val() + ' ';
            });

            compoundField.val(newCompound.trim());
        });

        body.find('ul.typical-intervals a').twipsy({placement: 'right'}).bind('click', function() {
            compoundField.val($(this).data('format'));
            compoundField.trigger('change');
        });
    }
});
