<div class="py-5 flex-grow-1 text-white min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card p-4 rounded shadow form-bg">
                    <h2 class="text-center mb-4">Регистрация</h2>
                    <?php if (isset($message) && $message): ?>
                        <div class="alert alert-<?php echo $message['status'] === 'success' ? 'success' : 'danger'; ?> mb-4" role="alert">
                            <?php echo htmlspecialchars($message['message']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST" class="was-validated">
                        <div class="form-group">
                            <label for="uname">Логин</label>
                            <input type="text" class="form-control form-input" id="uname" name="uname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Электронная почта</label>
                            <input type="email" class="form-control form-input" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Пароль</label>
                            <input type="password" class="form-control form-input" id="pwd" name="pswd" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd-confirm">Подтвердите пароль</label>
                            <input type="password" class="form-control form-input" id="pwd-confirm" name="pwd-confirm" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4">Зарегистрироваться</button>
                    </form>
                    <p class="form-footer">Уже есть аккаунт?<span><a href="/login">Войти</a></span></p> 
                </div>
            </div>
        </div>
    </div>
</div>