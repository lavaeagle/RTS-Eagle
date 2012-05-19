<form class="form-horizontal">
    <fieldset>
      <div class="control-group">
        <label class="control-label" for="focusedInput">Username</label>
        <div class="controls">
          <input class="input-xlarge focused" id="focusedInput" type="text" value="">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="focusedInput">Email</label>
        <div class="controls">
          	<input class="input-xlarge focused" id="focusedInput" type="email" value="">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="focusedInput">Password</label>
        <div class="controls">
          <input class="input-xlarge focused" id="focusedInput" type="password" value="">
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <a href='<?php echo $relative; ?>sign-in' class="btn">Already have an account?</a>
      </div>
    </fieldset>
  </form>