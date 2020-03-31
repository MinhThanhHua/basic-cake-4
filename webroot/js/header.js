// Handle select common
if ($('select').hasClass("js-select2")) {
    $('.js-select2').select2(); // Select multiple
}

$('select:not(.js-select2):not(.js-example-basic-single)').each(function () {
    var $this = $(this), numberOfOptions = $(this).children('option').length;
    $this.addClass('select-hidden');
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');
    var $styledSelect = $this.next('div.select-styled');
    $styledSelect.append($("<p>"));
    $styledSelect.find('p').text($this.find(":selected").text());

    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);

    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val(),
            class: $this.children('option').eq(i).attr('class')
        }).appendTo($list);
    }

    var $listItems = $list.children('li');

    $styledSelect.click(function (e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function () {
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });

    $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.append("<p>").html("<p>" + $(this).text() + "</p>").removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
    });

    $(document).click(function () {
        $styledSelect.removeClass('active');
        $list.hide();
    });
});

// Handle add record in to a seller management page
$(document).ready(function () {

    $("button.js-btn-left").click(function () {
        var number = parseInt($("tr.js-add-tr").attr("data-number"));
        if (number < 10) {
            var numberInput = number + 1;
            $("tr.js-add-tr").clone().appendTo("table.common").each(function () {
                $(this).find("td")[0].innerText = $(this).attr("data-title").replace("&number", number + 1);
                $(this).removeClass("js-add-tr").attr("data-number", number + 1);

                $(this).find(".js-number-input").attr("name", "item_name" + numberInput).val('');
                $(this).find(".js-number-input").removeClass("error");

                $(this).find(".js-number-textarea").attr("name", "item_note" + numberInput).val('');
                $(this).find(".js-number-textarea").removeClass("error");

                $(this).find(".js-number-checkbox").attr("name", "checkbox" + numberInput).prop("checked", true);
                $(this).find(".js-number-checkbox").removeClass("error");

                $(this).find("td p").remove();
            });
            $("tr.js-add-tr").attr("data-number", number + 1);
            if ((number + 1) >= 10) {
                $("button.js-btn-left").css('opacity', '0.5');
                $("button.js-btn-left").attr('disabled', 'true');
            }
        }
    });
    if ($('div.seller-input-checkbox input[name="item_name10"]').val()
        || $('.common textarea[name="item_note10"]').val()
        || $('div.seller-input-checkbox input[name="item_name10"]').hasClass("js-number-input") == true)
    {
        $("button.js-btn-left").css('opacity', '0.5');
        $("button.js-btn-left").attr('disabled', 'true');
    }

    // Handle add record to the shop management time page
    var count2 = 4;
    $("button.js-btn-left-shop").click(function () {
        var number = parseInt($("tr.js-add-tr-shop").attr("data-number"));
        var numberInput = number + 1;
        count2++;

        $("tr.js-add-tr-shop").clone().appendTo("table.shop-management-time tbody").each(function () {
            // Remove class display-none after add
            $(this).show();
            $(this).removeClass("js-display-none");
            $(this).removeClass("js-add-tr-shop").attr("data-number", number + 1);
            $(this).find(".js-input-amount-child").attr("name", "input-amount-child-" + numberInput);
            $(this).find(".js-input-amount-adult").attr("name", "input-amount-adult-" + numberInput);

            // Set color after clone tr
            if (number % 2 != 0) {
                $(this).addClass("odd");
                $(this).removeClass("even");
            } else {
                $(this).addClass("even");
                $(this).removeClass("odd");
            }

            // Set name, id, data-target start time
            $(this).find(".js-input-start-time").attr("name", "input-start-" + numberInput);
            $(this).find("div.input-group.start-time").attr("id", "datetimepicker-start-" + numberInput);
            $(this).find(".js-input-start-time").attr("data-target", "#datetimepicker-start-" + numberInput);
            $(this).find("div.input-group-append.start-time").attr("data-target", "#datetimepicker-start-" + numberInput);

            // Set name, id, data-target end time
            $(this).find(".js-input-end-time").attr("name", "input-end-" + numberInput);
            $(this).find("div.input-group.end-time").attr("id", "datetimepicker-end-" + numberInput);
            $(this).find(".js-input-end-time").attr("data-target", "#datetimepicker-end-" + numberInput);
            $(this).find("div.input-group-append.end-time").attr("data-target", "#datetimepicker-end-" + numberInput);

            // Format 'hh:mm'
            $("#datetimepicker-start-" + count2).datetimepicker({format: 'HH:mm:ss'});
            $("#datetimepicker-end-" + count2).datetimepicker({format: 'HH:mm:ss'});
        });
        $("tr.js-add-tr-shop").attr("data-number", number + 1);

        // Click hide then data
        $("div#custom_Table tfoot").hide();


    });

    // DELETE record
    $(document).on("click", ".js-btn-delete", function () {
        var trDelete = $(this).parent().parent();
        $(".js-delete-record").click(function () {
            trDelete.remove();

            // Set message not data in table
            var numberTh = $("div#custom_Table  thead tr th").length;
            $("div#custom_Table tfoot tr th").attr("colspan", numberTh);
            var numberTr = $("div#custom_Table .table-list-item table#dtHorizontalVerticalExample tbody tr.shop").length;
            if (numberTr === 1) {
                // Delete row last then show message
                $("div#custom_Table tfoot").show();
            }
        });
    });
});
