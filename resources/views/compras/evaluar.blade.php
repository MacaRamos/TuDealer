<div class="modal fade" id="evaluarModal" tabindex="-1" role="dialog" aria-labelledby="evaluarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluarModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('resena', ['compra_id' => $compra->compra_id]) }}" method="post">
                @csrf @method('post')
                <div class="modal-body">
                    <div class="row">
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="puntaje" value="5"/>
                            <label for="star5" data-toggle2="tooltip" data-placement="top" title="Excelente">5 stars</label>
                            <input type="radio" id="star4" name="puntaje" value="4"/>
                            <label for="star4" data-toggle2="tooltip" data-placement="top" title="Buena">4 stars</label>
                            <input type="radio" id="star3" name="puntaje" value="3"/>
                            <label for="star3" data-toggle2="tooltip" data-placement="top" title="Pasable">3 stars</label>
                            <input type="radio" id="star2" name="puntaje" value="2"/>
                            <label for="star2" data-toggle2="tooltip" data-placement="top" title="Pobre">2 stars</label>
                            <input type="radio" id="star1" name="puntaje" value="1"/>
                            <label for="star1" data-toggle2="tooltip" data-placement="top" title="Mala">1 star</label>
                        </fieldset>
                    </div>
                    <div class="row pt-2">
                        <label class="font-weight-normal">Reseña</label>
                        <textarea class="form-control" rows="5" name="resena" id="resena" minlength="0"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
