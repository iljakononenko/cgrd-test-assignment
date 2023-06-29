const SUCCESS="success"
const ERROR="error"

function editHandler() {
    let news_id = $(this).attr('data-news-id');
    $('.action-title').text('Edit News');
    let news_item_element = `.news-item#${news_id} `
    let title = $(news_item_element + ".news-title").text()
    title = title.trim()
    let description = $(news_item_element + ".news-description").text()
    description = description.trim()

    $('form#news-form input[name="title"]').val(title)
    $('form#news-form textarea[name="description"]').val(description)
    $('form#news-form')[0].action = "/news/edit/" + news_id;
    $('form#news-form').attr('data-news-id', news_id);
    $('form#news-form button[type="submit"]').text('Edit')
    $('.cancel-edit-button').removeClass('d-none')
}

function removeHandler() {
    let news_id = $(this).attr('data-news-id');
    let news_item_element = `.news-item#${news_id} `
    $(news_item_element).remove()

    $.post('/news/remove/' + news_id, {}, function(result) {
        console.log("Result: ", result);
        showInfoBox(SUCCESS, "News was deleted!");
    }).fail(function(error) {
        console.error('Error: ', error)
    })
}

function showInfoBox(type, message) {
    let info_box = $('.info-box');
    info_box.removeClass('d-none error info')
    if (type === ERROR) {
        info_box.addClass('error')
    } else if (type === SUCCESS) {
        info_box.addClass('success')
    }

    $('.info-message').text(message)
}

$(document).ready(function() {
    $('form#news-form').on('submit', function(event) {

        event.preventDefault();

        let url = $('form#news-form')[0].action;
        let title = $('form#news-form input[name="title"]').val()
        let description = $('form#news-form textarea[name="description"]').val()

        let news_id = $(this).attr('data-news-id');

        $.post(url, {
            title,
            description
        }, function(response) {
            let data = JSON.parse(response)
            let newNews = data.newNews;
            console.log("Result: ");
            console.log(data);

            // editing news
            if (news_id !== "") {
                let news_item_element = `.news-item#${news_id} `;
                $(news_item_element + ".news-title").text(title)
                $(news_item_element + ".news-description").text(description)
                showInfoBox(SUCCESS,"News was successfully edited!");
            } else {
                // adding news
                if (newNews != null) {
                    $('.news-list').append(`
                        <div class="news-item" id="${newNews.id}">
                            <div class="news-details">
                                <span class="news-title">
                                    ${newNews.title}
                                </span>
                                <span class="news-description">
                                    ${newNews.description}
                                </span>
                            </div>
                            <div class="action-buttons">
                                <a class="edit-button" data-news-id="${newNews.id}">
                                    <img src="/img/icons/pencil.svg" alt="">
                                </a>
                                <a class="remove-button" data-news-id="${newNews.id}">
                                    <img src="/img/icons/close.svg" alt="">
                                </a>
                            </div>
                        </div>
                    `);

                    $(`.news-item#${newNews.id} .action-buttons .edit-button`).on('click', editHandler)
                    $(`.news-item#${newNews.id} .action-buttons .remove-button`).on('click', removeHandler)
                    showInfoBox(SUCCESS, "News was successfully created!");
                }
            }

            $('.action-title').text('Create News');

            $('form#news-form input[name="title"]').val('')
            $('form#news-form textarea[name="description"]').val('')
            $('form#news-form')[0].action = "/news/addNews";
            $('form#news-form').attr('data-news-id', "");
            $('form#news-form button[type="submit"]').text('Create')
            if (!$('.cancel-edit-button').hasClass('d-none')) {
                $('.cancel-edit-button').addClass('d-none')
            }
        }).fail(function(error) {
            console.error('Error: ', error)
        })
    })

    $('.action-buttons .edit-button').on('click', editHandler)

    $('.action-buttons .remove-button').on('click', removeHandler)

    $('.cancel-edit-button').on('click', function() {
        $('.action-title').text('Create News');

        $('form#news-form input[name="title"]').val('')
        $('form#news-form textarea[name="description"]').val('')
        $('form#news-form')[0].action = "/news/addNews";
        $('form#news-form').attr('data-news-id', "");
        $('form#news-form button[type="submit"]').text('Create')
        $('.cancel-edit-button').addClass('d-none')
    })
})