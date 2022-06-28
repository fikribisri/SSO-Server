<?php

namespace App\Http\Controllers\Admin;

use App\Models\Crendential;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CredentialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.credential.index');
    }

    public function create(){
        return view('admin.credential.create');
    }

    public function getData(){
        $data = Crendential::whereNull('deleted_at')->whereNotIn('id', [1,2]);
        return Datatables::of($data)
            ->addColumn('action', function ($datas) {
                return '
                    <div class="btn-group">
                        <button class="btn btn-primary" type="button">Action</button>
                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(71px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <form method="POST" action="'.route('admin.credential.destroy', [$datas->id]).'">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="dropdown-item" onclick="deletealert()"> <i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'redirect' => 'required'
        ]);

        if($validated){

            $model = Crendential::create([
                'name' => $request->name,
                'redirect' => $request->redirect,
                'secret'=>Str::random(40),
                'personal_access_client'=>false,
                'password_client'=>false,
                'revoked'=>false,
                'trusted'=>true
            ]);

            if($model->save()){
                return redirect(route('admin.credential'))->with('success', 'Data Berhasil disimpan');
            }
        }
    }

    public function destroy($id)
    {
        $model = Crendential::findOrFail($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        if($model->save()){
            return redirect(route('admin.credential'))->with('success', 'Data Berhasil di hapus.');
        }
    }
}
