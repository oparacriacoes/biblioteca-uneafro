<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
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
        $books = Book::query()->orderBy('title')->get();

        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($books);

        $bookIsbn = array_unique(array_column(Book::query()->select('book.isbn')->get()->toArray(), 'isbn'));

        return view('book.index')->with([
            'arrayHeader' => $arrayHeader,
            'arrayData' => $arrayData,
            'arrayIsbn' => $bookIsbn
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

        $totalBooks = $validatedData['number_of_copies'] + $validatedData['number_of_reference_book'];

        for ($i = 0; $i < $totalBooks; $i++) {
            Book::create([
                'title' => $validatedData['title'],
                'author' => $validatedData['author'],
                'book_publisher' => $validatedData['book_publisher'],
                'edition' => $validatedData['edition'],
                'volume' => $validatedData['volume'],
                'year' => $validatedData['year'],
                'number_of_copies' => $validatedData['number_of_copies'],
                'number_of_reference_book' => $validatedData['number_of_reference_book'],
                'ISBN' => $validatedData['ISBN'],
                'id_user' => auth()->user()->id
            ]);
        }

        return redirect()->route('book.index')->with('success', 'Livro adicionado com sucesso!');
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
        $book = Book::findOrFail(unserialize($id));

        return view('book.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param BookRequest $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookRequest $request, string $id)
    {
        $request->validated();

        $book = Book::findOrFail(unserialize($id));

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->book_publisher = $request->input('book_publisher');
        $book->edition = $request->input('edition');
        $book->volume = $request->input('volume');
        $book->year = $request->input('year');
        $book->number_of_copies = $request->input('number_of_copies');
        $book->number_of_reference_book = $request->input('number_of_reference_book');
        $book->ISBN = $request->input('ISBN');
        $book->id_user = auth()->user()->id;

        $book->save();

        return redirect()->route('book.index')->with('success', 'Livro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail(unserialize($id));
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Livro excluído com sucesso!');
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

            $totalBooks = $columns[6] + $columns[7];

            for ($i = 0; $i < $totalBooks; $i++) {
                Book::create([
                    'title' => $columns[0],
                    'author' => $columns[1],
                    'book_publisher' => $columns[2],
                    'edition' => $columns[3],
                    'volume' => $columns[4],
                    'year' => $columns[5],
                    'number_of_copies' => $columns[6],
                    'number_of_reference_book' => $columns[7],
                    'ISBN' => $columns[8],
                    'id_user' => auth()->user()->id
                ]);
            }
        }
        
        return redirect()->route('book.index')->with('success', 'Livros importados com sucesso!');
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
            'Nº de Livros de Referência',
            'ISBN',
            'Editar',
            'Excluir'
        ];
    }

    /**
     * Method to get table data
     * @access private
     * @param Illuminate\Database\Eloquent\Collection $books
     * @return array $arrayData
     */
    private function getArrayData($books)
    {
        $arrayData = [];
        foreach ($books as $book) {
            $arrayData[] = [
                'collection' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'book_publisher' => $book->book_publisher,
                'edition' => $book->edition,
                'volume' => $book->volume,
                'year' => $book->year,
                'number_of_copies' => $book->number_of_copies,
                'number_of_reference_book' => $book->number_of_reference_book,
                'ISBN' => $book->ISBN,
                'edit' => $this->getIconEdit('book', serialize($book->id)),
                'delete' => $this->getIconDelete('book', $book->id, 'Excluir Livro')
            ];
        }

        return $arrayData;
    }
}
