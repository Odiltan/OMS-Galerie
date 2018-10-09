<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <form action="galerie-add-photos.php?action=add-galerie" method="post" class="form-horizontal" 
enctype="multipart/form-data"> 
    <fieldset> 
 
    <!-- Text input-->     <div class="form-group"> 
      <label class="col-md-4 control-label" for="titre">Titre</label>   
      <div class="col-md-4"> 
      <input id="gal-titre" name="titre" class="form-control input-md" type="text"> 
      </div> 
    </div> 
 
    <!-- Textarea -->     <div class="form-group"> 
      <label class="col-md-4 control-label" for="description">Description</label> 
      <div class="col-md-4">                      
        <textarea class="form-control" id="gal-description" name="description"></textarea> 
      </div> 
    </div> 
 
    <!-- File Button -->      <div class="form-group"> 
      <label class="col-md-4 control-label" for="miniature">Miniature</label> 
      <div class="col-md-4"> 
        <input id="gal-miniature" name="miniature" class="input-file" type="file"> 
      </div> 
    </div> 
 
    <!-- Button (Double) -->     <div class="form-group"> 
      <div class="col-md-offset-4 col-md-4 text-right"> 
        <input id="gal-save" class="btn btn-info" type="submit" name="save" value="Enregistrer" /> 
        <button id="gal-cancel" name="cancel" class="btn btn-danger">Annuler</button> 
      </div> 
    </div> 
 
    </fieldset> 
</form>
</html>
