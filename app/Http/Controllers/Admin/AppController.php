<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $model = Settings::find(1);

        return view('admin.app.index',compact(['model']));
    }

    public function update(Request $request,$id)
    {
        $model = Settings::find($id);
        if(empty($model)){
            return redirect(route('admin.app'))->with('warning', 'Data tidak di temukan');
        }
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'company_name' => 'required',
            'url' => 'required',
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'smtp_driver' => 'required|max:255',
            'smtp_encryption' => 'required|max:255',
            'from_email'=>'required|max:150',
            'from_name'=>'required|max:250'
        ]);

        if($validated){
            $file_logo = $request->file('logo');
            $file_name_logo = '';
            if(!empty($file_logo)){
                $file_name_logo = md5("logo_".date('YmdHis')).".".$file_logo->getClientOriginalExtension();
            }else{
                if(!empty($model->logo)){
                    $file_name_logo = $model->logo;
                }else{
                    $file_name_logo = '';
                }
            }

            $file_logo_small = $request->file('logo_small');
            $file_name_logo_small = '';
            if(!empty($file_logo_small)){
                $file_name_logo_small = md5("logo_small_".date('YmdHis')).".".$file_logo_small->getClientOriginalExtension();
            }else{
                if(!empty($model->logo_small)){
                    $file_name_logo_small = $model->logo_small;
                }else{
                    $file_name_logo_small = '';
                }
            }

            $file_bg = $request->file('background_login');
            $file_name_bg = '';
            if(!empty($file_bg)){
                $file_name_bg = md5("logo_bg".date('YmdHis')).".".$file_bg->getClientOriginalExtension();
            }else{
                if(!empty($model->background_login)){
                    $file_name_bg = $model->background_login;
                }else{
                    $file_name_bg = '';
                }
            }

            $models = Settings::whereId($model->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'company_name'=>$request->company_name,
                'url'=>$request->url,
                'smtp_host'=>$request->smtp_host,
                'smtp_port'=>$request->smtp_port,
                'smtp_username' =>$request->smtp_username,
                'smtp_password'=>$request->smtp_password,
                'logo'=>$file_name_logo,
                'logo_small'=>$file_name_logo_small,
                'background_login'=>$file_name_bg,
                'smtp_driver' => $request->smtp_driver,
                'smtp_encryption' => $request->smtp_encryption,
                'from_email'=>$request->from_email,
                'from_name'=>$request->from_name,
            ]);

            if($models){
                if(!empty($file_logo)){$file_logo->move('image/app',$file_name_logo);}
                if(!empty($file_logo_small)){$file_logo_small->move('image/app',$file_name_logo_small);}
                if(!empty($file_bg)){$file_bg->move('image/app',$file_name_bg);}
                return redirect(route('admin.app'))->with('success', 'Data Berhasil disimpan');
            }
        }else{
            return redirect(route('admin.app'))->with('error', 'Error');
        }
    }
}
