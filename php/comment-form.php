  <hr/>
  <h2>Schreibe einen Kommentar</h2>
  <form action="http://anmutunddemut.de/php/comment.php" method="POST">
    
    <p>
      <label for="edit-name">Dein Name: </label> 
      <input type="text" maxlength="60" name="name" id="edit-name" size="30" value="" class="form-text" />
    </p>       
    
    <p>
      <label for="edit-mail">E-Mail-Adresse: </label> 
      <input type="text" maxlength="64" name="mail" id="edit-mail" size="30" value="" class="form-text" /> 
      <br/><span class="description">Never published. Never spammed.</span> 
    </p>  
   
    <p>
      <label for="edit-homepage">Homepage: </label> 
      <input type="text" maxlength="255" name="homepage" id="edit-homepage" size="30" value="" class="form-text" /> 
    </p>
    
    <textarea name="text"> </textarea>
    
    <p><input type="submit"></p>
  </form>
