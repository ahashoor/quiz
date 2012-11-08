<style>
.tscplayer_inline {
	position:static;
	margin: 20px 0 20px 150px;
	width: 640px;
	height: 480px;
	z-index:auto;
}
</style>
<h1 class="page-title"><?php echo $lang_page_title['how_it_works']['h1'];?></h1>
<iframe class="tscplayer_inline" name="tsc_player" src="<?php echo site_url('how_its_work/how_its_work_player.html');?>" scrolling="no" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<script type="text/javascript">
    $(function(){
     //change language system
    var sess_lang_update='<?php echo $this->session->userdata('lang_update')?>';
    if(sess_lang_update ==="updated"){
     $("select, :checkbox").uniform();
     $("#wrapper > section > section > section > div").css({'position':'relative','width':'96%'})
    }
     var  page_title = '<?php echo $lang_page_title['how_it_works']['h1'];?>',
                menu = $.parseJSON('<?php echo json_encode($lang_menu);?>'),
                lang = '<?php echo $this->session->userdata('language')?>';
                members = $.parseJSON('<?php echo json_encode($lang_members);?>');
    $.each(menu,function(key,val){
        $("span."+key).text(val);
    });
   
    if(lang =='en'){
        $("a.flag_after img").attr('src','template/images/ro.png');
        $("a.flag_after").attr('href','main/change_lang/ro');
    }else{
         $("a.flag_after img").attr('src','template/images/en.png');
         $("a.flag_after").attr('href','main/change_lang/en');
    }
    $("div.user-info").text(menu.welcome+' <?php echo strtoupper($this->session->userdata('loged_user')->full_name);?>');
    $("a.logout").text(menu.logout);
    $("h1.grid_12").text(page_title);
    $("button.back").text(menu.back);
    $("u.copyright").text(menu.copyright);
    $("u.created").text(menu.created);
//  
   });
</script>