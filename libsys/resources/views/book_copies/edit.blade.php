<div class="card" style="height: 295px">
    <div class="card-header">
        <h4 class="card-title" style="text-align: center;">Editar Acervo {{ $book['idBookCopie'] }}</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="{{ route('book_copies.update', serialize($book['idBookCopie'])) }}">
            <div class="card-body">
                @csrf
                @method('put')

                @include('components.radio', ['reference_book' => $book['reference_book']])
            </div>
            <br>
            <div style="text-align: center;" class="card-footer">
                <button type="submit" class="btn btn-primary btn-round btn-lg">Confirmar</button>
            </div>
        </form>
    </div>
</div>
