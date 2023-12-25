<?php
    $asideDisabled = false;

    $gridElementClasses = "column sm-12 md-6";

    if ($asideDisabled) {
        $gridElementClasses =  "column sm-12 md-4";
    }
?>

<div class="article-listing">
    <div class="row">
        @foreach($upcoming_promos as $upcoming_promo)
            <div class="{{$gridBodyClasses}}">
                <a href="{{route('promos.show', ['promo' => $upcoming_promo->entity_id])}}" class="article-card shadow-xs radius-xs">
                    <div class="article-card__img radius-xxs">
                        <img src="{{ \App\Helpers\PanelEntity::getEntityImage($upcoming_promo->entityData->ed_image, 498, 284, 6) }}" alt="{{ $upcoming_promo->entityDataLang->edl_title }}">
                    </div>
                    <div class="article-card__body">
                        <div class="article-card__title text-20 font-semibold">
                            {{ $upcoming_promo->entityDataLang->edl_title }}
                        </div>
                        <div class="article-card__date color-black-50">
                            <div class="date">
                                <i class="icon icon-clock"></i>
                                <span>{{\Carbon\Carbon::parse($upcoming_promo->entityData->ed_datetime_1)->format('jS M Y')}} - {{\Carbon\Carbon::parse($upcoming_promo->entityData->ed_datetime_2)->format('d M Y')}}</span>
                            </div>
                        </div>
                        <div class="article-card__tags">
                            <div class="tags">
                                <div class="tags__wrap">
                                    @foreach($upcoming_promo->tags as $tag)
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
    {{ $upcoming_promos->links('vendor.pagination.default') }}
</div>
