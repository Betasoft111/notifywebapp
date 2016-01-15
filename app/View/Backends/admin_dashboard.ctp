<div id="sub-nav">
	<div class="page-title">
		<h1>Dashboard</h1>
	</div>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper" style="min-height: 450px; " class="no-bg-image wrapper-full">
			<?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php CakeSession::delete('success'); ?>
			<?php } ?>
			<?php if($this->Session->check('error')){ ?>
				<div class="response-msg error ui-corner-all">
					<span>Error message</span>
					<?php echo $this->Session->read('error');?>
				</div>
				<?php CakeSession::delete('error'); ?>
			<?php } ?>
			<div class="content-box content-box-header" style="border:none;">
				<div class="hastable">                  
                                    
                   <!-- <table id="notes-table" style="float:right;width:25%;"> -->
                        <!--<thead> 
                            <tr>
                                <th align="left" style="text-align:left;" colspan="3"><span style="font-size: 14px">Notes</span></th>
                            </tr>								 
                        </thead>-->		
						<tbody> 						
							<!--<tr>
								<th style="line-height:22px; font-size:11px; color:#666; padding:5px 10px; " colspan="2"><div id="notes" style="width: 291px; height: 197px;"><?php// echo trim($note['Note']['notes'])==''?'Click here to add note...':$note['Note']['notes']?></div></th>
                                <th style="display:none; line-height:22px; font-size:11px; color:#666; padding:5px 10px;" colspan="2">
                         <?php /* ?>       	<form id="notes-form" >  <?php */ ?>
                       
                                	  <?php //echo $this->Form->create('users',array('type'=>'post','action'=>'save_notes','admin'=>'true'))?>
                                    	<input type="hidden" value="<?php// echo $note['Note']['id']?>" name="data[Note][id]" />
                                        <textarea name="data[Note][notes]" style="width: 291px; height: 197px;"><?php// echo strip_tags($note['Note']['notes'])?></textarea>
                                        <div style="float:right; margin-top:7px;">
                                        	<?php //echo $this->Html->image('loadingbar.gif',array('class'=>'loadingbar','alt'=>'Loading...','style'=>'display:none;float: left; margin-right: 14px; margin-top: 5px;'));?>
                                            <input type="button" onclick="window.location.href='<?php// echo HTTP_ROOT.'admin/users/dashboard'?>'" style="margin-right:10px;" value="Cancel" />
                                            <input type="submit" value="Save" />
                                        </div>
                                    </form>
                                </th>
							</tr> 
							<tr>								
								<th width="50%" style="line-height:22px; font-size:11px; color:#666; padding:5px 10px;"><strong class="update-note">Updated at: <?php// echo date('M-d-Y',strtotime($note['Note']['update_at']))?></strong></th>
							</tr>-->							
						</tbody>
                    </table>                 
                  <div class="clear"></div>
                </div>			
			</div>
			<div class="clearfix"></div>			
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<div class="clear"></div>