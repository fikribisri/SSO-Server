<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Helpers\CustomFunction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.faq.index');
    }

    public function create(){
        return view('admin.faq.create');
    }

    public function getData(){
        $data = Faq::whereNull('deleted_at');
        return Datatables::of($data)
            ->addColumn('action', function ($datas) {
                return '
                    <div class="btn-group">
                        <button class="btn btn-primary" type="button">Action</button>
                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(71px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <form method="POST" action="'.route('admin.faq.destroy', [$datas->id]).'">
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
            'question' => 'required|max:255',
            'answers' => 'required'
        ]);

        if($validated){

            $model = Faq::create([
                'question' => $request->question,
                'answers' => $request->answers,
                'uid'=>CustomFunction::gen_uuid()
            ]);

            if($model->save()){
                return redirect(route('admin.faq'))->with('success', 'Data Berhasil disimpan');
            }
        }
    }

    public function destroy($id)
    {
        $model = Faq::findOrFail($id);
        $model->deleted_at = date('Y-m-d H:i:s');
        if($model->save()){
            return redirect(route('admin.faq'))->with('success', 'Data Berhasil di hapus.');
        }
    }
}
