<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    public function index()
    {
        $data = [
            'credit' => Credit::all(),
            'title' => 'Credit',
        ];
        return view('admin.credit.index', $data);
    }

    public function edit($uuid)
    {
        $credit = Credit::where('uuid', $uuid)->firstOrFail();
        return response()->json($credit);
    }

    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'project_leader' => 'required|string',
            'system_analyst' => 'required|string',
            'frontend_developer' => 'required|string',
            'backend_developer' => 'required|string',
            'uiux_designer' => 'required|string',
            'administrator_contact' => 'required|string',
            'guidebook' => 'nullable|file|mimes:pdf|max:2048',
        ], [
            'project_leader.required' => 'Project Leader wajib diisi.',
            'system_analyst.required' => 'System Analyst wajib diisi.',
            'frontend_developer.required' => 'Frontend Developer wajib diisi.',
            'backend_developer.required' => 'Backend Developer wajib diisi.',
            'uiux_designer.required' => 'UI/UX Designer wajib diisi.',
            'administrator_contact.required' => 'Administrator Contact wajib diisi.',
            'guidebook.mimes' => 'Guidebook harus dalam format PDF.',
            'guidebook.max' => 'Ukuran file guidebook maksimal adalah 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $data = $request->except(['_token', '_method', 'guidebook']);

        if ($request->hasFile('guidebook')) {
            $file = $request->file('guidebook');
            $randomName = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/guidebooks', $randomName, 'public');
            $data['guidebook'] = $randomName;
        }

        Credit::where('uuid', $uuid)->update($data);
        notify()->success('Data Berhasil Diperbarui');
        return response()->json(['success' => true]);
    }


    public function guidebook($uuid)
    {
        $credit = Credit::where('uuid', $uuid)->firstOrFail();

        $data = [
            'title' => 'Guidebook',
            'fileUrl' => $credit->guidebook ? asset('storage/uploads/guidebooks/' . $credit->guidebook) : null
        ];
        return view('admin.credit.guidebook', $data);
    }
}
