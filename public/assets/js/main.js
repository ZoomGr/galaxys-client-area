$(document).ready(function () {
    tabsInit();
    dynamicAppendInit();
    if (!$('.sign-up-container').length) {
        getNewMessagesCount();
    }

    $(".header-badge").each(function () {
        if ($(this).find(".header-badge__dropdown")) {
            $(this).find(".header-badge__wrap").on("click", function () {
                $(this).closest(".header-badge").toggleClass("open");
                let newCounter = $(this).find(".header-badge__count");

                if(newCounter.length && $(this).closest(".notifies").length) {
                    $.ajax({
                        url: "users/update-notification-seen",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function(data) {
                            if(data.status) {
                                newCounter.remove();
                            }
                        }
                    });
                }
            });
        }
    });

    $(".update-favorites").on("click", function (event) {
        event.preventDefault();
        let _this = $(this);

        $.ajax({
            method: "POST",
            url: "/users/update-favorites",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            type: "POST",
            data: { id: _this.attr("data-favorite") },
            success: function (data) {
                if (data != undefined && data.status == true) {
                    if(_this.hasClass("btn")) {
                        _this.toggleClass("btn_main");
                    } else {
                        _this.toggleClass("active");
                    }
                }
            },
            error: function (err) {
                toastMessage(err, 'error');
            },
        });
    });

    if ($('.media-files-page').length && file_path !== '') {
        get_path_data(file_path);
    }

    $('.media-files__breadcrumb .breadcrumb__wrap').on('click', 'a', function (event) {
        event.preventDefault();
        let path = $(this).attr('href');
        get_path_data(path);
    });

    $('.media-files-types-filter .combo-option').on('click', function () {
        let form = $('.main-search.main-search_dark');
        form.find('input[name="type"]').val($(this).attr('data-option-value'));
        form.submit();
    });

    $('.main-search').on('submit', function (event) {
        event.preventDefault();
        let form = $(this);
        let type = form.find('input[name="type"]').val();
        let search = form.find('input[name="search"]').val();

        if (type !== '' || search !== '') {
            $.map($('.media-card__name'), function (element, i) {
                if (type !== '' && search !== '') {
                    if ((type == 'all' || $(element).hasClass('type-'+ type)) && $(element).text().search(search) != -1) {
                        $(element).closest('.column').removeClass('dn');
                    } else {
                        $(element).closest('.column').addClass('dn');
                    }
                } else if (type !== '' && search === '') {
                    if (type == 'all' || $(element).hasClass('type-'+ type)) {
                        $(element).closest('.column').removeClass('dn');
                    } else {
                        $(element).closest('.column').addClass('dn');
                    }
                } else if (type === '' && search !== '') {
                    if ($(element).text().search(search) != -1) {
                        $(element).closest('.column').removeClass('dn');
                    } else {
                        $(element).closest('.column').addClass('dn');
                    }
                }

            });

            $.map($('.media-table__name .file-name'), function (element, i) {
                if (type !== '' && search !== '') {
                    if ((type == 'all' || $(element).hasClass('type-'+ type)) && $(element).text().search(search) != -1) {
                        $(element).closest('tr').removeClass('dn');
                    } else {
                        $(element).closest('tr').addClass('dn');
                    }
                } else if (type !== '' && search === '') {
                    if (type == 'all' || $(element).hasClass('type-'+ type)) {
                        $(element).closest('tr').removeClass('dn');
                    } else {
                        $(element).closest('tr').addClass('dn');
                    }
                } else if (type === '' && search !== '') {
                    if ($(element).text().search(search) != -1) {
                        $(element).closest('tr').removeClass('dn');
                    } else {
                        $(element).closest('tr').addClass('dn');
                    }
                }
            });
        } else {
            $.map($('.media-card__name'), function (element, i) {
                $(element).closest('.column').removeClass('dn');
            });

            $.map($('.media-table__name .file-name'), function (element, i) {
                $(element).closest('tr').removeClass('dn');
            });
        }

    });

    $('.all-medias-content').on('dblclick', '.media-table__folder, .media-card_folder', function (e) {
        if(!$(e.target).closest(".media-table__btn").length) {
            let path = $(this).attr('data-path');
            get_path_data(path);
        }
    });

    $(".profile__wrap").on("click", function () {
        $(this).closest(".profile").toggleClass("active");
    });

    $(document).on("click", '.properties__target', function() {
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
        $('.all-medias-content').on("click", function(e) {
            if($(e.target).closest(".media-date-sort").length) {
                const $this = $(e.target).closest(".media-date-sort");

                $this.toggleClass("active");
            }

            if(!$(e.target).closest(".media-table__btn").length && $(e.target).closest(".media-table__file").length) {
                const $this = $(e.target).closest(".media-table__file");

                toggleFileSelected(!$this.hasClass("selected"), $this);

                if(!isAllFilesSelected()) {
                    $(".media-select-all input").prop("checked", false);
                } else {
                    $(".media-select-all input").prop("checked", true);
                }
            }

            // Copy Link Btn
            if($(e.target).closest(".media-link, .properties__item").length) {
                const $this = $(e.target).closest(".media-link, .properties__item");

                $.ajax({
                    method: "POST",
                    url: "/medias/get-file-url",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    type: "POST",
                    data: { path: $this.attr("data-file") },
                    success: function (data) {
                        if (data != undefined && data.status == 200) {
                            $this.select();

                            writeClipboardText(data.url, 'Copied! File available only 10 minutes');
                        }
                    },
                    error: function (err) {
                        toastMessage('Something was wrong!', 'error');
                    },
                });
            }

            if($(e.target).closest(".update-favorite-files").length) {
                const $this = $(e.target).closest(".update-favorite-files");
                e.preventDefault();

                $.ajax({
                    method: "POST",
                    url: "/users/update-file-favorites",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    type: "POST",
                    data: { path: $this.attr("data-favoriteFile") },
                    success: function (data) {
                        if (data != undefined && data.status == true) {
                            $this.toggleClass("active");
                        }
                    },
                    error: function (err) {
                        toastMessage('Something was wrong!', 'error');
                    },
                });
            }
        });

        $('.all-medias-content').on("change", ".media-select-all input", function() {
            const table = $(this).closest(".media-table");
            const files = table.find(".media-table__file");
            const isChecked = $(this).prop("checked");

            files.each(function() {
                toggleFileSelected(isChecked, $(this));
            });
        });

        $(".media-download-selected, .media-download-all").on("click", function() {
            let fileLinks = [];

            if($(this).hasClass("media-download-selected")) {
                fileLinks = $(this).attr("data-files")?.split(", ");
            } else {
                $(".media-table__btn.media-link").each(function() {
                    if($(this).attr("data-file")) {
                        fileLinks = [...fileLinks, $(this).attr("data-file")];
                    }
                });
            }

            if(fileLinks.length) {
                let messageToastId = toastMessage("Your download will begin shortly", "default", true);

                $.ajax({
                    method: "POST",
                    url: "/medias/get-files-url",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    dataType: "json",
                    type: "POST",
                    data: { files_array: fileLinks },
                    success: function ({ data }) {
                        const urls = data.map((link, index) => {
                            let filename = $(`.media-link[data-file="${fileLinks[index]}"]`).closest(".media-table__file").find(".media-table__name > span").text();

                            return {
                                download: link,
                                filename: filename || 'unNamed',
                            }
                        });

                        downloadFilesZip(urls, 'Media Files.zip', messageToastId);
                    },
                    error: function (err) {
                        toastMessage('Something was wrong!', 'error');
                    },
                });

            }

        });

        function toggleFileSelected(condition, target) {
            let restFiles = $(".media-download-selected").attr("data-files");
            let thisFile = target.find(".media-link").attr("data-file");

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
            $(this).closest(".selectable-download").find(".selectable-download__trigger").attr("download", val);

            if(val.toLowerCase() === 'all licenses' || val.toLowerCase() === 'all certificates') {
                $(this).closest(".selectable-download").find(".selectable-download__trigger").addClass("download-all");
            } else {
                $(this).closest(".selectable-download").find(".selectable-download__trigger").removeClass("download-all");
            }
        });
    });

    $(".selectable-download__trigger").on("click", function(e) {
        if($(this).hasClass("download-all")) {
            e.preventDefault();
            const fileUrls = $(this).attr('href').split(",");
            const zipName = $(this).attr('download') + ".zip";

            const urls = fileUrls.map((link) => {
                let filename = $(this).closest(".selectable-download").find(`option[data-link="${link}"]`).attr("value") || "no-name";
                let fileNameWithExtension = "";

                if(filename) {
                    fileNameWithExtension = filename + "." + getFileExtensionByName(link)[0];
                }

                return {
                    download: link,
                    filename: fileNameWithExtension || 'unNamed',
                }
            });

            downloadFilesZip(urls, zipName);
        }
    });

    $(".download-all-licenses").on("click", function(e) {
        e.preventDefault();
        let urls = [];
        const zipName = $(this).attr('download') + ".zip";

        $(".license-block__btn").each(function() {
            const url = $(this).find("a").attr("href");
            let filename = $(this).closest(".license-block").find(".file-info__name").text() || 'no-name';
            let fileNameWithExtension = "";

            if(filename) {
                fileNameWithExtension = filename + "." + getFileExtensionByName(url)[0];
            }

            urls = [
                ...urls,
                {
                    download: url,
                    filename: fileNameWithExtension,
                }
            ];
        });

        downloadFilesZip(urls, zipName);
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

function get_path_data(path) {
    let media_type = '&media=' + $('.btn_badge.tab.active').attr('data-tab');
    $.get("/medias/get-path-data?path=" + path + media_type, function(data){
        $(".all-medias-content").html(data);
        if(!$(".media-table__file").length) {
            $(".media-files__download").addClass("hidden");
        } else {
            $(".media-files__download").removeClass("hidden");
        }
        
        let breadcrumb = [];

        if (path != 'all') {
            breadcrumb = path.split("/");
        }

        let br_content = '';
        let current_path = '';

        if ($(".all-medias-content").hasClass('root-files')) {
            if (breadcrumb.length == 0) {
                br_content = '<div class="breadcrumb__item">'+
                    '<span>Home</span>'+
                    '</div>';
            } else {
                br_content = '<a href="all" class="breadcrumb__item">'+
                    '<span>Home</span>'+
                    '<i class="icon icon-chevron-right"></i>'+
                    '</a>';
            }
        } else {
            let br_index = breadcrumb.indexOf(game_parent);
            if (br_index !== -1) {
                breadcrumb.splice(br_index, 1);
                current_path = game_parent;
            }
        }

        if (breadcrumb.length == 1) {
            br_content += '<div class="breadcrumb__item">'+
                '<span>' + breadcrumb[0] + '</span>'+
                '</div>';
        } else {
            for(let i = 0; i < breadcrumb.length; i++) {
                if (i === 0 && current_path == '') {
                    current_path += breadcrumb[i];
                } else {
                    current_path += '/' + breadcrumb[i];
                }
                if ((i+1) == breadcrumb.length) {
                    br_content += '<div class="breadcrumb__item">'+
                        '<span>' + breadcrumb[i] + '</span>'+
                        '</div>';
                } else {
                    br_content += '<a href="'+ current_path +'" class="breadcrumb__item">'+
                        '<span>'+ breadcrumb[i] + '</span>'+
                        '<i class="icon icon-chevron-right"></i>'+
                        '</a>';
                }

            }
        }

        $('.media-files__breadcrumb .breadcrumb__wrap').html(br_content);
        $('.main-search.main-search_dark').trigger('submit');

    });
}

