<?php
    $asideDisabled = false;

    $gridElementClasses = "column sm-12 md-6";

    if ($asideDisabled) {
        $gridElementClasses =  "column sm-12 md-4";
    }
?>

@if(!$ongoing_promos->count())
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
@else
    <div class="article-listing">
        <div class="row">
            @foreach($ongoing_promos as $ongoing_promo)
                <div class="{{$gridElementClasses}}">
                    <a href="{{route('promos.show', ['promo' => $ongoing_promo->entity_id])}}" class="article-card shadow-xs radius-xs">
                        <div class="article-card__img radius-xxs">
                            <img src="{{ \App\Helpers\PanelEntity::getEntityImage($ongoing_promo->entityData->ed_image, 498, 284, 6) }}" alt="{{ $ongoing_promo->entityDataLang->edl_title }}">
                        </div>
                        <div class="article-card__body">
                            <div class="article-card__title text-20 font-semibold">
                                {{ $ongoing_promo->entityDataLang->edl_title }}
                            </div>
                            <div class="article-card__date color-black-50">
                                <div class="date">
                                    <i class="icon icon-clock"></i>
                                    <span>{{\Carbon\Carbon::parse($ongoing_promo->entityData->ed_datetime_1)->format('jS M Y')}} - {{\Carbon\Carbon::parse($ongoing_promo->entityData->ed_datetime_2)->format('d M Y')}}</span>
                                </div>
                            </div>
                            <div class="article-card__tags">
                                <div class="tags">
                                    <div class="tags__wrap">
                                        @foreach($ongoing_promo->tags as $tag)
                                            <div class="tag">{{$tag->entityDataLang->edl_title}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="article-listing-paging text-center">
        {{ $ongoing_promos->links('vendor.pagination.default') }}
    </div>
@endif
