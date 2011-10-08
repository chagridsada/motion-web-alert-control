/*Add-Edit-Group*/
function add_group(){
  var g = jQuery.trim($('#group_name').val());
  if(g.length < 1 || g =='Undefined Group')return false;
  $.post('control/group.php',{action:'add',group_name: g},function(result){
    if(result != ''){
      $('#group_name').val('');
      $('#group').prepend(result);
    }else if(result == 'logout'){ window.location = 'index.php';
    }else { apprise('Add failed!') ; return false; }
  $('#group_name').select();
  });
}

function cf_edit_group(id){
  $('#tg_'+id).prop('readonly', false);
  $('#be_'+id).val('Save');
  $('#bd_'+id).val('Cancel');
  $('#tg_'+id).select();
return false;  
}

function cf_del_group(id){
  $('#tg_'+id).prop('disabled', true);
  $('#be_'+id).val('Delete?');
  $('#bd_'+id).val('Cancel');
return false;
}

function cancel_group(id){
  $('#tg_'+id).val($('#gn_'+id).val());
  $('#tg_'+id).prop('readonly', true);
  $('#tg_'+id).prop('disabled', false);
  $('#be_'+id).val('Edit');
  $('#bd_'+id).val('Delete');
return false;
}

function del_group(id){
  $.post('control/group.php',{action:'del',group_name: $('#gn_'+id).val()},function(result){
    if(result == 'deleted'){
      $('#dg_'+id).remove();
      return false;
    }else if(result == 'logout'){ window.location = 'index.php';
    }else { apprise('Delete failed!') ; return false; }
  });
}

function edit_group(id){
  $.post('control/group.php',{action:'edit',group_name: $('#tg_'+id).val()
  ,group_name_old: $('#gn_'+id).val()},function(result){
    if(result == 'edited'){
      $('#gn_'+id).val($('#tg_'+id).val());
      $('#tg_'+id).prop('readonly', true);
      $('#be_'+id).val('Edit');
      $('#bd_'+id).val('Delete');
      return false;
    }else if(result == 'logout'){ window.location = 'index.php';
    }else { $('#tg_'+id).select(); return false; }
  });
}

/*Add-Edit-Video*/
function cf_add_video(){
  var id = $('input:radio[name=mode]:checked').val();
  $.post('control/video.php',{action:'get_num'},function(result){
    if(result.length == 2){
      $('#tc_'+id).val('CAMERA '+result);
      $('#tp_'+id).val('100'+result);
    }else if(result == 'logout'){ window.location = 'index.php';
    }else { apprise('Load failed!'); }
  });
  $('#dev_id').prop('disabled', true);
  $('#ip_id').prop('disabled', true);
  $('#b_av').hide();
  $('#dt_'+id).show();
}

function cancel_add_video(id){
  $('#dev_id').prop('disabled', false);
  $('#ip_id').prop('disabled', false);
  $('#b_av').show();
  $('#f_'+id)[0].reset();
  $('#dt_'+id).hide();
}

function add_video(id){
  if(jQuery.trim($('#name_'+id).val())==""){
    $('#name_'+id).select();
    return false;
  }
  var data = $('#f_'+id).serialize();
  $.post('control/video.php',data,function(result){
    if(result != ''){
      $('#video').prepend(result);
      $('#dev_id').prop('disabled', false);
      $('#ip_id').prop('disabled', false);
      $('#b_av').show();
      $('#dt_'+id).hide();
      $('#f_'+id)[0].reset();
      checkbox_on();
    }else if(result == 'logout'){ window.location = 'index.php';
    }else { apprise('Add failed!') ; }
  });
}

function cf_edit_video(id,t,g,n,on,u,p) {
  $.post('control/video.php',{action: 'cf_edit',id: id,t: t,g:g,n:n,on:on,u:u,p:p},function(result){
    if(result != ''){
      $('#de_'+id).html(result);
      checkbox_on();
    }else if(result == 'logout'){ window.location = 'index.php';
    }else { apprise('Load failed!') ;}
  });
}

function cf_del_video(id) {
  apprise('<b>Delete Video ?</b><br />Name : CAMERA '+ id ,
  {'verify':true, 'textYes':'Delete!', 'textNo':'Cancel'},
   function(r) {
     if(r) { 
       $.post('control/video.php',{action: 'del',video_id: id},function(result){
         if(result == 'deleted'){
           $('#dv_'+id).remove();
         }else if(result == 'logout'){ window.location = 'index.php';
         }else { apprise('Delete failed!') ;}
       });
     }
   });
}

function edit_video (id) {
  apprise(id);
}

