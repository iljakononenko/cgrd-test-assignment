<div class="info-box d-none">
    <p class="info-message">
    </p>
</div>

<h3 id="news-title" class="<?php if(sizeof($newsList) == 0):?> d-none <?php endif ?>">All news</h3>

<div class="news-list">
    <?php if(sizeof($newsList) !== 0): ?>
        <?php foreach($newsList as $newsItem): ?>
            <div class="news-item" id="<?=$newsItem['id']?>">
                <div class="news-details">
                                <span class="news-title">
                                    <?=htmlentities($newsItem['title'])?>
                                </span>
                    <span class="news-description">
                                    <?=htmlentities($newsItem['description'])?>
                                </span>
                </div>
                <div class="action-buttons">
                    <a class="edit-button" data-news-id="<?=$newsItem['id']?>">
                        <img src="/img/icons/pencil.svg" alt="">
                    </a>
                    <a class="remove-button" data-news-id="<?=$newsItem['id']?>">
                        <img src="/img/icons/close.svg" alt="">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif;?>
</div>

<div class="action-info">
    <h3 class="action-title">Create News</h3>
    <a class="cancel-edit-button d-none">
        <img src="/img/icons/close.svg" alt="">
    </a>
</div>

<div>
    <form id="news-form" data-news-id="" action="/news/addNews" method="post">
        <input class="form-input" name="title" type="text" placeholder="Title">
        <textarea class="form-input textarea" name="description" placeholder="Description" rows="10"></textarea>
        <button class="form-submit-button" type="submit">
            Create
        </button>
        <a class="form-submit-button" href="/authentification/logout">
            Logout
        </a>
    </form>
</div>