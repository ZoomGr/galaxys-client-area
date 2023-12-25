<div class="media-files__filters">
    <div class="filters">
        <div class="filters__action">
            <div class="filters__title text-20 font-medium">Filters</div>
            <div class="filters__list">
                <div class="filters__item">
                    <div class="custom-select custom-select_md custom-select_border">
                        <div class="combo-box" data-combo-name="file-type">
                            <div class="combo-box-selected">
                                <div class="combo-box-selected-wrap">
                                    <span class="combo-box-placeholder">File Type</span>
                                </div>
                            </div>
                            <div class="combo-box-dropdown media-files-types-filter">
                                <div class="combo-box-options">
                                    <div class="combo-option" data-option-value="all">
                                        <span>All</span>
                                    </div>
                                    <div class="combo-option" data-option-value="pdf">
                                        <span>Pdf</span>
                                    </div>
                                    <div class="combo-option" data-option-value="jpg">
                                        <span>Jpeg</span>
                                    </div>
                                    <div class="combo-option" data-option-value="png">
                                        <span>Png</span>
                                    </div>
                                    <div class="combo-option" data-option-value="xlsx">
                                        <span>Xlsx</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                                                        <div class="filters__item">--}}
                {{--                                                            <div class="custom-select custom-select_md custom-select_border">--}}
                {{--                                                                <div class="combo-box" data-combo-name="date-modified">--}}
                {{--                                                                    <div class="combo-box-selected">--}}
                {{--                                                                        <div class="combo-box-selected-wrap">--}}
                {{--                                                                            <span class="combo-box-placeholder">Date modified</span>--}}
                {{--                                                                        </div>--}}
                {{--                                                                    </div>--}}
                {{--                                                                    <div class="combo-box-dropdown">--}}
                {{--                                                                        <div class="combo-box-options">--}}
                {{--                                                                            <div class="combo-option" data-option-value="all">--}}
                {{--                                                                                <span>All</span>--}}
                {{--                                                                            </div>--}}
                {{--                                                                            <div class="combo-option" data-option-value="17.05.2023">--}}
                {{--                                                                                <span>17.05.2023</span>--}}
                {{--                                                                            </div>--}}
                {{--                                                                            <div class="combo-option" data-option-value="18.05.2023">--}}
                {{--                                                                                <span>18.05.2023</span>--}}
                {{--                                                                            </div>--}}
                {{--                                                                            <div class="combo-option" data-option-value="25.05.2023">--}}
                {{--                                                                                <span>25.05.2023</span>--}}
                {{--                                                                            </div>--}}
                {{--                                                                        </div>--}}
                {{--                                                                    </div>--}}
                {{--                                                                </div>--}}
                {{--                                                            </div>--}}
                {{--                                                        </div>--}}
            </div>
        </div>
        {{--                                                <div class="filters__tags">--}}
        {{--                                                    <div class="filters__tags-wrap">--}}
        {{--                                                        <div class="filter-tag">--}}
        {{--                                                            <span>All features</span>--}}
        {{--                                                            <div class="filter-tag__remove">--}}
        {{--                                                                <i class="icon icon-close"></i>--}}
        {{--                                                            </div>--}}
        {{--                                                        </div>--}}
        {{--                                                        <div class="filter-tag">--}}
        {{--                                                            <span>Feature 1</span>--}}
        {{--                                                            <div class="filter-tag__remove">--}}
        {{--                                                                <i class="icon icon-close"></i>--}}
        {{--                                                            </div>--}}
        {{--                                                        </div>--}}
        {{--                                                    </div>--}}
        {{--                                                </div>--}}
    </div>
    <div class="media-files__sort">
        <form action="{{Request::url()}}" method="get" class="main-search main-search_dark">
            <div class="main-search__element">
                <div class="main-search__icon">
                    <button type="submit">
                        <i class="icon icon-search"></i>
                    </button>
                </div>
                <input type="search"  value="{{@Request::has('search') ? @Request::get('search') : ''}}" name="search" placeholder="Search">
                <input type="hidden"  value="{{@Request::has('type') ? @Request::get('type') : ''}}" name="type">
            </div>
        </form>
        <div class="media-files__tabs tabs__control">
            <div class="btn btn_sm btn_badge tab active" data-tab="media-files-list">
                <i class="icon icon-checklist"></i>
            </div>
            <div class="btn btn_sm btn_badge tab" data-tab="media-files-grid">
                <i class="icon icon-library"></i>
            </div>
        </div>
    </div>
</div>
