<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    // set index page view
    public function index()
    {
        return view('index');
    }

    // handle fetch all eamployees ajax request
    public function fetchAll()
    {
        $comps = Company::all();
        $output = '';
        if ($comps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Website</th>
                <th>City</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($comps as $comp) {
                $output .= '<tr>
                <td>' . $comp->id . '</td>
                <td><img src="storage/images/' . $comp->logo . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $comp->name  . '</td>
                <td>' . $comp->email . '</td>
                <td>' . $comp->website . '</td>
                <td>' . $comp->city . '</td>
                <td>
                  <a href="#" id="' . $comp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editCompanyModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $comp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Company ajax request
    public function store(Request $request)
    {
        $file = $request->file('logo');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $compData = [
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'city' => $request->city,
            'logo' => $fileName
        ];
        Company::create($compData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Company ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $comp = Company::find($id);
        return response()->json($comp);
    }

    // handle update an Company ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $comp = Company::find($request->comp_id);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($comp->logo) {
                Storage::delete('public/images/' . $comp->logo);
            }
        } else {
            $fileName = $request->comp_logo;
        }

        $compData = [
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'city' => $request->city,
            'logo' => $fileName
        ];

        $comp->update($compData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Company ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $comp = Company::find($id);
        if (Storage::delete('public/images/' . $comp->logo)) {
            Company::destroy($id);
        }
    }
}
