<?php 
$this->EyPlugin = new EyPluginComponent;
$this->Configuration = new ConfigurationComponent;
?>
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading"><?= $Lang->get('PROFILE') ?></div>
		 	<div class="panel-body">
			
				<?php 
			  	if($search_psc_msg != false AND !empty($search_psc_msg)) {
			  		foreach ($search_psc_msg as $key => $value) {
			  			if($value['PaysafecardMessage']['type'] == 1) {
			  				echo '<div class="alert alert-success"><b>'.$Lang->get('SUCCESS').' :</b> '.$Lang->get('YOUR_PSC_OF').' '.$value['PaysafecardMessage']['amount'].'€ '.$Lang->get('IS_VALID_GAIN').' : '.$value['PaysafecardMessage']['added_points'].' '.$this->Configuration->get_money_name().'.</div>';
			  			} elseif ($value['PaysafecardMessage']['type'] == 0) {
			  				echo '<div class="alert alert-danger"><b>'.$Lang->get('ERROR').' :</b> '.$Lang->get('YOUR_PSC_OF').' '.$value['PaysafecardMessage']['amount'].'€ '.$Lang->get('IS_INVALID').'</div>';
			  			}
			  		}
			  	}
			  	?>

			  	<div class="section">
					<p><b><?= $Lang->get('PSEUDO') ?> :</b> <?= $user['pseudo'] ?></p>
				</div>
				<div class="section">
					<p><b><?= $Lang->get('EMAIL') ?> :</b> <span id="email"><?= $user['email'] ?></span></p>
				</div>
				<div class="section">
					<p>
						<b><?= $Lang->get('RANK') ?> :</b> 
						<?php foreach ($available_ranks as $key => $value) {
							if($user['rank'] == $key) {
								echo $value;
							}
						} ?>
					</p>
				</div>
				<?php if($this->EyPlugin->isInstalled('Shop')) { ?>
					<div class="section">
						<p><b><?= $Lang->get('MONEY') ?> :</b> <span class="money"><?= $user['money'] ?></span></p>
					</div>
				<?php } ?>

				<div class="section">
					<p><b><?= $Lang->get('IP') ?> :</b> <?= $user['ip'] ?></p>
				</div>

				<div class="section">
					<p><b><?= $Lang->get('CREATED') ?> :</b> <?= $Lang->date($user['created']) ?></p>
				</div>

				<hr>

				<h3><?= $Lang->get('CHANGE_PASSWORD') ?></h3>

				<form method="post" class="form-inline" data-ajax="true" action="<?= $this->Html->url(array('plugin' => null, 'controller' => 'user', 'action' => 'change_pw')) ?>">
					 <div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="<?= $Lang->get('PASSWORD_CONFIRMATION') ?>">
					</div>
					 <div class="form-group">
						<input type="password" class="form-control" name="password_confirmation" placeholder="<?= $Lang->get('PASSWORD') ?>">
					</div>

					 <div class="form-group">
					 	<button class="btn btn-primary" type="submit"><?= $Lang->get('SUBMIT') ?></button>
					 </div>
				</form>

				<hr>

				<h3><?= $Lang->get('CHANGE_EMAIL') ?></h3>

				<form method="post" class="form-inline" data-ajax="true" action="<?= $this->Html->url(array('plugin' => null, 'controller' => 'user', 'action' => 'change_email')) ?>">
					<div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="<?= $Lang->get('EMAIL_CONFIRMATION') ?>">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" name="email_confirmation" placeholder="<?= $Lang->get('EMAIL') ?>">
					</div>

					<div class="form-group">
						<button class="btn btn-primary" type="submit"><?= $Lang->get('SUBMIT') ?></button>
					</div>
				</form>

				<?php if($shop_active) { ?>

					<hr>

					<h3><?= $Lang->get('SEND_POINTS') ?></h3>

					<form method="post" class="form-inline" data-ajax="true" action="<?= $this->Html->url(array('plugin' => null, 'controller' => 'user', 'action' => 'send_points')) ?>">
						<div class="form-group">
							<input type="text" class="form-control" name="to" placeholder="<?= $Lang->get('TO') ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="how" placeholder="<?= $Lang->get('HOW') ?>">
						</div>

						<div class="form-group">
							<button class="btn btn-primary" type="submit"><?= $Lang->get('SUBMIT') ?></button>
						</div>
					</form>

				<?php } ?>

				<?php if($this->Configuration->get('mineguard') == "true") { ?>

					<hr>

					<h3><?= $Lang->get('YOUR_ALLOWED_IP') ?></h3>

					<p><?= $Lang->get('WHAT_IS_MINEGUARD') ?></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table">
								<thead>
									<tr>
										<th><?= $Lang->get('IP') ?></th>
										<th><?= $Lang->get('ACTIONS') ?></th>
									</tr>
								</thead>
								<tbody id="table-ip">
									<?php 
									foreach ($api as $key => $value) { ?>
										<tr id="<?= $key ?>">
											<th><?= $value ?></th>
											<th><button data-ip-id="<?= $key ?>" class="btn btn-danger delete_ip"><?= $Lang->get('DELETE') ?></button></th>
										</tr>
									<?php } ?>
								</tbody>

							</table>
						</div>
			
						<div class="col-md-4">
							<form id="allowed_ip">
								<div class="ajax-msg-ip"></div>
								<div class="form-group">
									<input type="text" class="form-control" name="ip" placeholder="<?= $Lang->get('IP') ?>">
								</div>

								<div class="form-group">
									<button class="btn btn-success"><?= $Lang->get('ADD') ?></button>
								</div>
							</form>
						</div>
					</div>
					<div class="row">
						
						<div class="ajax-msg-mineguard"></div>
						<?php if($user['allowed_ip'] == '0') { ?>
							<button onClick="enableMineGuard();" class="btn btn-block btn-success"><?= $Lang->get('ENABLE') ?></button>
						<?php } else { ?>
							<button onClick="disableMineGuard();" class="btn btn-block btn-danger"><?= $Lang->get('DISABLE') ?></button>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if($can_skin) { ?>
					<hr>

					<h3><?= $Lang->get('SKIN') ?></h3>

					<form class="form-inline" method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="<?= $skin_max_size ?>" />
						<input type="hidden" name="skin_form" value="1">
					  <div class="form-group">
					    <label><?= $Lang->get('CHOOSE_YOUR_FILE') ?></label>
					    <input name="skin" type="file">
					  </div>
					  <button type="submit" class="btn btn-default"><?= $Lang->get('SUBMIT') ?></button>
					  <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;</div>
					  <div class="form-group">
					  	<u><?= $Lang->get('FILE_NEED') ?> :</u><br>

                		- <?= $Lang->get('BE_PNG') ?><br>
                		- <?= $Lang->get('WIDTH_MAX') ?><br>
                		- <?= $Lang->get('HEIGHT_MAX') ?><br>
					  </div>
					</form>
				<?php } ?>

				<?php if($can_cape) { ?>
					<hr>

					<h3><?= $Lang->get('CAPE') ?></h3>	

					<form class="form-inline" method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="<?= $cape_max_size ?>" />
						<input type="hidden" name="cape_form" value="1">
					  <div class="form-group">
					    <label><?= $Lang->get('CHOOSE_YOUR_FILE') ?></label>
					    <input name="cape" type="file">
					  </div>
					  <button type="submit" class="btn btn-default"><?= $Lang->get('SUBMIT') ?></button>
					  <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;</div>
					  <div class="form-group">
					  	<u><?= $Lang->get('FILE_NEED') ?> :</u><br>

                		- <?= $Lang->get('BE_PNG') ?><br>
                		- <?= $Lang->get('WIDTH_MAX') ?><br>
                		- <?= $Lang->get('HEIGHT_MAX') ?><br>
					  </div>
					</form>	
				<?php } ?>

				<?= $Module->loadModules('user_profile') ?>

		  	</div>
		</div>
	</div>
<script type="text/javascript">
	<?php if($this->Configuration->get('mineguard') == "true") { ?>

		function enableMineGuard() {
			$.post("<?= $this->Html->url(array('controller' => 'api', 'action' => 'enable_mineguard', 'admin' => false)) ?>", {}, function(data) {
	          	data2 = data.split("|");
			  	if(data.indexOf('true') != -1) {
	          		$('.ajax-msg-mineguard').empty().html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><i class="icon icon-exclamation"></i> <b><?= $Lang->get('SUCCESS') ?> :</b> '+data2[0]+'</i></div>').fadeIn(500);
	          	} else if(data.indexOf('false') != -1) {
	            	$('.ajax-msg-mineguard').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> '+data2[0]+'</i></div>').fadeIn(500);
		        } else {
			    	$('.ajax-msg-mineguard').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> <?= $Lang->get('ERROR_WHEN_AJAX') ?></i></div>');
			    }
	        });
	        return false;
		}

		function disableMineGuard() {
			$.post("<?= $this->Html->url(array('controller' => 'api', 'action' => 'disable_mineguard', 'admin' => false)) ?>", {}, function(data) {
	          	data2 = data.split("|");
			  	if(data.indexOf('true') != -1) {
	          		$('.ajax-msg-mineguard').empty().html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><i class="icon icon-exclamation"></i> <b><?= $Lang->get('SUCCESS') ?> :</b> '+data2[0]+'</i></div>').fadeIn(500);
	          		var table_ip = $('#table-ip').html();
	          		$('#table-mineguard').html(table_ip+'<tr><th>'+ip+'</th></tr>');
	          	} else if(data.indexOf('false') != -1) {
	            	$('.ajax-msg-mineguard').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> '+data2[0]+'</i></div>').fadeIn(500);
		        } else {
			    	$('.ajax-msg-mineguard').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> <?= $Lang->get('ERROR_WHEN_AJAX') ?></i></div>');
			    }
	        });
	        return false;
		}
		
		$("#allowed_ip").submit(function( event ) {
			$('.ajax-msg-ip').empty().html('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a><?= $Lang->get('LOADING') ?>...</div>').fadeIn(500);
	    	event.preventDefault();
	        var $form = $( this );
	        var ip = $form.find("input[name='ip']").val();
	        $.post("<?= $this->Html->url(array('controller' => 'api', 'action' => 'add_ip', 'admin' => false)) ?>", { ip : ip }, function(data) {
	          	data2 = data.split("|");
			  	if(data.indexOf('true') != -1) {
	          		$('.ajax-msg-ip').empty().html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><i class="icon icon-exclamation"></i> <b><?= $Lang->get('SUCCESS') ?> :</b> '+data2[0]+'</i></div>').fadeIn(500);
	          		var table_ip = $('#table-ip').html();
	          		$('#table-ip').html(table_ip+'<tr><th>'+ip+'</th></tr>');
	          	} else if(data.indexOf('false') != -1) {
	            	$('.ajax-msg-ip').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> '+data2[0]+'</i></div>').fadeIn(500);
		        } else {
			    	$('.ajax-msg-ip').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> <?= $Lang->get('ERROR_WHEN_AJAX') ?></i></div>');
			    }
	        });
	        return false;
	    });
		$(".delete_ip").click(function( event ) {
	    	event.preventDefault();
	    	var ip = $(this).attr('data-ip-id');
	    	console.log(ip);
	        $.post("<?= $this->Html->url(array('controller' => 'api', 'action' => 'delete_ip', 'admin' => false)) ?>", { ip : ip }, function(data) {
	          	data2 = data.split("|");
			  	if(data.indexOf('true') != -1) {
	          		$('#'+ip).fadeOut(500);
	          	} else if(data.indexOf('false') != -1) {
	            	$('.ajax-msg-ip').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> '+data2[0]+'</i></div>').fadeIn(500);
		        } else {
			    	$('.ajax-msg-ip').empty().html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><i class="icon icon-warning-sign"></i> <b><?= $Lang->get('ERROR') ?> :</b> <?= $Lang->get('ERROR_WHEN_AJAX') ?></i></div>');
			    }
	        });
	        return false;
	    });
	<?php } ?>
</script>