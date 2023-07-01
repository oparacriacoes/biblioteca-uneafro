<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCopiesRequest;
use App\Models\Book;
use App\Models\BookCopies;
use Illuminate\Http\Request;

class BookCopiesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @access public
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param BookCopiesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookCopiesRequest $request)
    {
        $validatedData = $request->validated();

        $idBook = unserialize($request->input('idBook'));

        $this->updNumberOfCopies($idBook, $validatedData['copies']);
        
        for ($i = 0; $i < $validatedData['reference_books']; $i++) {
            BookCopies::create(['id_book' => $idBook, 'reference_book' => 1]);
        }

        for ($i = 0; $i < $validatedData['copies'] - $validatedData['reference_books']; $i++) {
            BookCopies::create(['id_book' => $idBook]);
        }

        return redirect()->route('book.edit', ['book' => $request->input('idBookCopie')])->with(
            'success', 'Cópia(s) adicionada(s) com sucesso!'
        );
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
     * @param string $id
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param Request $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $bookCopie = BookCopies::findOrFail(unserialize($id));
        
        $bookCopie->update(['reference_book' => $request->input('reference_book')]);

        return redirect()->route('book.edit', ['book' => serialize($bookCopie->id)])->with(
            'success', 'Acervo ' . $bookCopie->id . ' editado com sucesso!'
        );
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $bookCopie = BookCopies::findOrFail(unserialize($id));

        $idBook = $bookCopie->id_book;

        $bookCopie->delete();

        $copies = $this->updNumberOfCopies($idBook, -1);

        if ($copies == 0) {
            $book = Book::findOrFail($idBook);
            $book->delete();

            $msg = 'Livro excluído com sucesso!';
        } else {
            $msg = 'Cópia excluída com sucesso!';
        }

        return redirect()->route('book.index')->with('success', $msg);
    }

    /**
     * Update the number of copies of the book
     * @access private
     * @param int $idBook id of table book
     * @param int $copies number of copies
     * @return int new number of copies
     */
    private function updNumberOfCopies(int $idBook, int $copies)
    {
        $book = Book::findOrFail($idBook);
        $book->update(['number_of_copies' => $book->number_of_copies + $copies]);

        return $book->number_of_copies;
    }
}
