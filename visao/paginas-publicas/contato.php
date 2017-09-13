<div class="row">
            <div class="col-12 mx-auto">
                <form method='post' action='contato.php'>
                    <div class="form-group row">
                        <label for="categoria" class="col-sm-12 col-md-6 col-form-label">Tipo de mensagem:</label>
                        <div class="col-sm-12 col-md-6">
                        <select class="form-control" id="categoria" name="categoria" required>
                            <?php 
                                include_once $_SERVER['DOCUMENT_ROOT']."/modelo/CategoriaNoticia.class.php";

                                $categoria = new CategoriaNoticia();
                                $categorias = $categoria->listarTodos();
                                foreach ($categorias as $categoria) {
                                    echo '<option value="' . $categoria->getId() . '">' . $categoria->getDescricao() . '</option>';
                                }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nome" class="col-sm-12 col-md-4 col-form-label">Seu nome:</label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" id="nome" name='nome' required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-12 col-md-4 col-form-label">Seu e-mail:</label>
                        <div class="col-sm-12 col-md-8">
                            <input type="email" class="form-control" id="email" name='email' required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mensagem" class="col-sm-12 col-md-4 col-form-label">Digite sua mensagem:</label>
                        <div class="col-sm-12 col-md-8">
                            <textarea class="form-control" rows="3" id="mensagem" name="mensagem" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 mx-auto">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" name="enviar" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>