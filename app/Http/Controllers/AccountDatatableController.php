<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountDatatableController extends Controller
{
    //
    public function index()
    {
        // Gets all data of all users, and the account_type_id of the current user ->paginate()
        $users = User::query()
        ->orderBy('created_at', 'asc')
        ->paginate();

        // Prevents non-staff from accessing the table
        if (request()->user()->account_type_id !== 2) {
            abort(403);
        }

        // Returns the account datatable view with the data of all users
        return view('accountData.index', ['users' => $users]);
    }
}
