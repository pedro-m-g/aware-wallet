<?php ob_start() ?>
    <section class="content">
        <h2>Inicio de sesión</h2>
        <form>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" autocomplete="email" />
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </div>
            <div class="form-group">
                <a href="/sign-up" class="btn btn-secondary">
                    Crear cuenta
                </a>
            </div>
            <div class="form-group">
                <a href="/forgot-pasword">
                    Olvidé mi contraseña
                </a>
            </div>
        </form>
    </section>
<?php

$content = ob_get_clean();
echo $this->render('layouts/main', [
    'content' => $content
]);
