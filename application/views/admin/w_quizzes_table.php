<h3 class="page-title" align="center">Attach quizzes</h3>
<!-- select quiz to attach on client-->
    <div class="container_12 clearfix add_quiz">
         <div id="error_attach" class="message error closeable"style="display:none;">
                    <span class="message-close"></span>
                    <h3>Error !</h3>
                    <p></p>                        
        </div>
	<div class="grid_12">
		<br />
               
		 <table id="client_quizzes" class="display">
                    <thead>
                            <th class="srt"><input id="select_all" type="checkbox" /></th>
                            <th>Quiz Name</th>
                            <th>Quiz Category</th>
                            <th>Complete Time</th>
                            <th>Questions</th>
                            <th>Added</th>
                            <th class="action_hide">Actions</th>
                    </thead>
                    <tbody>
                    <?php foreach($quizzes as $quiz): 
                      
                            if($quiz['client_id'] != $client_id): 
                    ?>
                        <tr title="<?php  echo $quiz['client_id'];?>"> 
                                <td>
                                    <div  class="checker">
                                        <span class="second">
                                            <input class="check_member " id="<?php echo $quiz['id'] ?>"  type="checkbox"  />
                                        </span>
                                    </div>
                                </td>
                                <td align="center"><?php echo ucfirst($quiz['quiz_name']); ?></td>
                                <td align="center"><?php echo ucfirst($quiz['category']); ?></td>
                                <td align="center"><?php if( floor($quiz['complete_time'] / 60) > 0){echo floor($quiz['complete_time'] / 60)."h : ";}
                                echo floor($quiz['complete_time'] % 60)."min";?></td>
                                <td align="center"><?php echo $quiz['questions']?></td>
                                <td align="center"><?php echo $quiz['added_on']; ?></td>
                                <td align="center">
                                    <a class="view_quiz tooltip_new" href="main/client_quiz/view/<?php echo $quiz['id'] ?>" ><span>View quiz </span> <img alt="quiz"src="template/images/navicons-small/12.png"/></a> 
                                    <a class="edit_quiz tooltip_new" href="#main/client_quiz/edit/<?php echo $quiz['id'] ?>"><span>Edit quiz</span><img  alt="quiz"src="template/images/navicons-small/165.png"/></a> 
                                </td>
                            </tr>
                    <?php 
                            endif;
                            
                       endforeach; ?>
                    </tbody>
                </table>
                    <button id="att">Attack Quiz</button>
	</div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
     $('#client_quizzes').dataTable( {
        "sPaginationType": "full_numbers"
    });
    $("select[name=client_quizzes_length], :checkbox").uniform();
    
        //checkbox hack 
    $("#select_all").toggle(
    function () {
        $('#select-all').attr("checked", true);
        $("div.checker span").addClass('checked');
        $("input:checkbox").addClass('checked').attr("checked", true);
    },
    function () {
        $('#select-all').attr("checked", false);
       
        $("div.checker span").removeClass('checked');
        $("input:checkbox").removeClass('checked').attr("checked", false);
    });
    
    
        //add/change quizes to members
    $(document).on("click", "#att", function(event){
       var ids = [],
            clientId ='<?php echo $client_id?>';
        $(':input:checkbox:checked').each(function(){
                ids.push($(this).attr('id'));
        });
        $("#error_attach").hide();
        event.preventDefault();
        event.stopImmediatePropagation();
        if(ids.length === 0 ){
             $("#error_attach").show().find('p').html('select quizzes to attach on this client');
             $.colorbox.resize({inline:true});
        }else{
            $.ajax({type: "POST",url: 'main/admin_attach_quizzes',dataType:'json',data: 'client_id='+clientId+'&to='+ids+'&ajax=true',
                    success: function(data) {
                        if(data.status == 'succes'){
                            $(':checkbox:checked').each(function(){
                                $(this).attr('checked', false);
                                $(this).parent('span').removeClass('checked');
                            }); 
                            $("#success_admin").notify("create","success-container", {title: 'Succes', text: data.msg ,icon:'template/images/navicons/92.png'});
                            $("#ajax_clients").html("<div id='loading-container' style='margin-top:20%;'><p id='loading-content'><img id='loading-graphic' width='16' height='16' src='template/images/ajax-loader-abc4ff.gif' /> Loading...</p></div>");
                            $("#ajax_clients").load('main/load_ajax_table');
                            $.colorbox.close();
                        }else{
                            
                            $("#error_attach").show().find('p').html(data.msg);
                            $.colorbox.resize({inline:true});
                            
                        }	
                    }
                });
        }
    }); 
});
</script>