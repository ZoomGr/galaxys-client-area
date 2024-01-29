function isEmailValid(email) {
    var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return emailRegex.test(email);
}

function formatPhoneNumber(number) {
    let match = number.match(/^(\d{3})(\d{2})(\d{2})(\d{2})(\d{2})$/);

    if (match) {
        return "(+" + match[1] + ") " + match[2] + " " + match[3] + " " + match[4] + " " + match[5];
    };

    return null
}

function numberWithSeparator(value, separator) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, separator);
}

function getOnlyNumbers(str) {
    return str.replace(/[^\d]/g, '');
}

function dynamicAppendInit() {
    $("[data-append]").each(function () {
        let [mediaSize, appendBlockClass] = $(this).attr("data-append").split(", ");

        if ($(window).width() < mediaSize) {
            !$(appendBlockClass).children($(this).attr("class")).length && $(this).appendTo(appendBlockClass);
        }
    });
}

function makeSticky(selector) {
    let element = $(selector);
    let elementOffsetTop = element.offset().top;
    let scrollTop = $(document).scrollTop();

    $(document).bind("ready scroll", function () {
        scrollTop = $(document).scrollTop();

        if (scrollTop >= elementOffsetTop) {
            element.addClass("sticky-element");
        } else {
            element.removeClass("sticky-element");
        }
    });
}

function tabsInit() {
    $(".tab").on("click", function () {
        let contentId = $(this).attr("data-tab");

        $(this).closest(".tabs__control").find(".tab").removeClass("active");
        $(this).closest(".tabs__control").find(".tab__action").addClass("hide");
        $(this).addClass("active");

        $(this).closest(".tabs").find(".tabs__content").eq(0).children(".tab-content").removeClass("active");
        $("#" + contentId).addClass("active");
        $(`[data-tab-action='${contentId}']`).removeClass("hide");
    });

    $("[data-trigger-tab]").on("click", function() {
        $(`[data-tab='${$(this).attr("data-trigger-tab")}']`).click();
    });
}

function getNewMessagesCount() {
    setInterval(() => {
        $.ajax({
            method: "GET",
            url: "/users/get-chat-new-messages",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            type: "GET",
            success: function ({ messages }) {
                let badgeElem = $(".messages-badge").find(".header-badge__wrap");

                if(messages > 0) {
                    if(!badgeElem.find(".header-badge__count").length) {
                        badgeElem.append(`<div class="header-badge__count">${messages}</div>`);
                    } else {
                        badgeElem.find(".header-badge__count").text(messages);
                    }
                    $(".new-messages-count").removeClass("dn");
                    $(".new-messages-count").text(messages);
                } else {
                    if(badgeElem.find(".header-badge__count").length) {
                        badgeElem.find(".header-badge__count").remove();
                    }
                    if(!$(".new-messages-count").hasClass("dn")) {
                        $(".new-messages-count").addClass("dn");
                    }
                }
            },
            error: function (err) {
                toastMessage(err, 'error');
            },
        });
    }, 15000);
}

function generateId(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
    }
    return result;
}

function toastMessage(message, type = "default", manualRemove = false) {
    let toastContainer = `<div class="toast-messages"></div>`;
    const toastId = generateId(7);
    const imgSrc = type === "error" ? "warning" : "success";

    let toastBody = `
    <div class="toast-message ${type}" data-toast-id="${toastId}">
        ${
            type !== 'default' ?
            `<div class="toast-message-icon">
                <img src="assets/img/${imgSrc}.svg" alt="${imgSrc}">
            </div>` : ''
        }
        <span class="toast-message-text text-20 font-medium color-black-80">${message}</span>
    </div>`;

    if (!$(".toast-messages").length) {
        $("main").append(toastContainer);
    }
    $(".toast-messages").append(toastBody);

    if(manualRemove) {
        return toastId;
    } else {
        autoRemoveToast(toastId);
    }
}

async function downloadFilesZip(urls, title = 'Media Files.zip', messageToastId = false) {
    let zip = new JSZip();

    // Wait until all files added to zip
    await Promise.all(urls.map((url) => fetch(url.download))).then((res) => {
        res.forEach((file, index) => {
            const resBlob = file.blob();
            zip.file(urls[index].filename, resBlob);
        });
    });

    // Download Zip
    zip.generateAsync({ type: "blob" }).then(function(content) {
        saveAs(content, title);
    });
    if(messageToastId) {
        removeToast(false, messageToastId);
    }
}

function getFileExtensionByName(filename) {
    return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
}

function writeClipboardText(text, successMessage) {
    try {
        navigator.clipboard
            .readText().then(async (clipboardText) => {
                if(clipboardText !== text) {
                    try {
                        await navigator.clipboard
                            .writeText(text)
                                .then(() => {
                                    toastMessage(successMessage, 'success')
                                });
                    } catch (error) {
                        toastMessage('Something went wrong!', 'error');
                    }
                }
            },
        );
    } catch (error) {
        toastMessage('Something went wrong!', 'error');
    }
}

function autoRemoveToast(id) {
    new Promise(function (resolve, reject) {
        setTimeout(function () {
            $(`[data-toast-id="${id}"]`).addClass("toast-message_hidden");
            resolve();
        }, 4000);
    }).then(function () {
        setTimeout(function () {
            $(`[data-toast-id="${id}"]`).remove();

            if ($(".toast-message").length == 0) {
                $(".toast-messages").remove();
            }
        }, 500);
    });
}

function removeToast(closeElement, id) {
    if (!id) {
        let toast = closeElement.closest(".toast-message");

        toast.addClass("toast-message_hidden");

        setTimeout(function () {
            toast.remove();
        }, 500);
    } else {
        $(`[data-toast-id="${id}"]`).addClass("toast-message_hidden");

        setTimeout(function () {
            $(`[data-toast-id="${id}"]`).remove();
        }, 500);
    }
}

function getDocumentVisibleWidth() {
    return Math.max(
        document.body.scrollWidth, document.documentElement.scrollWidth,
        document.body.offsetWidth, document.documentElement.offsetWidth,
        document.body.clientWidth, document.documentElement.clientWidth
    );
}

function scrollNone() {
    let scrollWidthBeforeFreeze = getDocumentVisibleWidth();

    if ($(".modal, .popover-container").hasClass("active")) {
        $("body").addClass("locked");

        let scrollWidthAfterFreeze = getDocumentVisibleWidth();
        
        if(scrollWidthBeforeFreeze < scrollWidthAfterFreeze) {
            let scrollSpace = scrollWidthAfterFreeze - scrollWidthBeforeFreeze;

            $("body").css("padding-right", scrollSpace + "px");
        }
    } else {
        $("body").removeClass("locked");
        $("body").css("padding-right", '');

        if($("body").attr("style") === "") {
            $("body").removeAttr("style");
        }
        if($("body").attr("class") === "") {
            $("body").removeAttr("class");
        }
    }
}