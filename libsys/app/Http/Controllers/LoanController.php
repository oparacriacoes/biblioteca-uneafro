<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = $this->lstLoan();

        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($loans);

        return view('loan.index')->with(['arrayHeader' => $arrayHeader,'arrayData' => $arrayData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return ['Membro', 'Livro', 'Acervo', 'ISBN', 'Data de Empréstimo', 'Data de Devolução', 'Ação'];
    }

    /**
     * Method to get table data
     * @access private
     * @param array $loans
     * @return array $arrayData
     */
    private function getArrayData($loans)
    {
        $arrayData = [];
        foreach ($loans as $loan) {
            $arrayData[] = [
                'member' => $loan['full_name'],
                'book_title' => $loan['title'],
                'id_book_copie' => $loan['idBookCopie'],
                'isbn' => $loan['ISBN'],
                'loan_date' => $loan['loan_date'],
                'return_date' => $loan['return_date'],
                'action' => ' - '
            ];
        }

        return $arrayData;
    }

    /**
     * Method to list the books
     * @access private
     * @return array array of book copies
     */
    private function lstLoan()
    {
        return Loan::query()
            ->select('l.id', 'l.loan_date', 'l.return_date', 'm.full_name', 'b.title', 'b.ISBN',
                'bc.id as idBookCopie')
            ->from('loan as l')
            ->join('member as m', 'l.id_member', '=', 'm.id')
            ->join('book_copies as bc', 'l.id_book_copies', '=', 'bc.id')
            ->join('book as b', 'bc.id_book', '=', 'b.id')
            ->where('l.returned', '=', '0')
            ->orderBy('l.loan_date')
            ->get()
            ->toArray();
    }
}
