var defaultImage = $('#js-default-image').attr('data-image');
var table;
var number;
$("span.select2.select2-container.select2-container--default").css({"max-width": 950, "width": "100%"});

// Remove menu and run animation content, animation breadcrumb
$(".js-navbar-toggler").click(function() {
    if ($("#menu").hasClass("active")) {
        $("#menu").removeClass("active")
        $(".breadcrumb-top").removeClass("active")
        $("article.content").css({"width" : "calc(100% - 15% - 15px)", "transition" : "0.8s"})
    } else {
        $("#menu").addClass("active")
        $("article.content").css({"width" : "100%", "transition" : "0.8s"})
        $(".breadcrumb-top").addClass("active")
        $(".dataTables_scrollHeadInner").css({"width" : "auto"})
        $("table.table.table-striped.table-bordered.table-sm.dataTable.no-footer").css({"width" : "100%"})
    }

    // If table and reset table
    setTimeout(function() {
         if(table && $('#custom_Table').length === 0) {
            table.columns.adjust().draw();
        }

        // Auto select box then click change menu
        var _select = $("span.select2.select2-container.select2-container--default");
        if($('#menu').hasClass('active')) {
            _select.css({"max-width": 1115, "width": "100%"});
        } else {
            _select.css({"max-width": 950, "width": "100%"});
        }
    }, 810);
})

// Animation hide visiable  panel
$(".js-search-ticket").click(function() {
    if ($(this).hasClass("active")) {
        $(this).removeClass("active")
        $("#js-panel").slideDown("slow");
    } else {
        $(this).addClass("active")
        $("#js-panel").slideUp("slow");
    }
})

// Format input dateTimepicker
if($("#datetimepicker1").attr('id')) {
    for (i = 0; i <= 16; i++) {
        $("#datetimepicker" + i).datetimepicker({
            // defaultDate: new Date(),
            format: "YYYY/MM/DD HH:mm:ss", // Format 24h 2019/12/26 08:52:32
            language: "ja",                 // format language japan
            tooltips: {
                today: '当日へ遷移する',
                clear: '選択をクリアする',
                close: 'ピッカーを閉じる',
                selectMonth: '月を選択する',
                prevMonth: '前月',
                nextMonth: '来月',
                selectYear: '年を選択する',
                prevYear: '前年',
                nextYear: '来年',
                selectDecade: '十年紀を選択する',
                prevDecade: '前の十年紀',
                nextDecade: '次の十年紀',
                prevCentury: '前の世紀',
                nextCentury: '次の世紀'
            }
        });
    }
}

// Format date page receipt-management-edit/create
if($("#datepicker1").attr('id')) {
    for (i = 0; i <= 5; i++) {
        $("#datepicker" + i).datetimepicker({
            format: "YYYY/MM/DD"
        })
    }
}

// Format Time 24h
if($("#startworktime1").attr('id')) {
    for (i = 0; i <= 30; i++) {
        $("#startworktime" + i).datetimepicker({
            format: 'HH:mm' // Formar 23:05
        });
    }
}

// Scroll table list
if($("#dtHorizontalVerticalExample").attr('id') || $(".table.table-striped.table-bordered").hasClass("table-sm")) {
    if($(".wrapper-content").is("#custom_Table")) {
        table = $(".table.table-striped.table-bordered.table-sm").DataTable({
            scrollX: false,
            ordering: false,
            bSort: false
        })
    }else {
        table = $(".table.table-striped.table-bordered.table-sm").DataTable({
            scrollX: true,                  // Set visiable scoll width
            // scrollY: 500,                // Hide scroll y
            language: {
                sEmptyTable: "データがありません。"
            },
            ordering: false,
               // Set height table list
               bPaginate: false,
            bSort: false
        });
    }

    $(".dataTables_length").addClass("bs-select");

    // Reload table and page shop-time hide class
    setTimeout(function() {
        table.columns.adjust().draw();
        $(".js-display-none").hide();

        // Handling in table
        var _customTime = $("label.table-list-item.custom-table-time .dataTables_scrollBody tbody");
        if(_customTime.height() > 420 && _customTime.height() < 488) {
            $("label.table-list-item.custom-table-time .dataTables_scrollBody").css({"width" : "calc(1901px - 17px)"})
        }

        // Hide show text then no data
        if(_customTime.height() === 0) {
            $("label.table-list-item.custom-table-time .dataTables_scrollFoot").show();
        } else {
            $("label.table-list-item.custom-table-time .dataTables_scrollFoot").hide();
        }
    }, 500);
}

// Upload file
$(document).on("change", ".js-uploadfile", function() {
    var file = $(this)[0].files[0];
    var src = $(this).parent().parent().parent().parent();

    // Create read file
    var fileReader = new FileReader();
    fileReader.onload = function() {
        // Search result and import in src image
        var imageSrc = event.target.result;
        src.find(".js-blah").attr("src", imageSrc);
    };

    // Read file result
    fileReader.readAsDataURL(file);
})

// Delete image, setup src, setup input file
$(document).on("click", ".js-delete-file", function() {
    $(this).parent().parent().parent().find(".js-blah").attr("src", defaultImage);
    $(this).parent().find(".js-uploadfile").val("");
})

