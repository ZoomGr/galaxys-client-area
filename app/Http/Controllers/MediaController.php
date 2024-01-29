<?php

namespace App\Http\Controllers;

use App\Repositories\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\Config\Definition\Exception\Exception;

class MediaController extends Controller
{

    public $media_service;
    public function __construct(MediaRepository $media_service)
    {
        $this->media_service = $media_service;
    }

    public function index() {
        $add_favorite = true;
        $all_files = $this->media_service->getDirectoryDataWithSize('');
        return view('media-files.index')->with(compact('all_files', 'add_favorite'));

    }

    public function getFilesUrls(Request $request) {
        $s3_files_url = [];

        try {
            if(isset($request->files_array)) {
                foreach ($request->files_array as $file) {
                    $s3_base_64_file = $this->media_service->getFileBase64($file);
                    $s3_files_url[] = 'data:' .$s3_base_64_file['mimeType']. ';base64,'. $s3_base_64_file['base64'];
                }
                return response()->json(['status' => 200, 'data' => $s3_files_url]);
            }

        } catch (Exception $ex) {
            return response()->json(['status' => 500]);
        }
        return response()->json(['status' => 404]);
    }

    public function getFileUrl(Request $request) {
        if (isset($request->path)) {
            try {
                return response()->json(['status' => 200, 'url' => $this->media_service->getFileUrl($request->path)]);
            } catch (Exception $ex) {
                return response()->json(['status' => 500]);
            }
        }
        return response()->json(['status' => 404]);
    }

    public function getPathData(Request $request) {
        $path_data = null;
        if (isset($request->path)) {
            $add_favorite = true;
            $path_data_array = explode('/', $request->path);

            if (count($path_data_array)) {
                $add_favorite = $this->media_service->checkPathIsFavorite($path_data_array, $path_data_array[0], 0);
            }

            $path_data = $this->media_service->getDirectoryDataWithSize($request->path);
        }
        return view('components.media-files')->with(compact('path_data', 'add_favorite'));

    }

    //recursive function for check current path file parent folders is favorite or not.
    protected function checkPathIsFavorite(array $path_data_array, string $folder_path,  int $queue) {

        if(Session::has($folder_path)) {
            return false;
        } else {
            $queue = $queue + 1;

            if($queue == count($path_data_array)) {
                return true;
            }

            $folder_path .=  '/' . $path_data_array[$queue];
            return $this->checkPathIsFavorite($path_data_array, $folder_path, $queue);

        }
    }

    public function downloadFolder(Request $request) {
        if (isset($request->path)) {
            return $this->media_service->downloadFolder($request->path);
        }
        return null;
    }

    public function downloadFile(Request $request) {
        if (isset($request->path)) {
            return $this->media_service->downloadFile($request->path);
        }
        return null;
    }
}
