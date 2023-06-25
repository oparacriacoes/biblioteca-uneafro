<div id="import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <form class="form" id="import-form" method="post" action="{{ $route }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div style="color: white;">{{ $message }}</div><br>
                    <div class="form-group">
                        <label class="text-primary">Clique para escolher arquivo</label>
                        <input type="file" id="csv-file" name="csv-file" onchange="updateFileName(this)">
                    </div>
                    <div id="csv-rows"></div>
                    <input type="hidden" id="invalid-rows" name="invalid-rows">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit-csv" class="btn btn-primary mx-auto">
                        Importar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
