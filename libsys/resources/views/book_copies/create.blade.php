<div class="card">
    <div class="card-header">
        <h4 class="card-title" style="text-align: center;">Adicionar Cópias</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="{{ route('book_copies.store') }}">
            <div class="card-body">
                @csrf
                
                @include(
                    'components.input',
                    [
                        'placeholder' => 'Número de Cópias',
                        'name' => 'copies',
                        'icon' => 'fa-regular fa-id-card'
                    ]
                )

                @include(
                    'components.input',
                    [
                        'placeholder' => 'Número de Livros de Referência',
                        'name' => 'reference_books',
                        'icon' => 'fa-regular fa-id-card'
                    ]
                )

                <input type="hidden" id="idBook" name="idBook" value="{{ serialize($book['id']) }}">
                <input type="hidden" id="idBookCopie" name="idBookCopie" value="{{ serialize($book['idBookCopie']) }}">
            </div>
            <div style="text-align: center;" class="card-footer">
                <button type="submit" class="btn btn-primary btn-round btn-lg">Adicionar</button>
            </div>
        </form>
    </div>
</div>
