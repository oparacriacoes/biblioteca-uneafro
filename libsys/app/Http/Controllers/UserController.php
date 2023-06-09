<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::query()
            ->where('id', '!=', 1)
            ->where('deleted', '=', 0)
            ->orderBy('name')
            ->orderBy('last_name')
            ->get();
        
        $arrayHeader = ['Usuário', 'Email', 'CPF', 'Excluir'];

        $arrayData = [];
        foreach ($users as $user) {
            $cpf = substr($user->cpf, 0, 3) . '.' . substr($user->cpf, 3, 3) . '.' . substr($user->cpf, 6, 3)
                . '-' . substr($user->cpf, 9);
            $arrayData[] = [
                'user' => $user->name . ' ' . $user->last_name,
                'email' => $user->email,
                'cpf' => $cpf,
                'delete' => [
                    'id' => $user->id,
                    'title' => 'Excluir Usuário',
                    'target' => '#delete_user_' . $user->id,
                    'icon' => 'text-primary fas fa-trash-alt',
                    'dataToggle' => 'modal'
                ]
            ];
        }

        return view('user.index')->with(['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        User::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'cpf' => $validatedData['cpf'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('user.index')->with('success', 'Usuário adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, string $id)
    {
        $request->validated();

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->cpf = $request->input('cpf');
        $user->email = $request->input('email');

        $user->save();

        return redirect()
            ->route('user.edit', ['user' => auth()->user()])
            ->with('success', 'Usuário editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail(unserialize($id));
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        $request->validated();

        $user = User::findOrFail(auth()->user()->id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()
            ->route('user.edit', ['user' => auth()->user()])
            ->with('password_status', 'Senha atualizada com sucesso!');
    }
}
