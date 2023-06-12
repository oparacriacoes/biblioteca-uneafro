<div id="{{ $idModal }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title mx-auto text-secondary" id="myModalLabel" style="font-size: 24px;">
                    {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="post" action="{{ $route }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="alert">Você realmente deseja excluir este registro?</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit" class="btn btn-danger" aria-hidden="true">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>