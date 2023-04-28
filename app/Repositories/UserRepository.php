<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getUsersForTenant(?string $tenantID=null): Collection
    {
        return User::when($tenantID, function (Builder $query, string $tenantID) {
            $query->whereHas('tenants', function (Builder $tQuery) use ($tenantID) {
                $tQuery->where('tenants.id', $tenantID);
            });
        })->get();
    }
}
