<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\CopieRequest;
use App\Models\Book;
use App\Models\BookCopies;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the users
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $books = $this->lstBook();
        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($books);
        $arrayIsbn = Book::query()->pluck('isbn')->toArray();

        return view('book.index')->with([
            'arrayHeader' => $arrayHeader,
            'arrayData' => $arrayData,
            'arrayIsbn' => $arrayIsbn
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param BookRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
    {
        $validatedData = $request->validated();

        $this->insData($validatedData, $validatedData['number_of_copies'], $validatedData['number_of_reference_book']);

        return redirect()->route('book.index')->with('success', 'Livro(s) adicionado(s) com sucesso!');
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
        $idBookCopie = unserialize($id);

        $book = ($this->lstBook($idBookCopie))[0];

        $bookCopies = BookCopies::query()->where('id_book', '=', $book['id'])->pluck('id')->toArray();

        $book['bookCopies'] = implode(", ", $bookCopies);

        return view('book.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param CopieRequest $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CopieRequest $request, string $id)
    {
        $requestData = $request->validated();

        $book = Book::findOrFail(unserialize($id));

        $book->update([
            'title' => $requestData['title'],
            'author' => $requestData['author'],
            'book_publisher' => $requestData['book_publisher'],
            'edition' => $requestData['edition'],
            'volume' => $requestData['volume'],
            'year' => $requestData['year'],
            'ISBN' => $requestData['ISBN'],
            'id_user' => auth()->user()->id
        ]);

        return redirect()->route('book.edit', ['book' => $request->input('idBookCopie')])->with(
            'success', 'Livro editado com sucesso!'
        );
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id
     */
    public function destroy(string $id)
    {
        //
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
        $filteredLines = $this->arrayFilter($lines, $lineRemove);

        foreach ($filteredLines as $line) {
            $columns = explode(';', $line);
            $columns[8] = str_replace("\r\n", '', $columns[8]);

            $this->insData($columns, $columns[6], $columns[7], true);
        }
        
        return redirect()->route('book.index')->with('success', 'Livro(s) importado(s) com sucesso!');
    }

    /**
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return [
            'Acervo',
            'Título',
            'Autor',
            'Editora',
            'Edição',
            'Volume',
            'Ano',
            'Nº de Cópias',
            'Livro de Referência',
            'ISBN',
            'Editar',
            'Excluir'
        ];
    }

    /**
     * Method to get table data
     * @access private
     * @param array $books
     * @return array $arrayData
     */
    private function getArrayData($books)
    {
        $arrayData = [];
        foreach ($books as $book) {
            $arrayData[] = [
                'collection' => $book['idBookCopie'],
                'title' => $book['title'],
                'author' => $book['author'],
                'book_publisher' => $book['book_publisher'],
                'edition' => $book['edition'],
                'volume' => $book['volume'],
                'year' => $book['year'],
                'number_of_copies' => $book['number_of_copies'],
                'reference_book' => $book['reference_book'] ? 'Sim' : 'Não',
                'ISBN' => $book['ISBN'],
                'edit' => $this->getIconEdit('book', serialize($book['idBookCopie'])),
                'delete' => $this->getIconDelete('book_copies', $book['idBookCopie'], 'Excluir Livro')
            ];
        }

        return $arrayData;
    }

    /**
     * Method to list the books
     * @access private
     * @param int|null $idBookCopie id of table book_copies
     * @return array array of book copies
     */
    private function lstBook($idBookCopie = null)
    {
        $query = Book::query()
            ->select('b.id', 'b.title', 'b.author', 'b.book_publisher', 'b.edition', 'b.volume', 'b.year',
                'b.number_of_copies', 'bc.reference_book', 'b.ISBN', 'bc.id as idBookCopie')
            ->from('book as b')
            ->join('book_copies as bc', 'b.id', '=', 'bc.id_book')
            ->orderBy('b.title');

        if (!is_null($idBookCopie)) {
            $query->where('bc.id', '=', $idBookCopie);
        }

        return $query->get()->toArray();
    }

    /**
     * Method to insert book and copies
     * @access private
     * @param array $book array with book data
     * @param int $numberOfCopies number of copies
     * @param int $numberOfReferenceBooks number of reference books
     * @param bool $import
     */
    private function insData($book, $numberOfCopies, $numberOfReferenceBooks, $import = false)
    {
        if (!$import) {
            $book = Book::create([
                'title' => $book['title'],
                'author' => $book['author'],
                'book_publisher' => $book['book_publisher'],
                'edition' => $book['edition'],
                'volume' => $book['volume'],
                'year' => $book['year'],
                'number_of_copies' => $book['number_of_copies'],
                'ISBN' => $book['ISBN'],
                'id_user' => auth()->user()->id
            ]);
        } else {
            $book = Book::create([
                'title' => $book[0],
                'author' => $book[1],
                'book_publisher' => $book[2],
                'edition' => $book[3],
                'volume' => $book[4],
                'year' => $book[5],
                'number_of_copies' => $book[6],
                'ISBN' => $book[8],
                'id_user' => auth()->user()->id
            ]);
        }

        for ($i = 0; $i < $numberOfReferenceBooks; $i++) {
            BookCopies::create(['id_book' => $book->id, 'reference_book' => 1]);
        }

        for ($i = 0; $i < $numberOfCopies - $numberOfReferenceBooks; $i++) {
            BookCopies::create(['id_book' => $book->id]);
        }
    }
}
