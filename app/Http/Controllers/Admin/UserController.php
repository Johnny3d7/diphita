<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function user(){
        return \Auth::user();
    }

    public function index(){
        $admins = User::where(['status'=>1])->get();
        return view('admin.user.index',compact('admins'));
    }

    function checkuser(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8|max:30'
        ],
        [
            'name.required'=>"Le nom d'utilidateur est un champ requis",
            'password.min' => "Le mot de passe doit avoir au moins 8 caractères",
            'password.required'=>"Le mot de passe est un champ requis"
        ]);

        $creds = $request->only('name','password');

        if (\Auth::guard('web')->attempt($creds)) {
            return redirect()->route('admin.index');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function show_profile(){

        $user = \Auth::user();

        return view('admin.user.show_profile',compact('user'));
    }

    public function edit_infos(){

        $user = $this->user();

        return view('admin.user.edit_infos',compact('user'));
    }

    public function update_infos(Request $request){

        $validatedData = Validator::make($request->all(),[

            'nom' => 'required|min:3' ,
            'pnom'=> 'required|min:3',
            'contact' => 'required|min:21',
            'email' => 'email',
        ], [
            'nom.required' => 'Le nom est un champ obligatoire.',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères.' ,
            'pnom.required' => 'Le prénom est un champ obligatoire.' ,
            'pnom.min' => 'Le prénom doit contenir au moins 3 caractères.' ,
            'contact.required' => 'Le contact est un champ obligatoire.' ,
            'contact.min' => 'Le contact doit contenir au moins 21 caractères.' ,
            'email.email' => 'Le champ email n\'est pas valide.' ,

        ]);
        //dd($validatedData->errors());
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with('message', 'Désolé une erreur est survenue.')->with('type', 'bg-danger');;
        }
        else{

                $this->user()->update([
                    'name' => $request->nom ,
                    'pnom'=> $request->pnom,
                    'contact' => $request->contact,
                    'email' => $request->email,
                ]);

                return redirect()->back()->with('message', 'Mot de passe modifié avec succès.')->with('type', 'bg-success');
        }

    }

    public function edit_password(){

        $user = $this->user();

        return view('admin.user.edit_password',compact('user'));
    }

    public function update_password(Request $request){

        $validatedData = Validator::make($request->all(),[

            'old_password' => 'required' ,
            'new_password'=> 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'L\'ancien mot de passe est un champ obligatoire.',
            'new_password.required' => 'Le nouveau mot de passe est un champ obligatoire.' ,
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.' ,
            'confirm_password.required' => 'Le mot de passe de confirmation un champ obligatoire.',
            'confirm_password.same' => 'Le nouveau mot de passe et le mot de passe de confirmation doivent être identiques.',
        ]);
        //dd($validatedData->errors());
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with('message', 'Désolé une erreur est survenue.')->with('type', 'bg-danger');;
        }
        else{

            if($this->check_user_password($request->old_password)){
                $this->user()->update([
                    'password' => Hash::make($request->new_password),
                ]);

                return redirect()->back()->with('message', 'Mot de passe modifié avec succès.')->with('type', 'bg-success');
            }
            else{
                return redirect()->back()->with('message', 'Votre ancien mot de passe est incorrect. Si cela persiste veuillez bien vouloir contacter l\'administrateur pour le réinitialiser.')->with('type', 'bg-danger');
            }

        }

    }

    public function check_user_password(string $pwd){

        if (Hash::check($pwd, $this->user()->password ))
        {
            return true;
        }
        return false;
    }

    public function reinitialiser_password($id){

        $user = User::find($id);
        $user->update([
            'password' => Hash::make('diphita2022'),
        ]);

        return redirect()->back()->with('message', 'Le mot de passe de l\'utilisateur à été réinitialisé et à pour valeur "diphita2022". ')->with('type', 'bg-success');
    }

    public function deactive_account($id){

        $user = User::find($id);
        $user->update([
            'active' => 0,
        ]);

        return redirect()->back()->with('message', 'Le compte a été désactivé.')->with('type', 'bg-success');
    }

    public function active_account($id){

        $user = User::find($id);
        $user->update([
            'active' => 1,
        ]);
        return redirect()->back()->with('message', 'Le compte a été activé.')->with('type', 'bg-success');
    }
}
