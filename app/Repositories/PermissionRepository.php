<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PermissionRepository
{
    public function all()
    {
        return UserPermission::all();
    }

    public function find($id)
    {
        return UserPermission::findOrFail($id);
    }

    public function getByName($userData)
    {
        return UserPermission::where($userData)->first();
    }

    public function create($data)
    {
        return UserPermission::create($data);
    }

    public function assignToUser(User $user, array $permissions)
    {
        return $user->permissions()->sync($permissions);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $user = UserPermission::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            $user->restore();
        }

        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }

    public function checkIfExist($data)
    {
        $existing = UserPermission::withTrashed()
            ->where('user_id', $data['user_id'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }

    public function insertBulk(array $rows)
    {
        return UserPermission::insert($rows); // bulk insert
    }
}
