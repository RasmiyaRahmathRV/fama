<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct(
        protected $search = null,
        protected $filter = null,
    ) {}

    public function collection()
    {
        $query = User::with(['company', 'user_type'])->whereNotNull('company_id');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->where('last_name', 'like', "%{$search}%")
                    ->orWhere('user_code', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('profile_photo', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user_type', function ($q2) use ($search) {
                        $q2->where('user_type', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(users.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($this->filter) {
            $query->where('company_id', $this->filter);
        }


        return $query->get()
            ->map(function ($user) {
                return [
                    'ID' => $user->id,
                    'User Code' => $user->user_code,
                    'Company' => $user->company->company_name ?? '',
                    'User Type' => $user->user_type->user_type ?? '',
                    'Full Name' => $user->first_name . ' ' . $user->last_name,
                    'Phone' => $user->phone,
                    'Email' => $user->email,
                    'Username' => $user->username,
                    // 'Profile Photo' => $user->profile_photo,

                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Code',
            'Company',
            'User Type',
            'Full Name',
            'Phone',
            'Email',
            'Username',
            // 'Profile Photo',
        ];
    }
}
