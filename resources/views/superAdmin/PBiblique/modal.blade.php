<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Modifier l'événement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="eventTitle">Titre</label>
                    <input type="text" class="form-control" id="eventTitle">
                </div>
                <div class="form-group">
                    <label for="eventDate">Date</label>
                    <input type="date" class="form-control" id="eventDate">
                </div>
                <div class="form-group">
                    <label for="eventTime">Heure</label>
                    <input type="time" class="form-control" id="eventTime">
                </div>
                <div class="form-group">
                    <label for="eventColor">Couleur</label>
                    <input type="color" class="form-control" id="eventColor">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-danger" id="delete-event">Supprimer</button>
                <button type="button" class="btn btn-primary" id="save-event">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>



<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet événement ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirm-delete-event">Supprimer</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Ajouter Texte -->
<div class="modal fade" id="addTextModal" tabindex="-1" aria-labelledby="addTextModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTextModalLabel">Ajouter un Texte Biblique</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <label for="modalTexteBiblique">Texte: </label>
                    <input id="modalTexteBiblique" type="text" class="form-control" placeholder="Texte biblique">
                </div>
                <div class="input-group mt-3">
                    <label for="modalTexteBibliqueDate">Date: </label>
                    <input id="modalTexteBibliqueDate" type="date" class="form-control">
                </div>
                <div class="input-group mt-3">
                    <label for="modalTexteBibliqueHeure">Heure: </label>
                    <input id="modalTexteBibliqueHeure" type="time" class="form-control">
                </div>
                <div class="input-group mt-3">
                    <label for="modalTexteBibliqueColor">Couleur: </label>
                    <input id="modalTexteBibliqueColor" type="color" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save-modal-text">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Ajouter Thème de la semaine -->
<div class="modal fade" id="addThemeModal" tabindex="-1" aria-labelledby="addThemeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addThemeModalLabel">Ajouter un Thème de la semaine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <label for="modalThemeSemaine">Thème: </label>
                    <input id="modalThemeSemaine" type="text" class="form-control" placeholder="Thème de la semaine">
                </div>
                <div class="input-group mt-3">
                    <label for="modalThemeSemaineDate">Date (plage semaine): </label>
                    <input id="modalThemeSemaineDate" type="text" class="form-control" placeholder="Date">
                </div>
                <div class="input-group mt-3">
                    <label for="modalTexteBibliqueColor">Couleur: </label>
                    <input id="modalTexteBibliqueColor" type="color" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save-modal-theme">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>
