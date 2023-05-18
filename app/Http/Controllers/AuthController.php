<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // set index page view
    public function register()
    {
        return view('register');
    }

    // handle fetch all eamployees ajax request
    public function fetchAll()
    {
        $emps = Account::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Post</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="storage/images/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->first_name . ' ' . $emp->last_name . '</td>
                <td>' . $emp->email . '</td>
                <td>' . $emp->post . '</td>
                <td>' . $emp->phone . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Account ajax request
    // public function add_account(Request $request)
    // {
    //     $file = $request->file('logo');
    //     $fileName = time() . '.' . $file->getClientOriginalExtension();
    //     $file->storeAs('public/images', $fileName);

    //     $accData = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         // 'password' => $request->password,
    //         'password' => Hash::make($request->password),
    //         'website' => $request->website,
    //         'logo' => $fileName
    //     ];
    //     Account::create($accData);
    //     return response()->json([
    //         'status' => 200,
    //     ]);
    // }
    public function add_account(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->accessToken;

            return response()->json([
                'status' => 200,
                'message' => 'Login successful.',
                'access_token' => $token,
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials.',
            ]);
        }
    }

    // handle edit an Account ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Account::find($id);
        return response()->json($emp);
    }

    // handle update an Account ajax request
    public function login_account(Request $request)
    {
        $fileName = '';
        $emp = Account::find($request->emp_id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->avatar) {
                Storage::delete('public/images/' . $emp->avatar);
            }
        } else {
            $fileName = $request->emp_avatar;
        }

        $empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Account ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Account::find($id);
        if (Storage::delete('public/images/' . $emp->avatar)) {
            Account::destroy($id);
        }
    }
}
