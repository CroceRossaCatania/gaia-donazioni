<?php

/*
 * ©2013 Croce Rossa Italiana
 */

paginaAdmin();

?>
<div class="row-fluid">
    <div class="span3">
        <?php        menuVolontario(); ?>
    </div>
    <div class="span9">
        <h2><i class="icon-envelope muted"></i> Invio Mail</h3>
        <div class="alert alert-block alert-info">
            <h4><i class="icon-question-sign"></i> Pronto a mandare la mail ?</h4>
            <p>Modulo per l'invio mail di massa</p>
        </div>
        <?php if(isset($_GET['pres'])){ ?>
          <form class="form-horizontal" action="?p=admin.mail.nuova.ok&pres" method="POST">
        <?php }else{ ?>
          <form class="form-horizontal" action="?p=admin.mail.nuova.ok" method="POST">
        <?php } ?>
            <div class="control-group">
              <label class="control-label" for="inputDestinatari">Destinatari</label>
              <div class="controls">
                <input type="text" class="span5" name="inputDestinatari" id="inputDestinatari" readonly value="Destinatari Multipli">
              </div>
            </div>     
            <div class="control-group">
              <label class="control-label" for="inputOggetto">Oggetto</label>
              <div class="controls">
                <input type="text" class="span6" name="inputOggetto" id="inputOggetto" required>
              </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="inputTesto">Testo</label>
            <div class="controls">
              <textarea rows="10" class="input-xxlarge conEditor" type="text" id="inputTesto" name="inputTesto" placeholder="Inserisci il testo della tua mail qui..."></textarea>
            </div>
          </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success btn-large">
                    <i class="icon-envelope"></i>
                    Invia mail
                </button>
            </div>
          </form>

    </div>
</div>
