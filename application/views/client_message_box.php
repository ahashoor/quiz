<div class="container_12 clearfix" align="center" >
    <?php if(isset($notification)){ ?>
    </br> <div class="message info closeable" align="left">
                <span class="message-close"></span>
                <h3></h3>
                <p><?php echo $notification->member_email;?><?php echo $lang_notification['info']?></p>
        </div>
	<div class="grid_12">
         
		<form class="form has-validation" method="post" id="formSettings">
			<div class="clearfix">
                            <label for="name" class="form-label"><?php echo $lang_notification['email']?></label>
				<div class="form-input">
					<input type="text"  readonly="readonly"  value="<?php echo $notification->member_email;?>"/>
				</div>
			</div>
			<div class="clearfix">
				<label for="name" class="form-label"> <?php echo $lang_notification['group']?> </label>
				<div class="form-input">
					<input type="text" readonly="readonly"  value="<?php echo $notification->group_name;?>"/>
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label"> <?php echo $lang_notification['quiz_name']?> </label>
				<div class="form-input">
					<input type="text" readonly="readonly"   value="<?php echo $notification->quiz_name;?>"/>
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label"> <?php echo $lang_notification['question_nr']?> </label>
				<div class="form-input">
					<input type="text"readonly="readonly"  value="<?php echo $notification->quiz_questions;?>"/>
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label"> <?php echo $lang_notification['score']?> </label>
				<div class="form-input">
					<input type="text" readonly="readonly"   value="<?php echo $notification->score;?> %"/>
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label"> <?php echo $lang_notification['time_used']?> </label>
				<div class="form-input">
					<input type="text" readonly="readonly"   value="<?php echo $notification->completed_time;?> %"/>
				</div>
			</div>
                        <div class="clearfix">
				<label for="name" class="form-label"> <?php echo $lang_notification['complete_data']?> </label>
				<div class="form-input">
					<input type="text" readonly="readonly"  value="<?php echo $notification->data;?>"/>
				</div>
			</div>
		</form>
	</div>
    <?php } else{ ?>
    
    <div class="grid_12">
         
		<form class="form has-validation" method="post" id="formSettings">
                        <div class="clearfix">
                            <label for="name" class="form-label">Data</label>
				<div class="form-input">
                                    <input type="text"  readonly="readonly"  value="<?php echo ucfirst($message['added_on']);?>"/>
				</div>
			</div>
                        <div class="clearfix">
                            <label for="name" class="form-label">From</label>
				<div class="form-input">
					<input type="text"  readonly="readonly"  value="<?php echo ucfirst($message['name']); if($message['admin']==1){echo' (admin)';}else{echo' (user)';}?>"/>
				</div>
			</div>
			<div class="clearfix">
                            <label for="name" class="form-label">Subject</label>
				<div class="form-input">
					<input type="text"  readonly="readonly"  value="<?php echo ucfirst($message['subject']);?>"/>
				</div>
			</div>
			<div class="clearfix">
				<label for="name" class="form-label">Message </label>
				<div class="form-input">
                                        <textarea rows="5" style="resize: none; " placeholder="Message" name="message"><?php echo ucfirst($message['message']);?></textarea>
				</div>
			</div>
                       
		</form>
	</div>
    <?php } ?>
</div>

<script type="text/javascript">
 
$(function(){
     $('input,textarea').on("focus",function(){
         this.blur();
     }) 
});
</script>
                