// Button add record file
$("button.js-add-record").click(function(){
    number = parseInt($("tr.js-add-tr").attr("data-number"));
    if($(".js-number").length > 0) {
        number = $(".js-number").length + 1;
    }
    if(number > 0 && number < 11) {
        $("tr.js-add-tr").clone().appendTo("table.common.add-record").each(function() {
            // Search and change text, replace class
            $(this).find("td")[0].innerText = $(this).attr("data-title").replace("&number", number + 1);
            $(this).removeClass("js-add-tr").attr("data-number", number + 1);
            $(this).addClass("js-number");

            // Add number image
            $(this).find(".js-blah").attr("data-number", number + 1);

            // Add number name input file
            $(this).find("input.js-uploadfile").attr("name", "choose-file-" + (number + 1)).val([]);

            $(this).find("td div#message-error-img" + (number + 1)).remove();
            $(this).find("img").attr("id", "js-blah-" + (number + 1));
            $(this).find("img").attr("src", window.location.origin + "/upload/store/default-store.png");
            $(this).find("input[type='hidden']").attr("name", "image-" + (number + 1));
            $(this).find("p.error").remove();

            // Append button delete tr
            $(this).find("td").eq(1)
             .append("<img src='" + window.location.origin + "/img/icon-cancel.png" + "' alt='cancel-image' class='custom-store-btn-cancel' onclick='removeRow(this)'>")
             .children('.box-image')
             .addClass('float-left');
        });
        $("tr.js-add-tr").attr("data-number", (number + 1));

        // Max length 9 then hide button add row upload image
        if(number === 9) {
            $(this).parent().parent().parent().parent().parent().addClass("d-none");
        }
    }
});

function removeRow(el) {
    // Set number for show button add row upload image
    number =  parseInt($("tr.js-add-tr").attr("data-number")) - 1;
    if(number == 0) {
        number = 1;
        $("tr.common.js-add-tr").attr("data-number", number)
    }else if(number >= 1 && number < 10) {
        $("table.common.fix").removeClass("d-none");
        $("tr.common.js-add-tr").attr("data-number", number)
    }

    // Current row
    var trtmp = $(el).closest("tr");

    // Number row new delete
    var tmp = trtmp.attr("data-number");

    // Loop and update all row upload file
    // Update row next
    while (trtmp.next().length > 0) {
        var tmpNext = trtmp.next();
        tmpNext.attr("data-number", tmp);
        tmpNext.find(".js-img").html("画像" + tmp);
        tmpNext.find(".js-blah").attr("data-number", tmp);
        tmpNext.find("img").attr("id", "js-blah-" + tmp);
        tmpNext.find("input.js-uploadfile").attr("name", "choose-file-" + tmp);
        tmpNext.find("input[type='hidden']").attr("name", "image-" + tmp);
        tmp++;
        trtmp = tmpNext;
    }
    // Remode current row
    $(el).closest("tr").remove();
}

// Set hide show message data
// Set colspan th for resize in table
var numberTh = $("div#custom_Table  thead tr th").length;
$("div#custom_Table tfoot tr th").attr("colspan" , numberTh);
var numberTr = $("div#custom_Table .table-list-item table#dtHorizontalVerticalExample tbody tr.shop").length;
if($("div#custom_Table .table-list-item").hasClass("custom-table-time")) {
    if(numberTr > 1) $("div#custom_Table tfoot").hide();    // Set hide show page shop time
} else {
    if(numberTr > 0) $("div#custom_Table tfoot").hide();    // Set hide show page shop place
}

// Add scroll x on top table
$(function() {
    var tableContainer = $("#js-ticket-actual .dataTables_scrollBody");
    var table = $("#js-ticket-actual .dataTables_scrollBody table");
    var fakeContainer = $("#js-ticket-actual .dataTables_scroll .wrapper1");
    var fakeDiv = $("#js-ticket-actual .dataTables_scroll .wrapper1 .scroll-x");

    // Set width of scroll-x
    var tableWidth = table.width();
    fakeDiv.width(tableWidth);

    // Handle scroll top in table
    fakeContainer.scroll(function() {
        tableContainer.scrollLeft(fakeContainer.scrollLeft());
    });

    // Handle scroll bottom in table
    tableContainer.scroll(function() {
        fakeContainer.scrollLeft(tableContainer.scrollLeft());
    })
  })

// Insert after div dataTables_scrollHead
$("<div class='wrapper1'><div class='scroll-x'></div></div>").insertAfter("#js-ticket-actual .dataTables_scrollHead");

// Set height screen for handle height of select option
var heightScreen = screen.availHeight;
$(".select-options").css({"max-height": heightScreen / 2});

// Sort one row up or down
$(".js-sort .fa-sort-up, .js-sort .fa-sort-down").click(function() {
    var row = $(this).parents("tr:first");
        if ($(this).is(".fa-sort-up")) {
            // Move one row up
            row.insertBefore(row.prev());
        } else {
            // Move one row down
            row.insertAfter(row.next());
        }
})

// Multiple all selectbox
// Search value All and set if choose all
$(".js-select2").on("select2:select", function (e) {
    var data = e.params.data.text;
    if(data=='全て'){
        $(this).find("option").prop("selected","selected");
        $(this).find("option:first-child").prop("selected",false);
        $(this).trigger("change");
    }
});

// Set attr false of value All
$("span.select2-selection.select2-selection--multiple").on('click', function(e) {
    $("li.select2-results__option:first-child").attr("aria-selected", false);
})
