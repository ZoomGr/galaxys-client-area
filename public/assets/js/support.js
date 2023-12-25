$(document).ready(function() {
    $(".support-new-conversation").on("click", function() {
        $(".support-item").removeClass("active");
        $(".new-conversation").removeClass("hide");
        $(".chat").addClass("hide");
    });

    if($(".support").length) {
        let supportItem = $(".support-item").eq(0);

        if (supportItem.hasClass('notifications')) {
            $('.notification-content').text(supportItem.find('.support-item__desc').text());
            $(".chat__subject").text(supportItem.find('.support-item__title').text());
        } else {
            getChatMessages(supportItem);
        }
    }


    $(document).on("click", function(e) {
        if($(e.target).closest(".support-item").length) {
            let supportItem = $(e.target).closest(".support-item");

            if (supportItem.hasClass('notifications')) {
                $('.notification-content').text(supportItem.find('.support-item__desc').text());
                $(".chat__subject").text(supportItem.find('.support-item__title').text());
            } else {
                const chatId = $(e.target).closest(".support-item").attr("data-id");

                $(".chat__form").find("input[name='chat_id']").val(chatId);

                if($(".chat").hasClass("hide")) {
                    $(".chat").removeClass("hide");
                    $(".new-conversation").addClass("hide");
                }

                if(!supportItem.hasClass("active")) {
                    getChatMessages(supportItem);
                }
            }
        }
    });

    $(document).on("submit", function(e) {
        const form = $(e.target);

        if(form.hasClass("new-conversation__form")) {
            e.preventDefault();
            const method = form.attr("method");
            const url = form.attr("action");
            let formData = $('form').serialize();
            let subject = form.find("input[name='subject']").val();
            let message = form.find("textarea[name='message']").val();

            $.ajax({
                url,
                data: formData,
                method,
                success: function({ chat, user }) {
                    $(".chat").removeClass("hide");
                    $(".new-conversation").addClass("hide");

                    addNewChat(form, chat.entity_id, user.name, chat.entity_creation_date, subject, message);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        if(form.hasClass("chat__form")) {
            e.preventDefault();
            sendChatMessage(form);
        }
    });
});

function getChatMessages(chatItem) {
    const chatId = chatItem.attr("data-id");
    const chatSubject =  chatItem.find(".support-item__title").text();
    $(".support-item").removeClass("active");
    $(".chat__subject").text(chatSubject);
    $(".chat__body-wrap").html("");

    if(chatItem.hasClass("support-item_notify")) {
        let date = chatItem.find(".support-item__date").text();
        let message = chatItem.find(".support-item__desc").text();

        $(".chat__body-wrap").append(returnMessageHTML(false, date, message));
    } else {
        if(chatId) {
            $.ajax({
                url: `get-chat-messages/${chatId}`,
                method: "GET",
                success: function({ user_id, message }) {
                    // let reversedMessages = message.slice().reverse();

                    message.map(({ entity_creator, entity_creation_date, entity_data }) => {
                        const isAuthor = +entity_creator === +user_id;
                        const formattedDate = formatDateAndTime(entity_creation_date);

                        $(".chat__body-wrap").append(returnMessageHTML(isAuthor, formattedDate, entity_data.ed_text_1));
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }

    chatItem.addClass("active");
}

function sendChatMessage(form) {
    let data = form.serialize();

    $.ajax({
        url: '/users/add-chat-message',
        method: "POST",
        data,
        success: function() {
            const chatBody = $(".chat__body-wrap");
            const message = form.find("textarea[name='message']");

            $(".support-item.active").find(".support-item__desc").text(message.val());
            chatBody.append(returnMessageHTML(true, getFormattedDateNow(), message.val()));
            message.val("");
            chatBody.scrollTop(chatBody.get(0).scrollHeight);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function addNewChat(form, id, name, date, subject, message) {
    form.find("input").val("");
    form.find("textarea").val("");

    $(".chat__body-wrap").html("");
    $(".chat__subject").text(subject);
    $(".chat__body-wrap").append(returnMessageHTML(true, date, message));
    $(".chat__form").find("input[name='chat_id']").val(id);

    let chatItemTemplate = `
        <div class="support-item active" data-id="${id}">
            <div class="support-item__avatar">
                <div class="avatar">
                    <img src="${basePath}/assets/img/draft/profile.jpg" alt="avatar">
                </div>
            </div>
            <div class="support-item__date">${date}</div>
            <div class="support-item__body">
                <div class="support-item__title">${subject}</div>
                <div class="support-item__desc">${message}</div>
            </div>
        </div>
    `;

    $(".support-list__wrap").prepend(chatItemTemplate);
}

function returnMessageHTML(isAuthor, date, message) {
    return `
    <div class="chat__message ${isAuthor ? 'text-right' : ''}">
        <div class="message ${isAuthor ? 'message_author' : 'message_reply'}">
            <div class="message__info">
                <div class="avatar avatar_sm">
                    ${
                        isAuthor
                        ? `<img src="${basePath}/assets/img/draft/profile.jpg" alt="avatar">`
                        : `<img src="${basePath}/assets/img/draft/admin.jpg" alt="avatar">`
                    }
                </div>
            </div>
            <div class="message__body">
                <div class="message__item">
                    <div class="message__date">${date}</div>
                    <div class="message__text">${message}</div>
                </div>
            </div>
        </div>
    </div>
    `;
}

function formatDateAndTime(dateAndTime) {
    let [date, time] = dateAndTime.split(" ");
    let [year, month, day] = date.split("-");

    let formattedDate = getMonthShortName(month) + " " + day + " " + year;

    return formattedDate + " at " + time;
}

function getFormattedDateNow() {
    let currentDate = new Date();
    return dateTime =
        (getMonthShortName(currentDate.getMonth()+1))  + " "
        + currentDate.getDate() + " "
        + currentDate.getFullYear() + " at "
        + (currentDate.getHours() < 10 ? "0" + currentDate.getHours() : currentDate.getHours()) + ":"
        + (currentDate.getMinutes() < 10 ? "0" + currentDate.getMinutes() : currentDate.getMinutes()) + ":"
        + (currentDate.getSeconds() < 10 ? "0" + currentDate.getSeconds() : currentDate.getSeconds());
}

function getMonthShortName(monthNo) {
    const date = new Date();
    date.setMonth(monthNo - 1);

    return date.toLocaleString('en-US', { month: 'short' });
}
