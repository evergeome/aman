
// Listeners /////////////////////////////////////////////////

/** Close Modal and Canvas */
window.addEventListener('close-modal', function () {
    $('.modal').modal('hide');
    resetInput();
});
window.addEventListener('close-canvas', function () {
    $('.offcanvas').offcanvas('hide');
    resetInput();
});

// Away Redirect
window.addEventListener('away', event => {
    window.open(event.detail.url, "_blank");
})

/** Input Masking */
$(function () {
    $('[type="tel"]').keyup(phoneMask);
    $("#username").keypress(usernameMask);
});

/** Scroll Table Horizontal */
$(function (e) {
    const ele = $('.table-responsive');
    ele.css("cursor", "grab");
    ele.scrollTop(0);
    ele.scrollLeft(0);
    let pos = { top: 0, left: 0, x: 0, y: 0 };

    const mouseDownHandler = function (e) {
        ele.css("cursor", "grabbing");
        ele.css("user-select", "none");

        pos = {
            // Get the current ele position
            left: ele.scrollLeft(),
            top: ele.scrollTop(),
            // Get the current mouse position
            x: e.clientX,
            y: e.clientY,
        };

        ele.bind('mousemove', mouseMoveHandler);
        ele.bind('mouseup', mouseUpHandler);
    };

    const mouseMoveHandler = function (e) {
        //ele.css("cursor", "grabbing");
        // How far the mouse has been moved
        const dx = e.clientX - pos.x;
        const dy = e.clientY - pos.y;

        // Scroll the element
        ele.scrollTop(pos.top - dy);
        ele.scrollLeft(pos.left - dx);

        //console.log(pos);
    };

    const mouseUpHandler = function () {
        ele.css("cursor", "grab");
        ele.css("user-select", "");
        ele.unbind('mousemove', mouseMoveHandler);
        ele.unbind('mouseup', mouseUpHandler);
    };

    // Attach the handler
    ele.bind('mousedown', mouseDownHandler);
});

// Functions /////////////////////////////////////////////////

/** Input Reset */
function resetInput() {
    if ($('.input-file').length > 0) {
        $('.input-file').value = "";
    }
    if ($("#date_picker").length > 0) {
        const fp = document.querySelector("#date_picker")._flatpickr;
        $('.flatpickr-day.selected').removeClass('selected');
        $('.flatpickr-day.today').addClass('selected');
        fp.setDate("today");
    }
}
/** File Uploader */
function fileUpload(img) {
    $(img).next().click();
}
/** Prevent Paste */
function preventPaste() {
    $(this).onpaste = e => e.preventDefault();
}

/** Phone */
function phoneMask() {
    var code = $(this).attr('data-code');
    var count = code.length + Number($(this).attr('data-count'));
    var num = $(this).val().replace(/[^0-9+]/g, '');
    $(this).val(
        code
        + (num.length > code.length ? ' ' + num.substring(code.length, count).replace(/^0+/, '') : '')
    );
}
/** Username: Only English and numbers */
function usernameMask(e) {
    var regex = new RegExp("^[a-zA-Z0-9-_.]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
}

/** Scroll to top on pagination */
$(document).on('click', '.page-item', function () {
    $("html, body, .card-body").scrollTop(0);
    return false;
});

/** Copy */
function copyToClipboard(element) {
    event.stopPropagation();
    var text = $(element).prev().find('.data').html();
    navigator.clipboard.writeText($.trim(text.replace("<br>", " - ")));
}

/** Dark Mode */
window.addEventListener('load', (event) => {
    const dark = localStorage.getItem("dark-mode");
    if (dark == 'true') {
        $('body').addClass('dark-mode');
        $('.toggle-dark').addClass('fa-sun').removeClass('fa-moon');
    }
});
function DarkMode() {
    $('body').toggleClass('dark-mode');
    if ($("body").hasClass("dark-mode")) {
        $('.toggle-dark').addClass('fa-sun').removeClass('fa-moon');
        localStorage.setItem("dark-mode", true);
    } else {
        $('.toggle-dark').addClass('fa-moon').removeClass('fa-sun');
        localStorage.setItem("dark-mode", false);
    }
}

