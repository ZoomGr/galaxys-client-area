<!-- Page Css -->
<link rel="stylesheet" href="assets/css/pages/article-listing.css">
<!-- ========================== -->

<?php
    $asideDisabled = false;

    $gridBodyClasses = "column sm-12 md-9";
    $gridElementClasses = "column sm-12 md-6";

    if ($asideDisabled) {
        $gridBodyClasses =  "column sm-12";
        $gridElementClasses =  "column sm-12 md-4";
    }
?>

<div class="content tabs">
    <div class="row">
        <div class="column sm-12">
            <div class="content__heading">
                <h1 class="content__title h1-font">
                    Promo
                </h1>
            </div>
            <div class="action-bar tabs__control shadow-xs radius-xxs">
                <div class="action-bar__tabs">
                    <div class="btn btn_sm tab active" data-tab="ongoing-promos">
                        <span>Ongoing</span>
                    </div>
                    <div class="btn btn_sm tab" data-tab="upcoming-promos">
                        <span>Upcoming</span>
                    </div>
                    <div class="btn btn_sm tab" data-tab="ended-promos">
                        <span>Ended</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="<?= $gridBodyClasses ?>">
            <div class="content__body tabs__content">
                <div id="ongoing-promos" class="tab-content active">
                    <div class="article-empty shadow-xs radius-sm">
                        <div class="article-empty__icon round-badge">
                            <i class="icon icon-sad"></i>
                        </div>
                        <div class="article-empty__title text-20 font-bold color-black-80">No content</div>
                        <div class="article-empty__desc text-14 font-medium color-black-50">
                            There are no ongoing promos at the moment.
                        </div>
                        <div class="article-empty__btn">
                            <div class="btn btn_main btn_sm" data-trigger-tab="upcoming-promos">
                                <span>Upcoming Promos</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-listing">
                        <div class="row">
                            <div class="<?= $gridElementClasses ?>">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="<?= $gridElementClasses ?>">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="<?= $gridElementClasses ?>">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="<?= $gridElementClasses ?>">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="<?= $gridElementClasses ?>">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="<?= $gridElementClasses ?>">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="article-listing-paging text-center">
                        <div class="paging">
                            <div class="paging__wrap">
                                <a href="#" class="paging__item">
                                    <i class="icon icon-chevron-left"></i>
                                </a>
                                <div class="paging__items">
                                    <a href="#" class="paging__item active">
                                        1
                                    </a>
                                    <a href="#" class="paging__item">
                                        2
                                    </a>
                                    <a href="#" class="paging__item">
                                        3
                                    </a>
                                    <a href="#" class="paging__item">
                                        4
                                    </a>
                                    <div class="paging__item paging__item_disabled">
                                        ...
                                    </div>
                                    <a href="#" class="paging__item">
                                        20
                                    </a>
                                </div>
                                <a href="#" class="paging__item">
                                    <i class="icon icon-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="upcoming-promos" class="tab-content">
                    <div class="article-listing">
                        <div class="row">
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card-2.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="article-listing-paging text-center">
                        <div class="paging">
                            <div class="paging__wrap">
                                <a href="#" class="paging__item">
                                    <i class="icon icon-chevron-left"></i>
                                </a>
                                <div class="paging__items">
                                    <a href="#" class="paging__item active">
                                        1
                                    </a>
                                    <a href="#" class="paging__item">
                                        2
                                    </a>
                                    <a href="#" class="paging__item">
                                        3
                                    </a>
                                    <a href="#" class="paging__item">
                                        4
                                    </a>
                                    <div class="paging__item paging__item_disabled">
                                        ...
                                    </div>
                                    <a href="#" class="paging__item">
                                        20
                                    </a>
                                </div>
                                <a href="#" class="paging__item">
                                    <i class="icon icon-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ended-promos" class="tab-content">
                    <div class="article-listing">
                        <div class="row">
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card-3.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        < img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="column sm-12 md-6">
                                <a href="?p=promo-inner" class="article-card shadow-xs radius-xs">
                                    <div class="article-card__img radius-xxs">
                                        <img src="assets/img/draft/article-card.jpg" alt="article card">
                                    </div>
                                    <div class="article-card__body">
                                        <div class="article-card__title text-20 font-semibold">
                                            Drops & Wins 2023
                                        </div>
                                        <div class="article-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>5th Jun 2023 - 27 Jul 2023</span>
                                            </div>
                                        </div>
                                        <div class="article-card__tags">
                                            <div class="tags">
                                                <div class="tags__wrap">
                                                    <div class="tag">Spaceman</div>
                                                    <div class="tag">Black Jack</div>
                                                    <div class="tag">Fishing Reels</div>
                                                    <div class="tag">Baccarat</div>
                                                    <div class="tag">Roulette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="article-listing-paging text-center">
                        <div class="paging">
                            <div class="paging__wrap">
                                <a href="#" class="paging__item">
                                    <i class="icon icon-chevron-left"></i>
                                </a>
                                <div class="paging__items">
                                    <a href="#" class="paging__item active">
                                        1
                                    </a>
                                    <a href="#" class="paging__item">
                                        2
                                    </a>
                                    <a href="#" class="paging__item">
                                        3
                                    </a>
                                    <a href="#" class="paging__item">
                                        4
                                    </a>
                                    <div class="paging__item paging__item_disabled">
                                        ...
                                    </div>
                                    <a href="#" class="paging__item">
                                        20
                                    </a>
                                </div>
                                <a href="#" class="paging__item">
                                    <i class="icon icon-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!$asideDisabled) { ?>
            <div class="column sm-12 md-3">
                <div class="content-aside">
                    <div class="content-aside__thumb">
                        <div class="discover-block radius-xs">
                            <div class="discover-block__img">
                                <img src="assets/img/draft/discover.jpg" alt="discover">
                            </div>
                            <div class="discover-block__content">
                                <div class="discover-block__title text-24 font-bold color-white">
                                    Wild West Heat
                                </div>
                                <div class="discover-block__desc text-14 color-black-10">
                                    Following a previous collaboration with Armenia-based Peter & Sons and the
                                    Following a previous collaboration with Armenia-based Peter & Sons and the
                                </div>
                                <div class="discover-block__btn">
                                    <a href="#" class="btn btn_gradient btn_sm fit">
                                        <span>Discover</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>