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
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $users = User::query()
            ->where('id', '!=', 1)
            ->orderBy('name')
            ->orderBy('last_name')
            ->get();
        
        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($users);

        return view('user.index')->with(['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData]);
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        User::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf'],
            'password' => Hash::make($validatedData['password'])
        ]);

        return redirect()->route('user.index')->with('success', 'Usuário adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     * @access public
     * @param string $id
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        $user = User::findOrFail(unserialize($id));

        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param ProfileRequest $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request, string $id)
    {
        $request->validated();

        $user = User::findOrFail(unserialize($id));

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->cpf = $request->input('cpf');

        $user->save();

        return redirect()
            ->route('user.edit', ['user' => serialize(auth()->user()->id)])
            ->with('success', 'Usuário editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail(unserialize($id));
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
    }

    /**
     * Change the password
     * @access public
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
            ->route('user.edit', ['user' => serialize(auth()->user()->id)])
            ->with('password_status', 'Senha atualizada com sucesso!');
    }

    /**
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return ['Usuário', 'Email', 'CPF', 'Excluir'];
    }

    /**
     * Method to get table data
     * @access private
     * @param Illuminate\Database\Eloquent\Collection $users
     * @return array $arrayData
     */
    private function getArrayData($users)
    {
        $arrayData = [];
        foreach ($users as $user) {
            $arrayData[] = [
                'user' => $user->name . ' ' . $user->last_name,
                'email' => $user->email,
                'cpf' => $this->formatCpf($user->cpf),
                'delete' => $this->getIconDelete($user->id)
            ];
        }

        return $arrayData;
    }
}
