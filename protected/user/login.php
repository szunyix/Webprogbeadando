<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $postData = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
  ];
  if (empty($postData['email']) || empty($postData['password']) ) {
    echo "Hiányzó adat!";
  }else if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
    echo "hibás email";
  } else if (!userLogin($postData['email'], $postData['password'])) {
    echo "Hibás email cím vagy jelszó!";
  }


  $postData['password'] = "";
}
 ?>

<form method="post">
  <div class="form-group">
    <label for="LoginEmail">Email address</label>
    <input type="email" class="form-control" id="LoginEmail" aria-describedby="emailHelp" name="email" value="<?php isset($postData) ? $postData['email'] : ''; ?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="LoginPWord">Password</label>
    <input type="password" class="form-control" id="LoginPWord" name="password" value="">
  </div>
  <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>