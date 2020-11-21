<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\newUsuarios;
use App\Models\Perfil;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    protected $dadosUsuario;
    protected $dadosPerfil;

    public function __construct(User $user, Perfil $perfil)
    {
        $this->dadosUsuario = $user;
        $this->dadosPerfil = $perfil;
    }

    public function indexUsuario()
    {
        $usuarios = $this->dadosUsuario->simplePaginate();

        return view('admin.usuario.index', compact('usuarios'));
    }

    public function createUsuario()
    {
        $user = Auth::user();
        if ($user->perfil_id == Perfil::ADMIN) {
            $perfils = $this->dadosPerfil->get();
        } else {
            $perfils = $this->dadosPerfil->where('id', '<>', Perfil::ADMIN)->get();
        }
        
        return view('admin.usuario.create', compact('perfils'));
    }
    public function storeUsuario(Request $request)
    {
        $data = $request->all();
        $nova_senha = Str::random(8);
        $data['status_id'] = 2; //padrão ativo 
        $data['password'] = Hash::make($nova_senha);
        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("/usuarios");
        } 
        //dd($data);
        $usuario = $this->dadosUsuario->create($data);

        Mail::to($usuario->email)->send(new newUsuarios($nova_senha));

        return redirect()->route('usuario.index')->with('success', 'Usuario cadastrada com sucesso..');
    }

    public function editSenha()
    {  
        return view('admin.usuario.novasenha.edit');
    }
    public function updateSenha(Request $request)
    {        
        $user = Auth::user();
        $usuario = $this->dadosUsuario->find($user->id);
        if(!$usuario){
            return redirect()->back();
        }
        $data['status_id'] = Status::ATIVO; //padrão ativo 
        $data['password'] = Hash::make($request->password);

        $usuario->update($data);

        return redirect()->route('login');
    }
}
