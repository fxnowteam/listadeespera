<?
include("../inc/core.php");
conecta();
$id = mysql_real_escape_string($_POST["id"]);
if($id != ""){
        $selpessoa = mysql_query("SELECT * FROM listadeespera WHERE id = '$id'") or die(mysql_error());
        $f = mysql_fetch_array($selpessoa);
        ?>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            &Cross;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								Incluir em grupo
							</h4>
						</div>
						<div class="modal-body" id="chamargrupo">
                                                    <div class="form-group">
                                                      <label class="col-md-4 control-label" for="selectbasic">Em qual grupo este paciente ficar&aacute;?</label>
                                                      <div class="col-md-8">
                                                        <select id="grupo" name="selectbasic" class="form-control">
                                                            <?
                                                            $sel = mysql_query("SELECT * FROM grupos ORDER BY id DESC") or die(mysql_error());
                                                            while($h = mysql_fetch_array($sel)){
                                                                echo "<option value=\"".$h["id"]."\">".$h["descricao"]." - ".data($h["data"])."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                      </div>
                                                      <div style="clear: both"></div>
                                                    </div>
                                                    <div class="form-group">
                                                      <label class="col-md-4 control-label" for="selectbasic">Confirmar presen&ccedil;&atilde;o?</label>
                                                      <div class="col-md-8">
                                                        <select id="confirmado" name="selectbasic" class="form-control">
                                                            <option value="1">Sim</option>
                                                            <option value="0">N&atilde;o</option>
                                                        </select>
                                                      </div>
                                                      <div style="clear: both"></div>
                                                    </div>
                                                    <div class="form-group">
                                                      <label class="col-md-4 control-label" for="selectbasic">Anota&ccedil;&otilde;es</label>
                                                      <div class="col-md-8">
                                                        <textarea id="anotacoes" name="selectbasic" class="form-control"><?= $f["anotacoes"] ?></textarea>
                                                      </div>
                                                      <div style="clear: both"></div>
                                                    </div>
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Fechar
							</button> 
							<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="incluirEmGrupo('<?= $id ?>')">
								Salvar
							</button>
						</div>
					</div>
					
				</div>
<?
}