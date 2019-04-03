<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 p-4">
            <div class="card">
                <div class="card-header">Inscription</div>
                    <div class="card-body">
                    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?= form_open('user/signup'); ?>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <label for="inputlastname">* Nom</label>
                                <input type="text" class="form-control" id="inputlasname" placeholder="Dupont" name="lastname">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputfirstname">* Prénom</label>
                                <input type="text" class="form-control" id="inputfirstname" placeholder="Jean" name="firstname">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputEmail4">* Email</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="jean@castellane.com" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">* Mot de passe</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="*******" name="password">
                            </div>
                            <hr>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputage">* Age</label>
                                <input type="text" class="form-control" placeholder="18" id="inputage" name="age">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputsexe">* Civilité</label>
                                <select  id="inputsexe" class="custom-select" name="sexe">
                                    <option selected>Civilité</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputtel">* Téléphone</label>
                                <input type="text" class="form-control" id="inputtel" name="phone">
                            </div>
                            <div class="form-group col-12 col-md-6">
                            </div>
                            <hr>
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
                                <input type="text" class="form-control" id="inputreply" name="reply">
                            </div>
                            <input type="submit" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

   