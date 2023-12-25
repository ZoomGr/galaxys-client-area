<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\StreamedResponse;

interface MediaRepository
{
    public function getDirectoryData(string $name): array;

    public function getFileData(string $path):? array;

    public function getFolderData(string $path):? array;

    public function getDirectoryDataWithSize(string $name): array;

    public function getFileUrl(string $name):? string;

    public function downloadFile(string $path);

    public function downloadFolder(string $path);

    public function getFileBase64(string $path);

    public function checkPathIsFavorite(array $path_data_array, string $folder_path,  int $queue);
}
