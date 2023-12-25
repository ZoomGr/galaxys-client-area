<div class="column sm-12 md-3">
    <div class="content-aside">
        <div class="content-aside__thumb">
            <div class="discover-block radius-xs">
                <div class="discover-block__img">
                    <img src="{{ \App\Helpers\PanelEntity::getEntityImage($content->entityData->ed_char_1, 328, 456, 6) }}" alt="{{$content->entityDataLang->edl_char_1}}">
                </div>
                <div class="discover-block__content">
                    <div class="discover-block__title text-24 font-bold color-white">
                        {{$content->entityDataLang->edl_char_1}}
                    </div>
                    <div class="discover-block__desc text-14 color-black-10">
                        {{$content->entityDataLang->edl_text_2}}
                    </div>
                    <div class="discover-block__btn">
                        <a href="{{$content->entityDataLang->edl_char_2}}" class="btn btn_gradient btn_sm fit">
                            <span>{{$content->entityDataLang->edl_char_3}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
