<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('email','!=','admin@gmail.com')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Surname',
            'Email',
            'Role',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->surname,
            $user->email,
            $user->roles->first()->name,
        ];
    }
}
