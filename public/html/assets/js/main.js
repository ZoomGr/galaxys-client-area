$(document).ready(function () {
    tabsInit();
    dynamicAppendInit();

    $(".header-badge").each(function () {
        if ($(this).find(".header-badge__dropdown")) {
            $(this).find(".header-badge__wrap").on("click", function () {
                $(this).closest(".header-badge").toggleClass("open");
            });
        }
    });

    $(".profile__wrap").on("click", function () {
        $(this).closest(".profile").toggleClass("active");
    });

    $(".properties__target").on("click", function() {
        $(this).closest(".properties").toggleClass("active");
    });

    $(".game-card__action").on('click', function(e) {
        e.preventDefault();
    });

    if ($(".tags").length) {
        $(".tags").each(function () {
            let hasHiddenTags = false;
            let hiddenTagsCount = 0;
            let tagHeight = $(this).find(".tag").eq(0).height();

            $(this).find(".tag").each(function () {
                if ($(this).position().top >= tagHeight) {
                    $(this).addClass("dn");
                    hiddenTagsCount++;
                    hasHiddenTags = true;
                }
            });

            if (hasHiddenTags) {
                $(this).find(".tags__wrap").append(`<div class="tag tag_counter">+${hiddenTagsCount}</div>`);

                if ($(this).find(".tag_counter").position().top >= tagHeight) {
                    $(this).find(".tag.dn").eq(0).prev().addClass("dn");
                    $(this).find(".tag_counter").text("+" + (hiddenTagsCount + 1));
                }
            }
        });
    }

    if($(".media-table").length) {
        $(".media-date-sort").on("click", function() {
            $(this).toggleClass("active");
        });
    
        $(".media-table__file").on("click", function() {
            toggleFileSelected(!$(this).hasClass("selected"), $(this));

            if(!isAllFilesSelected()) {
                $(".media-select-all input").prop("checked", false);
            } else {
                $(".media-select-all input").prop("checked", true);
            }
        });
    
        $(".media-select-all input").on("change", function() {
            const table = $(this).closest(".media-table");
            const files = table.find(".media-table__file");
            const isChecked = $(this).prop("checked");

            files.each(function() {
                toggleFileSelected(isChecked, $(this));
            });
        });

        $(".media-download-selected").on("click", function() {
            const fileLinks = $(this).attr("data-files")?.split(", ");

            if(fileLinks) {
                let urls = fileLinks.map((link) => {
                    let filename = $(`.media-download[href="${link}"]`).closest(".media-table__file").find(".media-table__name > span").text().split(".")[0]
    
                    return {
                        download: link,
                        filename,
                    }
                });
    
                urls.forEach(function (e) {
                    fetch(e.download)
                      .then(res => res.blob())
                      .then(blob => {
                        saveAs(blob, e.filename);
                    });
                });
            }

        });

        function toggleFileSelected(condition, target) {
            let restFiles = $(".media-download-selected").attr("data-files");
            let thisFile = target.find(".media-download").attr("href");

            if(condition) {
                target.addClass("selected");
                target.find(".media-table__name input").prop("checked", true);

                if(restFiles) {
                    $(".media-download-selected").attr("data-files", restFiles + ", " + thisFile);
                } else {
                    $(".media-download-selected").attr("data-files", thisFile);
                }
            } else {
                target.removeClass("selected");
                target.find(".media-table__name input").prop("checked", false);

                let filteredFiles = restFiles.split(", ").filter(file => file !== thisFile).join(", ");
                $(".media-download-selected").attr("data-files", filteredFiles);
            }

            setSelectedFilesCounter();
        }

        function isAllFilesSelected() {
            let allChecked = true;

            $(".media-table__file").each(function() {
                if(!$(this).find(".media-table__name input").prop("checked")) {
                    allChecked = false;
                }
            });

            return allChecked;
        }

        function setSelectedFilesCounter() {
            let counter = $(".media-table__file.selected").length;

            if(counter) {
                $(".media-files__selected").css("display", "block").text(`${counter} selected`);
                $(".media-files__download-btn").addClass("selected");
            } else {
                $(".media-files__selected").css("display", "none").text(`${counter} selected`);
                $(".media-files__download-btn").removeClass("selected");
            }
        }
    }

    // MODAL ***************************
    $("[data-modal]").on("click", function () {
        let targetModal = $(`.${$(this).attr("data-modal")}`);
        targetModal.addClass("active");

        scrollNone();
    });

    $(".modal-close").on("click", function () {
        $(this).closest(".modal").removeClass("active");

        scrollNone();
    });

    $(".selectable-download").each(function () {
        $(this).find("select").on("change", function () {
            let val = $(this).val()
            let selectedOption = $(this).find(`[value="${val}"]`);
            let thisLink = selectedOption.attr("data-link");

            $(this).closest(".selectable-download").find(".selectable-download__trigger").attr("href", thisLink);
        });
    });

    if ($(".countdown").length) {
        let dateAttr = $(".countdown").attr("data-date");
        var countDownDate = new Date(dateAttr).getTime();

        let countdownInterval = setInterval(function () {
            let now = new Date().getTime();

            let distance = countDownDate - now;

            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance < 0) {
                clearInterval(countdownInterval);
                $(".countdown__wrap").removeClass("loading");
            } else {
                $("#promo-days").text(days);
                $("#promo-hours").text(hours);
                $("#promo-minutes").text(minutes);
                $("#promo-seconds").text(seconds);
                $(".countdown__wrap").removeClass("loading");
            }
        }, 1000);
    }

    // TOAST ****************************
    $(".toast-trigger").on("click", function () {
        toastMessage("Toast Message", "default");
    });

    // DATEPICKER ************************
    if($(".event-datepicker").length) {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const dayNamesMin = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        $(".event-datepicker").datepicker({
            dateFormat: "dd/mm/yy",
            monthNames,
            dayNamesMin,
            firstDay: 1,
            onSelect: (date, inst) => {
                if (date === "14/08/2023" || date === "25/08/2023") {
                    let [day, month, year] = date.split("/");
                    month = monthNames[month - 1];

                    if(+day === 1) {
                        day = +day + "st";
                    } else if(+day === 2) {
                        day = +day + "nd";
                    } else if(+day === 3) {
                        day = +day + "rd";
                    } else {
                        day = day + "th";
                    }

                    $(".events-block__title").text(month + " " + day)
                }
            },
            beforeShowDay: function (date) {
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();
                let compare = day + "/" + month + "/" + year;
    
                if (compare === "14/8/2023" || compare === "25/8/2023") {
                    return [true, "has-event", ""];
                } else {
                    return [true, '', '']
                }
            },
        });
    }

    // SWITCHER *************************
    $(".switcher__item").on("click", function () {
        if (!$(this).closest(".switcher").hasClass("switcher_multiple")) {
            $(this).closest(".switcher").find(".switcher__item").removeClass("active");
            $(this).addClass("active");
        } else {
            $(this).toggleClass("active");
        }
    });

    // ACCORDION ************************
    $(".accordion__header").on("click", function (e) {
        let accordion = $(this).closest(".accordion");
        let thisItem = $(this).closest(".accordion__item");
        let openItem = accordion.find(".accordion__item.open");
        let thisBody = thisItem.find(".accordion__body");
        let openBody = openItem.find(".accordion__body");

        if (thisItem.hasClass("open")) {
            thisItem.removeClass("open");
            thisBody.slideUp(300);
        } else {
            openItem.removeClass("open");
            openBody.slideUp(300);
            thisItem.addClass("open");
            thisBody.slideDown(300);
        }
    });

    $(".popover-trigger").on("click", function () {
        if ($(this).closest(".popover-container").hasClass("active")) {
            $(this).closest(".popover-container").removeClass("active");
        } else {
            $(".popover-container").removeClass("active");
            $(this).closest(".popover-container").addClass("active");
        }

        if ($(window).width() < 1024) {
            scrollNone();
        }
    });

    // FORM ITEMS *********************
    $(".form-field__input, .main-search__element input").on("keyup", function () {
        let val = $(this).val().trim();

        if (val.length) {
            $(this).closest(".form-field, .main-search").addClass("filled");
        } else {
            $(this).closest(".form-field, .main-search").removeClass("filled");
        }
    });

    $(".form-field__input, .main-search__element input").on("focus", function () {
        $(this).closest(".form-field, .main-search").addClass("focused");
    });
    $(".form-field__input, .main-search__element input").on("focusout", function () {
        $(this).closest(".form-field, .main-search").removeClass("focused");
    });

    $(".pass-visibility").on("click", function () {
        $(this).toggleClass("visible");

        if ($(this).hasClass("visible")) {
            $(this).closest(".form-field__target").find("input").attr("type", "text");
        } else {
            $(this).closest(".form-field__target").find("input").attr("type", "password");
        }
    });

    // Form Validation ***************************
    $(".with-validation").on("submit", function (e) {
        let isValid = true;
        let passwords = $(this).find(".form-field__target_password");
        let equalErrorHtml = `<div class="form-field__message error">New Password Fields are not equal</div>`;

        $(this).find(".form-field__message.error").remove();
        $(this).find(".form-field.invalid").removeClass("invalid");

        if (passwords.length > 1) {
            const newPass = $("#new-password");
            const confirmPass = $("#retype-new-password");

            if (newPass.val() !== confirmPass.val()) {
                isValid = false;

                confirmPass.closest(".form-field").addClass("invalid").append(equalErrorHtml);
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    $(".input-number").on("keyup", function (e) {
        let val = $(this).val();
        let onlyNum = getOnlyNumbers(val);

        if (onlyNum) {
            $(this).val(onlyNum)
        } else {
            $(this).val("");
        }

        // Separator
        if ($(this).attr("data-input-separator") !== undefined) {
            let separator = $(this).attr("data-input-separator");
            let valWithSeparator = numberWithSeparator($(this).val(), separator);

            $(this).val(valWithSeparator);
        }

        // Phone Formatter
        if ($(this).hasClass("formatted-phone")) {
            let formattedPhoneNumber = formatPhoneNumber($(this).val());

            if (formattedPhoneNumber) {
                $(this).val(formattedPhoneNumber);
            }
        }
    });

    if ($(".main-slider").length) {
        let mainSliderHeader = new Swiper(".main-slider__swiper", {
            loop: true,
            speed: 500,
            simulateTouch: false,
            allowTouchMove: false,
            effect: 'fade',
            slidesPerView: 1,
            pagination: true,
            navigation: {
                nextEl: ".main-slider__control_next",
                prevEl: ".main-slider__control_prev",
            },
            autoHeight: true,
            pagination: {
                el: ".main-slider__pagination",
                type: "fraction",
            },
        });
    }

    // REMOVE ACTIVE CLASSES *******************************
    $(document).on('click', function (e) {
        if (!$(e.target).closest(".modal-trigger, .modal__wrapper, .header-badge, .profile, .properties").length) {
            $(".modal").removeClass("active");
            $(".header-badge").removeClass("open");
            $(".profile").removeClass("active");
            $(".properties").removeClass("active");

            scrollNone();
        }

        if ($(e.target).closest(".toast-close").length) {
            removeToast($(e.target));
        }

        e.stopPropagation();
    });
});
