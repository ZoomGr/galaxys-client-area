<!-- Page Css -->
<link rel="stylesheet" href="assets/css/pages/media-files.css">
<!-- ========================== -->

<div class="content">
    <div class="row">
        <div class="column sm-12">
            <div class="content__body">
                <div class="content__heading">
                    <h1 class="content__title h1-font">
                        Media Files
                    </h1>
                </div>
                <div class="media-files shadow-xs radius-md tabs">
                    <div class="media-files__heading">
                        <div class="media-files__top">
                            <div class="media-files__breadcrumb breadcrumb">
                                <div class="breadcrumb__wrap">
                                    <a href="?p=home" class="breadcrumb__item">
                                        <span>Home</span>
                                        <i class="icon icon-chevron-right"></i>
                                    </a>
                                    <a href="#" class="breadcrumb__item">
                                        <span>Logos</span>
                                        <i class="icon icon-chevron-right"></i>
                                    </a>
                                    <div class="breadcrumb__item">
                                        <span>PSD</span>
                                    </div>
                                </div>
                            </div>
                            <div class="media-files__download">
                                <span class="media-files__selected"></span>
                                <div class="media-files__download-btn">
                                    <a href="#" download="" class="media-download-all btn btn_sm color-main">
                                        <i class="icon icon-download"></i>
                                        <span>Download All</span>
                                    </a>
                                    <div class="media-download-selected btn btn_sm color-main">
                                        <i class="icon icon-download"></i>
                                        <span>Download Selected</span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                    <div class="combo-box-dropdown">
                                                        <div class="combo-box-options">
                                                            <div class="combo-option" data-option-value="all">
                                                                <span>All</span>
                                                            </div>
                                                            <div class="combo-option" data-option-value="pdf">
                                                                <span>Pdf</span>
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
<!--                                        <div class="filters__item">-->
<!--                                            <div class="custom-select custom-select_md custom-select_border">-->
<!--                                                <div class="combo-box" data-combo-name="date-modified">-->
<!--                                                    <div class="combo-box-selected">-->
<!--                                                        <div class="combo-box-selected-wrap">-->
<!--                                                            <span class="combo-box-placeholder">Date modified</span>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="combo-box-dropdown">-->
<!--                                                        <div class="combo-box-options">-->
<!--                                                            <div class="combo-option" data-option-value="all">-->
<!--                                                                <span>All</span>-->
<!--                                                            </div>-->
<!--                                                            <div class="combo-option" data-option-value="17.05.2023">-->
<!--                                                                <span>17.05.2023</span>-->
<!--                                                            </div>-->
<!--                                                            <div class="combo-option" data-option-value="18.05.2023">-->
<!--                                                                <span>18.05.2023</span>-->
<!--                                                            </div>-->
<!--                                                            <div class="combo-option" data-option-value="25.05.2023">-->
<!--                                                                <span>25.05.2023</span>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </div>
                                </div>
                                <div class="filters__tags">
                                    <div class="filters__tags-wrap">
                                        <div class="filter-tag">
                                            <span>All features</span>
                                            <div class="filter-tag__remove">
                                                <i class="icon icon-close"></i>
                                            </div>
                                        </div>
                                        <div class="filter-tag">
                                            <span>Feature 1</span>
                                            <div class="filter-tag__remove">
                                                <i class="icon icon-close"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media-files__sort">
                                <form action="#" method="get" class="main-search main-search_dark">
                                    <div class="main-search__element">
                                        <div class="main-search__icon">
                                            <i class="icon icon-search"></i>
                                        </div>
                                        <input type="search" placeholder="Search">
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
                    </div>
                    <div class="tabs__content">
                        <div id="media-files-list" class="tab-content active">
                            <table class="media-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="media-select-all">
                                                <label class="custom-check custom-check_checkbox">
                                                    <input type="checkbox" name="media-select-all">
                                                    <span class="custom-check__checkmark"></span>
                                                    <span class="payment-info__label">Name</span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="media-date-sort cursor inline-flex align-middle">
                                                Date Modified
                                                <i class="icon icon-arrow-down"></i>
                                            </div>
                                        </th>
                                        <th>File Size</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="media-table__file">
                                        <td>
                                            <div class="media-table__name">
                                                <img width="24" height="24" src="assets/img/png.png" alt="file preview">
                                                <span>Png file name.png</span>

                                                <label class="custom-check custom-check_checkbox">
                                                    <input type="checkbox" name="file-1">
                                                    <span class="custom-check__checkmark"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">17.05.2023 12:21</div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">125KB</div>
                                        </td>
                                        <td>
                                            <div class="media-table__action">
                                                <div class="media-table__btn media-link">
                                                    <i class="icon icon-link"></i>
                                                </div>
                                                <a href="file_1.pdf" class="media-table__btn media-download" download="">
                                                    <i class="icon icon-download"></i>
                                                </a>
                                                <div class="media-table__btn media-favourite">
                                                    <i class="icon icon-heart"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="media-table__file">
                                        <td>
                                            <div class="media-table__name">
                                                <img width="24" height="24" src="assets/img/folder.png" alt="file preview">
                                                <span>Folder name</span>

                                                <label class="custom-check custom-check_checkbox">
                                                    <input type="checkbox" name="file-2">
                                                    <span class="custom-check__checkmark"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">17.05.2023 12:21</div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">125KB</div>
                                        </td>
                                        <td>
                                            <div class="media-table__action">
                                                <div class="media-table__btn media-link">
                                                    <i class="icon icon-link"></i>
                                                </div>
                                                <a href="file_2.pdf" class="media-table__btn media-download" download="">
                                                    <i class="icon icon-download"></i>
                                                </a>
                                                <div class="media-table__btn media-favourite">
                                                    <i class="icon icon-heart"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="media-table__file">
                                        <td>
                                            <div class="media-table__name">
                                                <img width="24" height="24" src="assets/img/exel.svg" alt="file preview">
                                                <span>Exel file name.xlsx</span>

                                                <label class="custom-check custom-check_checkbox">
                                                    <input type="checkbox" name="file-2">
                                                    <span class="custom-check__checkmark"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">17.05.2023 12:21</div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">125KB</div>
                                        </td>
                                        <td>
                                            <div class="media-table__action">
                                                <div class="media-table__btn media-link">
                                                    <i class="icon icon-link"></i>
                                                </div>
                                                <a href="file_3.pdf" class="media-table__btn media-download" download="">
                                                    <i class="icon icon-download"></i>
                                                </a>
                                                <div class="media-table__btn media-favourite">
                                                    <i class="icon icon-heart"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="media-table__file">
                                        <td>
                                            <div class="media-table__name">
                                                <img width="24" height="24" src="assets/img/pdf.svg" alt="file preview">
                                                <span>Pdf file name.pdf</span>

                                                <label class="custom-check custom-check_checkbox">
                                                    <input type="checkbox" name="file-2">
                                                    <span class="custom-check__checkmark"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">17.05.2023 12:21</div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">125KB</div>
                                        </td>
                                        <td>
                                            <div class="media-table__action">
                                                <div class="media-table__btn media-link">
                                                    <i class="icon icon-link"></i>
                                                </div>
                                                <a href="file_4.pdf" class="media-table__btn media-download" download="">
                                                    <i class="icon icon-download"></i>
                                                </a>
                                                <div class="media-table__btn media-favourite">
                                                    <i class="icon icon-heart"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="media-table__file">
                                        <td>
                                            <div class="media-table__name">
                                                <img width="24" height="24" src="assets/img/png.png" alt="file preview">
                                                <span>Png file name.png</span>

                                                <label class="custom-check custom-check_checkbox">
                                                    <input type="checkbox" name="file-1">
                                                    <span class="custom-check__checkmark"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">17.05.2023 12:21</div>
                                        </td>
                                        <td>
                                            <div class="color-black-40">125KB</div>
                                        </td>
                                        <td>
                                            <div class="media-table__action">
                                                <div class="media-table__btn media-link">
                                                    <i class="icon icon-link"></i>
                                                </div>
                                                <a href="file_1.pdf" class="media-table__btn media-download" download="">
                                                    <i class="icon icon-download"></i>
                                                </a>
                                                <div class="media-table__btn media-favourite">
                                                    <i class="icon icon-heart"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="media-files-grid" class="tab-content">
                            <div class="media-list">
                                <div class="row">
                                    <div class="column sm-12 md-3">
                                        <div class="media-card">
                                            <div class="media-card__heading">
                                                <div class="media-card__name">Png file name</div>
                                                <div class="media-card__action">
                                                    <a href="file_1.pdf" class="media-card__download" download="">
                                                        <i class="icon icon-download"></i>
                                                    </a>
                                                    <div class="media-card__properties properties">
                                                        <div class="properties__target">
                                                            <i class="icon icon-properties"></i>
                                                        </div>
                                                        <div class="properties__dropdown">
                                                            <div class="properties__item">
                                                                <i class="icon icon-link"></i>
                                                                <span>Link to file</span>
                                                            </div>
                                                            <div class="properties__item">
                                                                <i class="icon icon-heart"></i>
                                                                <span>Add to favourites</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-card__img">
                                                <img src="assets/img/draft/media-file.jpg" alt="media file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column sm-12 md-3">
                                        <div class="media-card">
                                            <div class="media-card__heading">
                                                <div class="media-card__name">Folder name</div>
                                                <div class="media-card__action">
                                                    <a href="file_2.pdf" class="media-card__download" download="">
                                                        <i class="icon icon-download"></i>
                                                    </a>
                                                    <div class="media-card__properties properties">
                                                        <div class="properties__target">
                                                            <i class="icon icon-properties"></i>
                                                        </div>
                                                        <div class="properties__dropdown">
                                                            <div class="properties__item">
                                                                <i class="icon icon-link"></i>
                                                                <span>Link to file</span>
                                                            </div>
                                                            <div class="properties__item">
                                                                <i class="icon icon-heart"></i>
                                                                <span>Add to favourites</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-card__img">
                                                <img src="assets/img/folder-preview.svg" alt="media file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column sm-12 md-3">
                                        <div class="media-card">
                                            <div class="media-card__heading">
                                                <div class="media-card__name">Exel file name</div>
                                                <div class="media-card__action">
                                                    <a href="file_3.pdf" class="media-card__download" download="">
                                                        <i class="icon icon-download"></i>
                                                    </a>
                                                    <div class="media-card__properties properties">
                                                        <div class="properties__target">
                                                            <i class="icon icon-properties"></i>
                                                        </div>
                                                        <div class="properties__dropdown">
                                                            <div class="properties__item">
                                                                <i class="icon icon-link"></i>
                                                                <span>Link to file</span>
                                                            </div>
                                                            <div class="properties__item">
                                                                <i class="icon icon-heart"></i>
                                                                <span>Add to favourites</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-card__img">
                                                <img src="assets/img/draft/media-file.jpg" alt="media file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column sm-12 md-3">
                                        <div class="media-card">
                                            <div class="media-card__heading">
                                                <div class="media-card__name">Pdf file name</div>
                                                <div class="media-card__action">
                                                    <a href="file_4.pdf" class="media-card__download" download="">
                                                        <i class="icon icon-download"></i>
                                                    </a>
                                                    <div class="media-card__properties properties">
                                                        <div class="properties__target">
                                                            <i class="icon icon-properties"></i>
                                                        </div>
                                                        <div class="properties__dropdown">
                                                            <div class="properties__item">
                                                                <i class="icon icon-link"></i>
                                                                <span>Link to file</span>
                                                            </div>
                                                            <div class="properties__item">
                                                                <i class="icon icon-heart"></i>
                                                                <span>Add to favourites</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-card__img">
                                                <img src="assets/img/draft/media-file.jpg" alt="media file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column sm-12 md-3">
                                        <div class="media-card">
                                            <div class="media-card__heading">
                                                <div class="media-card__name">Png file name</div>
                                                <div class="media-card__action">
                                                    <a href="file_1.pdf" class="media-card__download" download="">
                                                        <i class="icon icon-download"></i>
                                                    </a>
                                                    <div class="media-card__properties properties">
                                                        <div class="properties__target">
                                                            <i class="icon icon-properties"></i>
                                                        </div>
                                                        <div class="properties__dropdown">
                                                            <div class="properties__item">
                                                                <i class="icon icon-link"></i>
                                                                <span>Link to file</span>
                                                            </div>
                                                            <div class="properties__item">
                                                                <i class="icon icon-heart"></i>
                                                                <span>Add to favourites</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-card__img">
                                                <img src="assets/img/draft/media-file.jpg" alt="media file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
