<div class="container mt-5">
  <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-5">Welcome to <?=$_GET['show'] ?> page</h1>
        <p class="col-lg-10 fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis tempora molestiae dolores consequuntur eligendi possimus a saepe modi laudantium magni repellendus neque quaerat culpa recusandae aspernatur maxime dolorem quasi, dolor!</p><br>
        <p class="text-success"> Don't have an account? Sign up <a href="index.php?show=Sign-up" class="text-success"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
  <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
  <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg></a></p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5 text-black mt-5">

        <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="index.php?show=Sign-in">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
            <label for="floatingPassword">Password</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
          <hr class="my-4">
          <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
</div>

<?php 
if (isset($_POST['submit'])) 
{
  require_once('classes/user.php');

  $email = $_POST['email'];
  // Remove all illegal characters from email
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  // Validate e-mail
  $email = filter_var($email, FILTER_VALIDATE_EMAIL);

  $user = new user($email, $_POST['password']);
  $user->auth();
}

?>