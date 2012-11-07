<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<h1 class="page-title">Member Quiz Status</h1>
<div class="container_12 clearfix" ><br />
    <div id="ajax_members">
        <table id="quizStatus" class="display">
            <thead>
                    <th><?php echo $lang_quiz['top_quiz']['th8'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th1'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th2'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th3'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th4'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th5'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th6'];?></th>
                    <th><?php echo $lang_quiz['top_quiz']['th7'];?></th>
            </thead>
            <tbody>
            <?php $i=1;foreach($messages as $message): ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td align="center"><?php echo $message['member_email']; ?></td> 
                        <td align="center"><?php echo $message['group_name']; ?></td>
                        <td align="center"><?php echo $message['quiz_name']; ?></td>
                        <td align="center"><?php echo $message['quiz_questions']; ?></td>
                        <td align="center" ><?php echo $message['score']?> %</td>
                        <td align="center"><?php echo $message['completed_time']?> %</td>
                        <td align="center"><?php echo $message['data'] ?></td>
                    </tr>
            <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
$(function(){
     $('#quizStatus').dataTable( {
        "sPaginationType": "full_numbers"
    });
});
</script>

