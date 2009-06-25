<style type="text/css">label {80px;}</style>
<h2>Editing Exit Code for '<?php echo $html->link($pkgActType, array('controller'=>'packages', 'action'=>'view', 'action', $pkgActId), array('title'=>$pkgActCmd)); ?>' Package Action</h2><hr class="hbar" />
<?php echo $form->create("ExitCode", array("url" => "/packages/edit/exitcode/" . $this->data['ExitCode']['id'])); ?>
<div class="inputwrap"><label for="ExitCodeCode" title="<?php echo TOOLTIP_EXITCODE_CODE; ?>"><span class="required">*</span>Code:</label><?php echo $form->input('code', array('label' => false, 'class'=>'input', 'div' => false, 'size' => 8)) ?></div>
<div class="inputwrap"><label for="ExitCodeReboot" title="<?php echo TOOLTIP_EXITCODE_REBOOT; ?>">Reboot:</label><?php echo $form->input('reboot', array('label' => false, 'div' => false, 'options' => array(EXITCODE_REBOOT_FALSE => 'None', EXITCODE_REBOOT_TRUE => 'Yes', EXITCODE_REBOOT_DELAYED => 'Delayed', EXITCODE_REBOOT_POSTPONED => 'Postponed'))) ?></div>
<div class="inputwrap"><label>&nbsp;</label><?php echo $form->end('Submit'); ?></div>