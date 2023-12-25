<div id="media-files-list" class="tab-content {{ !@Request::has('media') || @Request::get('media') != 'media-files-grid' ? 'active' : '' }}">
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
        @if(count($path_data))
            @if(isset($path_data['directories']))
                @foreach($path_data['directories'] as $directory)
                <tr class="media-table__folder" data-path="{{$directory['path']}}">
                    <td>
                        <div class="media-table__name">
                            <div>
                                <img width="24" height="24" src="{{asset("assets/img/folder.png")}}" alt="file preview">
                                <span class="file-name type-dir">{{$directory['basename']}}</span>
                            </div>
                            <label class="custom-check custom-check_checkbox">
                                <input type="checkbox" name="file-2">
                                <span class="custom-check__checkmark"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="color-black-40">
                            {{--                                                                {{\Carbon\Carbon::createFromTimestamp($directory['timestamp'])->format('d.m.Y h:m')}}--}}
                            -
                        </div>
                    </td>
                    <td>
                        <div class="color-black-40">
                            {{--                                                                {{\App\Helpers\Helper::formatSizeUnits($directory['size'])}}--}}
                            -
                        </div>
                    </td>
                    <td>
                        <div class="media-table__action">
                            {{--                                                                <div class="media-table__btn media-link">--}}
                            {{--                                                                    <i class="icon icon-link"></i>--}}
                            {{--                                                                </div>--}}
    {{--                        <a href="{{route('medias.download-folder') . '?path='.$directory['path'] }}" download="{{$directory['basename']}}" class="media-table__btn media-download">--}}
    {{--                            <i class="icon icon-download"></i>--}}
    {{--                        </a>--}}
                            @if($add_favorite)
                                <div class="media-table__btn update-favorite-files {{\App\Models\Favorite::favFile($directory['path']) ? 'active' : ''}}" data-favoriteFile="{{$directory['path']}}">
                                    <i class="icon icon-heart"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
            @if(isset($path_data['directories']))
                @foreach($path_data['files'] as $file)
                <tr class="media-table__file" >
                    <td>
                        <div class="media-table__name">
                            @if($file['extension'] == 'png' || $file['extension'] == 'jpg' || $file['extension'] == 'webp')
                                @php $path = 'assets/img/png.png'; @endphp
                            @elseif($file['extension'] == 'xlsx')
                                @php $path = 'assets/img/exel.svg'; @endphp
                            @elseif($file['extension'] == 'pdf')
                                @php $path = "assets/img/pdf.svg"; @endphp
                                {{--                                                                @elseif($file['extension'] == 'svg')--}}
                                {{--                                                                    @php $path = "assets/img/pdf.svg"; @endphp--}}
                            @endif
                            <img width="24" height="24" src="{{asset($path)}}" alt="file preview">
                            <span class="file-name type-{{$file['extension']}}">{{$file['basename']}}</span>

                            <label class="custom-check custom-check_checkbox">
                                <input type="checkbox" name="file-1">
                                <span class="custom-check__checkmark"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="color-black-40">{{\Carbon\Carbon::createFromTimestamp($file['timestamp'])->format('d.m.Y h:m')}}</div>
                    </td>
                    <td>
                        <div class="color-black-40">{{\App\Helpers\Helper::formatSizeUnits($file['size'])}}</div>
                    </td>
                    <td>
                        <div class="media-table__action">
                            <div class="media-table__btn media-link" data-file="{{$file['path']}}">
                                <i class="icon icon-link"></i>
                            </div>
                            {{--                                                                <form method="POST" action="{{route('medias.download-file')}}" class="media-table__btn media-download">--}}
                            {{--                                                                    @csrf--}}
                            {{--                                                                    <input type="hidden" name="path" value="{{$file['path']}}">--}}
                            {{--                                                                    <button type="submit"  class="media-table__btn media-download">--}}
                            {{--                                                                        <i class="icon icon-download"></i>--}}
                            {{--                                                                    </button>--}}
                            {{--                                                                </form>--}}
                            <a href="{{route('medias.download-file'). '?path='. $file['path']}}" download="{{$file['basename']}}" class="media-table__btn media-download">
                                <i class="icon icon-download"></i>
                            </a>
                            @if($add_favorite)
                                <div class="media-table__btn update-favorite-files {{\App\Models\Favorite::favFile($file['path']) ? 'active' : ''}}" data-favoriteFile="{{$file['path']}}">
                                    <i class="icon icon-heart"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
        @endif
        </tbody>
    </table>
