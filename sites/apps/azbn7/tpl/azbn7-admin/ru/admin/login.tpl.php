<?
// Административный шаблон
?>

	<form class="form-signin" action="<?=$this->Azbn7->mdl('Site')->url('/admin/login/');?>" method="POST" >
		
		<h2 class="form-signin-heading">Please sign in</h2>
		
		<label for="inputEmail" class="sr-only">Login</label>
		<input type="text" name="login" class="form-control" placeholder="Your login" required autofocus />
		
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" name="pass" class="form-control" placeholder="Password" required />
		
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		
	</form>