<?php
namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index(){
        return view('admin.user.index');
    }

    public function create(){
        $role = User::getRole();

        return view('admin.user.create',compact(['role']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users',
            'phone_number' => 'max:20',
            'date_of_birth' => 'date',
            'role' => 'required',
        ]);

        // The blog post is valid...
    }


    public function getData(){
        $data = User::whereNull('deleted_at');
        return Datatables::of($data)
            ->editColumn('full_name', function ($datas) {
                    return $datas->username." / ".$datas->full_name;
            })
            ->editColumn('role', function ($datas) {
                    return $datas->role == 1 ? 'Administrator' : 'User';
            })
            ->editColumn('is_active', function ($datas) {
                    return $datas->is_active == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-dark">Inactive</span>';
            })
            ->addColumn('action', function ($datas) {
                return '
                    <div class="btn-group">
                        <button class="btn btn-primary" type="button">Action</button>
                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(71px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="javascript:void(0)" value="'.route('admin.user.edit', [$datas->id]).'" data-toggle="modal" data-target="#modal" class="dropdown-item modal-show"><i class="fa fa-edit"></i> Edit</a>
                            <form method="POST" action="'.route('admin.user.destroy', [$datas->id]).'">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="dropdown-item" onclick="deletealert()"> <i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    public function getRow(Request $request){
        $new_id = $request->id;
        $model = User::findOrFail($new_id);

    	$new_values = "<table class=\"table\"><tr><th>Username</th><td>".$model->username."</td></tr><tr><th>Full Name</th><td>".$model->full_name."</td></tr><tr><th>Date of Birth</th><td>".(!empty($model->date_of_birth) ? $model->date_of_birth : '')."</td></tr><tr><th>Phone Number</th><td>".$model->phone_number."</td></tr><tr><th>Foto</th><td>".(!empty($model->foto) ? '<img class="img-avatar" src="'.asset('data/profile/'.$model->foto.'').'" alt="admin@" width="100px" height="100px">' : '')."</td></tr></table>";
    	$arr = [
    		'new'=>$new_values
    	];
	    return response()->json(['data'=>$arr]);
    }

    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $model->deleted_at = date('Y-m-d');
        if($model->save()){
            return redirect(route('admin.user'))->with('success', 'Data Berhasil di hapus.');
        }
    }
}