</div>
<div id="media-files-grid" class="tab-content {{ @Request::has('media') && @Request::get('media') == 'media-files-grid' ? 'active' : '' }}">
    <div class="media-list">
        <div class="row">
            @if(count($path_data))
                @if(isset($path_data['directories']))
                    @foreach($path_data['directories'] as $directory)
                    <div class="column sm-12 md-3">
                        <div class="media-card media-card_folder" data-path="{{$directory['path']}}">
                            <div class="media-card__heading">
                                <div class="media-card__name type-dir">{{$directory['basename']}}</div>
                                <div class="media-card__action">
    {{--                                <a href="{{route('medias.download-folder') . '?path='.$directory['path'] }}" download="{{$directory['basename']}}" class="media-card__download">--}}
    {{--                                    <i class="icon icon-download"></i>--}}
    {{--                                </a>--}}
                                    <div class="media-card__properties properties">
                                        <div class="properties__target">
                                            <i class="icon icon-properties"></i>
                                        </div>
                                        <div class="properties__dropdown">
    {{--                                        <div class="properties__item" data-file="{{$file['path']}}>--}}
    {{--                                            <i class="icon icon-link"></i>--}}
    {{--                                            <span>Link to file</span>--}}
    {{--                                        </div>--}}
                                            @if($add_favorite)
                                                <div class="properties__item update-favorite-files {{\App\Models\Favorite::favFile($directory['path']) ? 'active' : ''}}">
                                                    <i class="icon icon-heart"></i>
                                                    <span>Add to favourites</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media-card__img">
                                <img src="{{asset('assets/img/folder-preview.svg')}}" alt="media file">
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                @if(isset($path_data['files']))
                    @foreach($path_data['files'] as $file)
                    <div class="column sm-12 md-3">
                        <div class="media-card">
                            <div class="media-card__heading">
                                <div class="media-card__name type-{{$file['extension']}}">{{$file['basename']}}</div>
                                <div class="media-card__action">
                                    <a href="{{route('medias.download-file'). '?path='. $file['path']}}" download="{{$file['basename']}}" class="media-card__download">
                                        <i class="icon icon-download"></i>
                                    </a>
                                    <div class="media-card__properties properties">
                                        <div class="properties__target">
                                            <i class="icon icon-properties"></i>
                                        </div>
                                        <div class="properties__dropdown">
                                            <div class="properties__item" data-file="{{$file['path']}}">
                                                <i class="icon icon-link"></i>
                                                <span>Link to file</span>
                                            </div>
                                            @if($add_favorite)
                                                <div class="properties__item update-favorite-files {{\App\Models\Favorite::favFile($file['path']) ? 'active' : ''}}" data-favoriteFile="{{$file['path']}}">
                                                    <i class="icon icon-heart"></i>
                                                    <span>Add to favourites</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($file['extension'] == 'png' || $file['extension'] == 'jpg' || $file['extension'] == 'webp')
                                @php $path = $file['url']; @endphp
                            @elseif($file['extension'] == 'xlsx')
                                @php $path = 'assets/img/exel.svg'; @endphp
                            @elseif($file['extension'] == 'pdf')
                                @php $path = "assets/img/pdf.svg"; @endphp
                            @endif
                            <div class="media-card__img">
                                <img src="{{asset($path)}}" alt="{{$file['basename']}}">
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            @endif
        </div>
    </div>
</div>
