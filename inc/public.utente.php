<?php

/*
 * ©2013 Croce Rossa Italiana
 */

paginaPrivata();

?>
<?php 

$f = $_GET['id']; 
$t= Persona::filtra([
  ['id', $f]
]);
$g= Volontario::by('id',$f);
$a=TitoloPersonale::filtra([['volontario',$f]]);
?>
<!--Visualizzazione e modifica anagrafica utente-->
<div class="row-fluid">
    <div class="span6">
  <!--Visualizzazione e modifica avatar utente-->
        <div class="span12">
        <h2><i class="icon-edit muted"></i> Anagrafica</h2>
            <div class="span12 allinea-centro">
        <img src="<?php echo $g->avatar()->img(20); ?>" class="img-polaroid" />
               <br/><br/></div>
            </div>
            
<form class="form-horizontal" action="?p=presidente.utente.modifica.ok&t=<?php echo $f; ?>" method="POST">
        <hr />
        <div class="control-group">
              <label class="control-label" for="inputNome">Nome</label>
              <div class="controls">
                <input readonly type="text" name="inputNome" id="inputNome"  <?php if(!$me->admin()){?> readonly <?php } ?> value="<?php echo $t[0]->nome; ?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputCognome">Cognome</label>
              <div class="controls">
                <input readonly type="text" name="inputCognome" id="inputCognome"  <?php if(!$me->admin()){?> readonly <?php } ?> value="<?php echo $t[0]->cognome; ?>">
                
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputDataNascita">Data di Nascita</label>
              <div class="controls">
                <input readonly type="text" class="input-small" name="inputDataNascita" id="inputDataNascita" <?php if(!$me->admin()){?> readonly <?php } ?> value="<?php echo date('d/m/Y', $t[0]->dataNascita); ?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputComuneNascita">Comune di Nascita</label>
              <div class="controls">
                <input readonly type="text" name="inputComuneNascita" id="inputComuneNascita" <?php if(!$me->admin()){?> readonly <?php } ?> value="<?php echo $t[0]->comuneNascita; ?>">
              </div>
            </div>
          </form>    
    </div>
    <!--Visualizzazione e modifica titoli utente-->
    <?php $titoli = $conf['titoli']; ?>
    <div class="span6">
   <h3><i class="icon-list muted"></i> Curriculum </h3>
        
        <div id="step1">
       

            <table class="table table-striped table-condensed table-bordered" id="risultatiRicerca" style="display: none;">
                <thead>
                    <th>Nome risultato</th>
                    <th>Cerca</th>
                </thead>
                <tbody>

                </tbody>
            </table>
            
          </div>
        
        <div id="step2" style="display: none;">
            <form action='?p=presidente.titolo.nuovo&id=<?php echo $t[0]->id; ?>' method="POST">
            <input type="hidden" name="idTitolo" id="idTitolo" />
            <div class="alert alert-block alert-success">
                <div class="row-fluid">
                    <h4><i class="icon-question-sign"></i> Quando hai ottenuto...</h4>
                </div>
                <hr />
                <div class="row-fluid">
                    <div class="span4 centrato">
                        <label for="dataInizio"><i class="icon-calendar"></i> Ottenimento</label>
                    </div>
                    <div class="span8">
                        <input id="dataInizio" class="span12" name="dataInizio" type="text" value="" />
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4 centrato">
                        <label for="dataFine"><i class="icon-time"></i> Scadenza</label>
                    </div>
                    <div class="span8">
                        <input id="dataFine" class="span12" name="dataFine" type="text" value="" />
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4 centrato">
                        <label for="luogo"><i class="icon-road"></i> Luogo</label>
                    </div>
                    <div class="span8">
                        <input id="luogo" class="span12" name="luogo" type="text" value="" />
                    </div>
                </div>
                <div class="row-fluid">
                <div class="span4 centrato">
                        <label for="codice"><i class="icon-barcode"></i> Codice</label>
                    </div>
                    <div class="span8">
                        <input id="codice" class="span12" name="codice" type="text" value="" />
                    </div>
                </div>
                <div class="row-fluid">
                <div class="span4 centrato">
                        <label for="codice"><i class="icon-barcode"></i> N. Patente</label>
                    </div>
                    <div class="span8">
                        <input id="codice" class="span12" name="codice" type="text" value="" />
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4 offset8">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-plus"></i>
                                Aggiungi il titolo
                        </button>
                    </div>
                </div>
                
            </div>
            
        </div>    
  
     <?php $ttt = $a; ?>
                <table class="table table-striped">
                    <?php foreach ( $ttt as $titolo ) { ?>
                    <tr <?php if (!$titolo->tConferma) { ?>class="warning"<?php } ?>>
                        <td>
                            <?php if ($titolo->tConferma) { ?>
                                    <abbr title="Confermato: <?php echo date('d-m-Y H:i', $titolo->tConferma); ?>">
                                        <i class="icon-ok"></i>
                                    </abbr>
                            <?php } else { ?>
                                <abbr title="Pendente">
                                    <i class="icon-time"></i>
                                </abbr>
                            <?php } ?> 
                                
                            <strong><?php echo $titolo->titolo()->nome; ?></strong><br />
                            <small><?php echo $conf['titoli'][$titolo->titolo()->tipo][0]; ?></small>
                        </td>

                        
                            <?php if ( $titolo->inizio ) { ?>
                            <td><small>
                                <i class="icon-calendar muted"></i>
                                <?php echo date('d-m-Y', $titolo->inizio); ?>
                                
                                <?php if ( $titolo->fine ) { ?>
                                    <br />
                                    <i class="icon-time muted"></i>
                                    <?php echo date('d-m-Y', $titolo->fine); ?>
                                <?php } ?>
                                <?php if ( $titolo->luogo ) { ?>
                                    <br />
                                    <i class="icon-road muted"></i>
                                    <?php echo $titolo->luogo; ?>
                                 <?php } ?>
                                 <?php if ( $titolo->codice ) { ?>
                                    <br />
                                    <i class="icon-barcode muted"></i>
                                    <?php echo $titolo->codice; ?>
                                  <?php } ?>
                            </small></td>
                            <?php } else { ?>
                            <td>&nbsp;</td>
                            <?php } ?>
                    </tr>
                    <?php } ?>
                </table>
    </div>
</div>