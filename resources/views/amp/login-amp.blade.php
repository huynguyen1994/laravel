@extends('layouts.amp')
  @section('main_amp')
  <header class="nav-bar top">
      <h1>&lt;amp-script&gt; exercise!</h1>
    </header>
    <main>
      <p>Welcome to our site! <br/> To register, enter your email address and a secure password.</p>
      <amp-script src="{{ asset('js/validate.js')}}" layout="fixed" sandbox="allow-forms" height="500" width="750">

      <form method="post" action-xhr="dsadasdsa" action="12312312s" target="_top" class="card">
        <div class="form-input">
          <label>Email:</label>
          <input type="text" name="email" tabindex=1 role="input" required>
        </div>
        <div class="form-input">
          <label>Password:</label>
          <input type=password 
                name="password"
                id="passwordBox"
                required
                role="input"
                tabindex=2
               >
        </div>
        <div id="rules" hidden>
          <span>Your password must contain each of the following:</span>
          <ul>
              <li id="lower">Lowercase letter</li>
              <li id="upper">Capital letter</li>
              <li id="digit">Digit</li>
              <li id="special">Special character (@$!%*?&)</li>
              <li id="eight">At least 8 characters</li>
          </ul>
        </div>
        <button type="submit" id="submitButton" tabindex="3" disabled>Submit</button> 
      </form>
    </amp-script>
    </main>



</form>
  @endsection



















