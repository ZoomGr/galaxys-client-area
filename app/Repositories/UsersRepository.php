<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface UsersRepository
{
    public function updateFavorites(Request $request): bool;
    public function updateFavoriteFiles(Request $request): bool;
    public function updateNotificationSeen(): bool;

    public function getFavorites(): ?Collection;
}
