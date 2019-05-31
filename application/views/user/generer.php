
<div class="container">
    <div class="mt-2 col-md-12 order-md-1">
        <?= form_open('user/generer') ?>
            <div class="form-row mt-5">
            <div class="form-group col-12 col-md-6">
                    <label for="inputreply">Nom</label>
                    <input type="text" class="form-control" id="inputreply" required name="lastname" placeholder="Saisir votre Nom">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="inputreply">Prénom</label>
                    <input type="text" class="form-control" id="inputreply" required name="firstname" placeholder="Saisir votre Prénom">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="inputreply">Age</label>
                    <input type="number" class="form-control" id="inputreply" required name="age" placeholder="Saisir votre age">
                </div>
                <div class="form-group col-12 col-md-6">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="inputState">Question</label>
                    <select id="inputState" class="form-control" name="idquestion">
                        <option selected disabled>Sélectionner une Question</option>
                        <?php foreach ($questions as $question): ?>
                            <option value="<?= $question['idquestion'] ?>"><?= $question['content'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="inputreply">Réponse</label>
                    <input type="text" class="form-control" id="inputreply" required name="reply" placeholder="Saisir votre réponse">
                </div>
                <input type="submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>
