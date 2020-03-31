$(document).ready(function () {
    $('#btnSearch').click(function (e) {
        e.preventDefault();
        $('#search').click();
    });

    $('#dtHorizontalVerticalExample1').dataTable({
        destroy: true,
        language: {
            emptyTable: "データがありません。"
        },
        ordering: false,
        scrollX: true,
        bSort: false,
        bPaginate: false,
        searching: false,
        bInfo: false
    });

    $('#submitData').click(function () {
        $(this).addClass('btn-disabled');
    });

    $('input.allow-integer').keyup(function() {
        if (/\D/g.test(this.value)) {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });

    $('#upload-file-banner').click(function (e) {
        e.preventDefault();
        $('#js-uploadfile').click();
    });
    // Master-item: sort one row up or down
    $(".js-sort .fa-sort-up, .js-sort .fa-sort-down").off('click').on('click', function () {
        let current = $(this);
        let moveArr = $(this).attr('id').split('-');
        let row = $(this).parents("tr:first");
        let upIdCurrent = row.find('.fa-sort-up').attr('id');
        let downIdCurrent = row.find('.fa-sort-down').attr('id');
        let classRowCurrent = row.attr('class');
        let classMoveCurrent = $(this).attr('class');
        $(this).attr('class', classMoveCurrent + ' btn-disabled');
        if (moveArr[2] != '') {
            $.ajax({
                type: 'POST',
                url: window.location.origin + '/master-item/moveMasterItem',
                data: {
                    move: moveArr,
                    _csrfToken: $('.master-item').data('csrf')
                },
                success: function () {
                    if (moveArr[0] == 'up') {
                        if (moveArr[3]) {
                            // Redirect prev page at first row when not page first
                            window.location.href = $('.table-list-item .pagination-list ul li').find('.active-paginate').parent().prev().find('a').attr('href');
                        } else {
                            // Move one row up
                            row.insertBefore(row.prev());

                            row.find('.fa-sort-up').attr('id', row.next().find('.fa-sort-up').attr('id'));
                            row.find('.fa-sort-down').attr('id', row.next().find('.fa-sort-down').attr('id'));
                            row.attr('class', row.next().attr('class'));

                            row.next().find('.fa-sort-up').attr('id', upIdCurrent);
                            row.next().find('.fa-sort-down').attr('id', downIdCurrent);
                            row.next().attr('class', classRowCurrent);
                        }
                    } else {
                        if (moveArr[3]) {
                            // Redirect next page at final row when not page final
                            window.location.href = $('.table-list-item .pagination-list ul li').find('.active-paginate').parent().next().find('a').attr('href');
                        } else {
                            // Move one row down
                            row.insertAfter(row.next());

                            row.find('.fa-sort-up').attr('id', row.prev().find('.fa-sort-up').attr('id'));
                            row.find('.fa-sort-down').attr('id', row.prev().find('.fa-sort-down').attr('id'));
                            row.attr('class', row.prev().attr('class'));

                            row.prev().find('.fa-sort-up').attr('id', upIdCurrent);
                            row.prev().find('.fa-sort-down').attr('id', downIdCurrent);
                            row.prev().attr('class', classRowCurrent);
                        }
                    }
                    current.attr('class', classMoveCurrent);
                }
            });
        } else {
            current.attr('class', classMoveCurrent);
        }
    });
});

// Store: update listImageName when deleted row
function deleteImageName(e) {
    let list = $('#js-store-list-image');
    let data = list.val().split(' ');
    let pos = $(e).parent().parent().parent().attr('data-number');
    data.splice(parseInt(pos-1), 1);
    $('input[name=listImageName]').val(data.join(' '));
    list.val(data.join(' '));
}

// Count length width of string
function mbStrWidth(input) {
    let len = 0;
    for (let i = 0; i < input.length; i++) {
        let code = input.charCodeAt(i);
        if ((code >= 0x0020 && code <= 0x1FFF) || (code >= 0xFF61 && code <= 0xFF9F)) {
            len += 1;
        } else if ((code >= 0x2000 && code <= 0xFF60) || (code >= 0xFFA0)) {
            len += 2;
        } else {
            len += 0;
        }
    }
    return len;
}
