<?php

namespace App\Services;

use App\Repositories\MediaRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class MediaService implements MediaRepository
{
    CONST DISK = 'medias';
    CONST TEMPORARLY_URL = 10;

    public function getDirectoryData(string $name): array
    {
        $all_data = [];
        if(Storage::disk(self::DISK)->exists($name)) {
            $all_data['files'] = Storage::disk(self::DISK)->files($name);
            $all_data['directories'] = Storage::disk(self::DISK)->directories($name);
        }

        return $all_data;
    }

    public function getFileData(string $path):? array
    {
        if(Storage::disk(self::DISK)->exists($path)) {

            $pathInfo = pathinfo($path);

            return [
                'type'       => 'file',
                'path'       => $path,
                'basename'   => $pathInfo['basename'],
                'dirname'    => $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'],
                'extension'  => $pathInfo['extension'] ?? '',
                'filename'   => $pathInfo['filename'],
                'size'       => $this->getSize($path),
                'timestamp'  => $this->getLastModified($path),
                'url' => $this->getTemporaryUrl($path)
            ];
        }

        return null;
    }

    public function getFolderData(string $path): ?array
    {
        if(Storage::disk(self::DISK)->exists($path)) {
            $pathInfo = pathinfo($path);

            return [
                'type'       => 'dir',
                'path'       => $path,
                'basename'   => $pathInfo['basename'],
                'dirname'    => $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'],
                'filename'   => $pathInfo['filename'],
            ];
        }

        return null;
    }

    public function getFileUrl(string $name): ?string
    {
        return $this->getTemporaryUrl($name);
    }

    public function downloadFile(string $path)
    {
        if (!preg_match('/^[\x20-\x7e]*$/', basename($path))) {
            $filename = Str::ascii(basename($path));
        } else {
            $filename = basename($path);
        }

        if(Storage::disk(self::DISK)->exists($path)) {
            return Storage::disk(self::DISK)->get($path, $filename);
        }

        return null;
    }

    public function checkPathIsFavorite(array $path_data_array, string $folder_path, int $queue)
    {
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

    public function downloadFolder(string $path)
    {
        if(Storage::disk(self::DISK)->exists($path)) {
            if (!preg_match('/^[\x20-\x7e]*$/', basename($path))) {
                $filename = Str::ascii(basename($path));
            } else {
                $filename = basename($path);
            }

            $zip = new ZipArchive();
            $filesToZip = Storage::disk(self::DISK)->allFiles($path ?: '');

            $zipFileName = time().'zip-file.zip';

            if ($zip->open(public_path($zipFileName), \ZipArchive::CREATE) === TRUE) {
                foreach ($filesToZip as $file) {
                    $fUrl = Storage::disk(self::DISK)->get($file);
                    $updatedFile = substr($file, strpos($file, $filename), strlen($file));
                    $zip->addFromString($updatedFile, $fUrl);
                }
                $zip->close();

            } else {
                return "Failed to create the zip file.";
            }

            return response()->download(public_path($zipFileName), $filename. '.zip',
                array('Content-Type: application/octet-stream','Content-Length: '. public_path($zipFileName)))->deleteFileAfterSend(true);
        }
    }

    public function getDirectoryDataWithSize(string $name): array
    {
        $all_data = [];
        $content = null;

        if ($name === '' || $name === 'all') {
            $content = Storage::disk(self::DISK)->listContents('')->toArray();
        } elseif (Storage::disk(self::DISK)->exists($name)) {
            $content = Storage::disk(self::DISK)->listContents($name ?: '')->toArray();
        }

        if ($content) {
            $directories = $this->filterDir($content);
            $files = $this->filterFile($content);
            $all_data['files'] = $files;
            $all_data['directories'] = $directories;
        }

        return $all_data;
    }

    protected function getSize(string $path) {
        return Storage::disk(self::DISK)->size($path);
    }

    protected function getLastModified (string $path) {
        return Storage::disk(self::DISK)->lastModified($path);
    }

    protected function getMymeType (string $path) {
        return Storage::disk(self::DISK)->mimeType($path);
    }

    protected function getTemporaryUrl (string $path) {
        return Storage::disk(self::DISK)->temporaryUrl($path, now()->addMinute(self::TEMPORARLY_URL));
    }

    public function getFileBase64(string $path)
{
    if (Storage::disk(self::DISK)->has($path)) {
        $data = Storage::disk(self::DISK)->get($path);
        $getMimeType = $this->getMymeType($path);
        $base64 = base64_encode($data);

        if (!preg_match('/^[\x20-\x7e]*$/', basename($path))) {
            $filename = Str::ascii(basename($path));
        } else {
            $filename = basename($path);
        }

        return [
            'base64' => $base64,
            'mimeType' => $getMimeType,
            'name' => $filename,
        ];
    }

    return false;
}

    protected function filterDir($content): array
    {
        // select only dir
        $dirsList = array_filter($content, fn($item) => $item['type'] === 'dir');

        $dirs = array_map(function ($item) {
            $pathInfo = pathinfo($item['path']);

//            $dir_all_files = Storage::disk(self::DISK)->allFiles($item['path']);
//            $dir_size = 0;

//            foreach ($dir_all_files as $file) {
//                $dir_size += $this->getSize($file);
//                $last_modified =
//            }

            return [
                'type'       => $item['type'],
                'path'       => $item['path'],
                'basename'   => $pathInfo['basename'],
                'dirname'    => $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'],
                //'size'       => $dir_size,
                'timestamp'  => $item['lastModified'],
                'visibility' => $item['visibility'],
            ];
        }, $dirsList);

        return array_values($dirs);
    }

    /**
     * Get only files
     *
     * @param $disk
     * @param $content
     *
     * @return array
     */
    protected function filterFile($content): array
    {
        // select only dir
        $filesList = array_filter($content, fn($item) => $item['type'] === 'file');

        $files = array_map(function ($item) {
            $pathInfo = pathinfo($item['path']);

            return [
                'type'       => $item['type'],
                'path'       => $item['path'],
                'basename'   => $pathInfo['basename'],
                'dirname'    => $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'],
                'extension'  => $pathInfo['extension'] ?? '',
                'filename'   => $pathInfo['filename'],
                'size'       => $item['fileSize'],
                'timestamp'  => $item['lastModified'],
                'visibility' => $item['visibility'],
                'url' => Storage::disk(self::DISK)->temporaryUrl($item['path'], now()->addMinute(self::TEMPORARLY_URL))];
        }, $filesList);

        return array_values($files);
    }
}
