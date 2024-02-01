<?php

// app/Exports/UserExport.php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\UserController;

class UserExport implements FromCollection, WithHeadings
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        // Define the data you want to export for all users
        return $this->users->map(function ($user) {
            return [
                'Name' => $user->firstname,
                'Email' => $user->email,
                'Phone Number' => $user->phoneNumber,
                'Gender' => $user->gender,
            ];
        });
    }

    public function headings(): array
    {
        // Define the column headings for the exported data
        return [
            'Name',
            'Email',
            'Phone Number',
            'Gender',
        ];
    }
}
