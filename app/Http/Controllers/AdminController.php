<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
class AdminController extends Controller
{
    public function dashboard()
    {
        // var_dump('hii');
        // die();
        // Fetch users with role_id 2 (assuming role_id 2 is for users)
        $users = DB::table('users')
            ->join('roles_user', 'users.id', '=', 'roles_user.user_id')
            ->where('roles_user.role_id', 2)
            ->select('users.id','users.firstname', 'users.email', 'users.phoneNumber', 'users.status')
            ->get();
        
        // Pass the data to the view
        return view('admin.dashboard', compact('users'));
    }
    public function editUser($id)
    {
        // Fetch the user by ID
        $user = User::find($id);

        // Pass the user data to the edit view
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'firstname' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:15',
            // Add other fields as needed
        ]);

        // Update the user
        $user = User::find($id);
        $user->firstname = $request->input('firstname');
        $user->phoneNumber = $request->input('phoneNumber');
        $user->status = $request->input('status');
        // Update other fields as needed
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');
    }
    public function deleteUser($id)
    {
        // Delete user from 'users' table
        User::destroy($id);

        // Delete corresponding entry from 'roles_user' table
        DB::table('roles_user')->where('user_id', $id)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    }
    // public function exportUser($id)
    // {
    //     $user = User::findOrFail($id);

    //     // Use the UserExport class to export user data
    //     return Excel::download(new UserExport($user), 'user_details.xlsx');
    // }
    public function exportUsersWithRoleTwo()
    {
        $usersWithRoleTwo = User::whereHas('roles', function ($query) {
            $query->where('role_id', 2);
        })->get();

        return Excel::download(new UserExport($usersWithRoleTwo), 'users.xlsx');
    }
    public function getStates()
    {
        // Replace this array with your actual list of states
        $states = [
            'Andhra Pradesh',
            'Arunachal Pradesh',
            'Assam',
            'Bihar',
            'Chhattisgarh',
            'Goa',
            'Gujarat',
            'Haryana',
            'Himachal Pradesh',
            'Jharkhand',
            'Jammu and Kashmir',
            'Karnataka',
            'Kerala',
            'Ladakh',
            'Madhya Pradesh',
            'Maharashtra',
            'Manipur',
            'Meghalaya',
            'Mizoram',
            'Nagaland',
            'Odisha',
            'Punjab',
            'Rajasthan',
            'Sikkim',
            'Tamil Nadu',
            'Telangana',
            'Tripura',
            'Uttar Pradesh',
            'Uttarakhand'
        ];

        return response()->json($states);
    }
}
