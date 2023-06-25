<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Models\MemberType;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $members = Member::query()
            ->join('member_type', 'member.id_member_type', '=', 'member_type.id')
            ->select('member.*', 'member_type.type')
            ->orderBy('full_name')
            ->get();

        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($members);
    
        return view('member.index')->with(['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData]);
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $slMemberType = (MemberType::query()->orderBy('type')->get())->toArray();

        return view('member.create')->with('slMemberType', $slMemberType);
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param MemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MemberRequest $request)
    {
        $validatedData = $request->validated();

        Member::create([
            'full_name' => $validatedData['full_name'],
            'id_member_type' => $validatedData['id_member_type'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'cpf' => $validatedData['cpf'],
            'id_user' => auth()->user()->id
        ]);

        return redirect()->route('member.index')->with('success', 'Membro adicionado com sucesso!');
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
        $member = Member::findOrFail(unserialize($id));
        $slMemberType = (MemberType::query()->orderBy('type')->get())->toArray();

        return view('member.edit')->with(['member' => $member, 'slMemberType' => $slMemberType]);
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param MemberRequest $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MemberRequest $request, string $id)
    {
        $request->validated();

        $member = Member::findOrFail(unserialize($id));

        $member->full_name = $request->input('full_name');
        $member->id_member_type = $request->input('id_member_type');
        $member->email = $request->input('email');
        $member->phone = $request->input('phone');
        $member->cpf = $request->input('cpf');
        $member->id_user = auth()->user()->id;

        $member->save();

        return redirect()->route('member.index')->with('success', 'Membro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail(unserialize($id));
        $member->delete();

        return redirect()->route('member.index')->with('success', 'Membro excluído com sucesso!');
    }

    /**
     * Import the specified resource from storage.
     * @access public
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $file = $request->file('csv-file');
        
        $lines = file($file->getPathname());
        array_shift($lines);

        $lineRemove = json_decode($request->input('invalid-rows'));
        $callback = function($key) use ($lineRemove) {
            return !in_array($key, $lineRemove);
        };
        
        $filteredLines = array_filter($lines, $callback, ARRAY_FILTER_USE_KEY);

        foreach ($filteredLines as $line) {
            $columns = explode(';', $line);
            $columns[4] = str_replace("\r\n", '', $columns[4]);

            Member::create([
                'full_name' => $columns[0],
                'id_member_type' => $columns[1],
                'email' => empty($columns[2]) ? null : $columns[2],
                'phone' => empty($columns[3]) ? null : $columns[3],
                'cpf' => empty($columns[4]) ? null : $columns[4],
                'id_user' => auth()->user()->id
            ]);
        }
        
        return redirect()->route('member.index')->with('success', 'Membros importados com sucesso!');
    }

    /**
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return ['Nome', 'Tipo', 'Email', 'Telefone', 'CPF', 'Editar', 'Excluir'];
    }

    /**
     * Method to get table data
     * @access private
     * @param Illuminate\Database\Eloquent\Collection $members
     * @return array $arrayData
     */
    private function getArrayData($members)
    {
        $arrayData = [];
        foreach ($members as $member) {
            $arrayData[] = [
                'full_name' => $member->full_name,
                'type' => $member->type,
                'email' => $member->email,
                'phone' => $member->phone,
                'cpf' => !is_null($member->cpf) ? $this->formatCpf($member->cpf) : '',
                'edit' => $this->getIconEdit('member', serialize($member->id)),
                'delete' => $this->getIconDelete('member', $member->id, 'Excluir Membro')
            ];
        }

        return $arrayData;
    }
}
