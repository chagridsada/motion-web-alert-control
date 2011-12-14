<?php
include('config.php');
  /*Check login!*/
  session_start();
  if ( $_SESSION['session_mwap_id'] <> session_id() ){
    echo 'logout';
    exit();
  }

  function rep_spc($str){
    $tmp = '';
    for ($i=0;$i<strlen($str);$i++){
      switch ($str[$i]){
        case '/' : $tmp .= '\/'; break;
        case '&' : $tmp .= '\&'; break;
        case '!' : $tmp .= '\!'; break;
        case '@' : $tmp .= '\@'; break;
        case '#' : $tmp .= '\#'; break;
        case '$' : $tmp .= '\$'; break;
        case '%' : $tmp .= '\%'; break;
        case '^' : $tmp .= '\^'; break;
        case '*' : $tmp .= '\*'; break;
        case '=' : $tmp .= '\='; break;
        case '[' : $tmp .= '\['; break;
        case '`' : $tmp .= '\`'; break;
        default  : $tmp .= $str[$i];
      }
    }
    return $tmp;
  }

  function number_video(){
    global $FILE_GROUP_THREAD;
    $read = `cat $FILE_GROUP_THREAD | awk -F'=' '{print $1}' | sort | tail -1`;
    $num = intval($read) + 1;
    $num = ($num < 10 ? "0$num" : "$num");
    echo trim($num);
  }

  function set_config($id,$old,$new){
    global $FILE_GROUP_THREAD;
    $new = trim($new);
    $old = trim($old);
    if( $new <> $old ) {
      $msg_o = "$id=$old"; 
      $msg = "$id=$new"; 
      $old = rep_spc($old);
      $new = rep_spc($new);
      `sed -i "s/^$msg_o$/$msg/g" $FILE_GROUP_THREAD`;
    }
  }

  function gen_video($id,$group,$type,$dt,$on){
   $gen_val =
     '<div id="dv_'.$id.'">
      <hr class="no_show">
      <input id="tv_'.$id.'" type="text" size="10" value="CAMERA '.$id.'" readonly="readonly" 
        title="'.$dt.' , Port:100'.$id.'">
      <input id="tg_'.$id.'" type="text" size="20" value="'.$group.'" readonly="readonly"
        title="'.$dt.' , Port:100'.$id.'">
      <input id="cv_'.$id.'" type="checkbox" '.$on.' disabled>
      <input id="be_'.$id.'" type="button" value="Edit" class="button blue small"
        onclick="cf_edit_video(\''.$id.'\',\''.$type.'\')">
      <input id="bd_'.$id.'" type="button" value="Delete" class="button red small"
        onclick="cf_del_video(\''.$id.'\')">
      <div id="de_'.$id.'"></div></div>';
    return $gen_val;
  }

  function sg($name,$select){
    global $FILE_GROUP;
    $sg_val = "<select name=\"$name\">";
    $sg_val .= "\n<option value='Undefined Group'>Undefined Group</option>";
    $file =  `cat $FILE_GROUP`;
    foreach (split("\n",$file) as $val){
      $val = trim($val);
      if ($val != ""){
          if($val == $select){
            $sg_val .= "\n<option value='$val' SELECTED>$val</option>";
          }else{
            $sg_val .= "\n<option value='$val'>$val</option>";
          }
      }
    }
    $sg_val .= "\n</select>";
    return $sg_val;
  }

  function cf_edit_video(){
    global $PATH_THREAD;
    $id  = $_POST['id'];
    $type  = $_POST['t'];
    $group  = $_POST['g'];

    $user_pass = `cat $PATH_THREAD/thread$id.conf | grep netcam_userpass | awk -F' ' '{print $2}'`;
    $u_p = split(':',$user_pass);
    $u  = $u_p[0];
    $p  = $u_p[1];

    $read_dt = `cat $PATH_THREAD/thread$id.conf | head -1`;
    $dt_val = split(' ',$read_dt);
    $dt = $dt_val[1];

    $on = `cat $PATH_THREAD/thread$id.conf | grep "#on_movie_start"`;
    $on = ($on == '' ? 'checked' : '');

    if($type == "dev"){
      $html = 
	'<form id="f_dev_'.$id.'">
          <input type="hidden" name="id" value="'.$id.'">
          <input type="hidden" name="type" value="dev">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="g_old" value="'.$group.'">
          <table class="table_0">
            <tr>
              <td class="td_right"><label>device</label></td>
              <td height="20">:</td>
              <td>
                <input id="name_dev_'.$id.'" name="dev_ip" type="text" value="'.$dt.'">
                <b>  ex. </b>
                <font color="red"> /dev/video0</font>
              </td>
            </tr>
            <tr>
              <td class="td_right"><label>group</label></td>
              <td height="25">:</td>
              <td>'.sg("group",$group).'</td>
            </tr>
            <tr>
              <td class="td_right"><label>alert</label></td>
              <td height="20">:</td>
              <td><input name="alert" type="checkbox" '.$on.'></td>
            </tr>
            <tr>
              <td class="td_right"><label>name</label></td>
              <td height="20">:</td>
              <td><input  name="name" type="text" value="CAMERA '.$id.'" size="15" readonly></td>
            </tr>
            <tr>
              <td class="td_right"><label>port</label></td>
              <td height="20">:</td>
              <td><input  name="port" type="text" value="100'.$id.'" size="7" readonly></td>
            </tr>
            <tr>
              <td height="20" colspan="2"></td>
              <td>
                <input type="button" class="button green small" value="Save" onclick="edit_video(\'f_dev_'.$id.'\',\''.$id.'\')">
                <input type="button" class="button red small" value="Cancel" onclick="$(\'#f_dev_'.$id.'\').remove()">
              </td>
            </tr>
          </table> 
        </form>';
    }else if($type == "ip"){
       $html = 
	 '<form id="f_ip_'.$id.'">
          <input type="hidden" name="id" value="'.$id.'">
          <input type="hidden" name="type" value="ip">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="g_old" value="'.$group.'">
          <table class="table_0">
            <tr>
              <td class="td_right_top"><label>url</label></td>
              <td height="20" class="td_top">:</td>
              <td>
                <textarea id="name_ip_'.$id.'" name="dev_ip"rows="2" cols="50">'.$dt.'</textarea>
              </td>
            </tr>
            <tr>
              <td class="td_right"><label>user</label></td>
              <td height="20">:</td>
              <td><input name="user" type="text" value="'.$u.'" size="15"></td>
            </tr>
            <tr>
            <tr>
              <td class="td_right"><label>password</label></td>
              <td height="20">:</td>
              <td><input name="password" type="password" value="'.$p.'" size="15"></td>
            </tr>
            <tr>
            <tr>
              <td class="td_right"><label>group</label></td>
              <td height="25">:</td>
              <td>'.sg("group",$group).'</td>
            </tr>
            <tr>
              <td class="td_right"><label>alert</label></td>
              <td height="20">:</td>
              <td><input name="alert" type="checkbox" '.$on.'></td>
            </tr>
            <tr>
              <td class="td_right"><label>name</label></td>
              <td height="20">:</td>
              <td><input  name="name" type="text" value="CAMERA '.$id.'" size="15"  readonly></td>
            </tr>
            <tr>
              <td class="td_right"><label>port</label></td>
              <td height="20">:</td>
              <td><input  name="port" type="text" value="100'.$id.'" size="7"  readonly></td>
            </tr>
            <tr>
              <td height="20" colspan="2"></td>
              <td>
                <input type="button" class="button green small" value="Save" onclick="edit_video(\'f_ip_'.$id.'\',\''.$id.'\')">
                <input type="button" class="button red small" value="Cancel" onclick="$(\'#f_ip_'.$id.'\').remove()">
              </td>
            </tr>
          </table> 
        </form>';
    }else{ exit();}
  echo $html;
  }

  function add_video(){
    global $FILE_GROUP_THREAD;
    global $PATH_THREAD;
    $type  = trim($_POST['type']);
    $d_ip  = trim($_POST['dev_ip']);
    $name  = trim($_POST['name']);
    $port  = trim($_POST['port']);
    $user  = trim($_POST['user']);
    $pass  = trim($_POST['password']);
    $group = trim($_POST['group']); 

    $user_pass = ($user == '' && $pass == '' ? "#netcam_userpass :" : "netcam_userpass $user:$pass");
    $text  = ($type == "dev" ? 'videodevice '.$d_ip."\n" : 'netcam_url '.$d_ip."\n".$user_pass."\n");
    $text .= 'text_left '.$name."\n";
    $text .= 'webcam_port '.$port."\n";
    $text .= (isset($_POST['alert']) ? 'on_movie_start /usr/local/bin/motion-web-alert-plugin/alert.sh %f'
           : '#on_movie_start /usr/local/bin/motion-web-alert-plugin/alert.sh %f');

    $num = split(' ',$name);
    $num = $num[1];
    if (`cat $FILE_GROUP_THREAD | cut -b1-2 | grep "^$num$"` != ''){
      exit();
    }
    $msg = "$num=$group"; 
    `echo "$msg" >> $FILE_GROUP_THREAD`;
    `echo "$text" > $PATH_THREAD/thread$num.conf`;
    /*add /etc/motion/motion.conf*/
    `echo "thread $PATH_THREAD/thread$num.conf" >> /etc/motion/motion.conf`;
    `/usr/local/bin/motion-web-alert-plugin/motion-restart.sh`;
    echo gen_video($num,$group,$type,$d_ip,(isset($_POST['alert'])? 'checked' : ''));
  }

  function del_video(){
    global $FILE_GROUP_THREAD;
    global $PATH_THREAD; 
    $id = $_POST['video_id'];
    $time = time(); 
    `cat $FILE_GROUP_THREAD | grep -v "^$id=" > /tmp/$time`;
    `cat /tmp/$time > $FILE_GROUP_THREAD`;
    `rm /tmp/$time`;
    `rm $PATH_THREAD/thread$id.conf`; 
    /*remove thread in /etc/motion/motion.conf*/ 
    `sed -i "s/^thread \/etc\/motion-web-alert-plugin\/thread\/thread$id.conf$/\#/g" /etc/motion/motion.conf`;
    `/usr/local/bin/motion-web-alert-plugin/motion-restart.sh`;

     if (`cat $FILE_GROUP_THREAD | grep "^$id="` == ''){
       echo 'deleted';
     }
  }

  function edit_video(){
    global $FILE_GROUP_THREAD;
    global $PATH_THREAD;
    $id    = trim($_POST['id']);
    $type  = trim($_POST['type']);
    $d_ip  = trim($_POST['dev_ip']);
    $name  = trim($_POST['name']);
    $alert = trim($_POST['alert']);
    $port  = trim($_POST['port']);
    $user  = trim($_POST['user']);
    $pass  = trim($_POST['password']);
    $group = trim($_POST['group']); 
    $g_old = trim($_POST['g_old']); 

    $user_pass = ($user == '' && $pass == '' ? "#netcam_userpass :" : "netcam_userpass $user:$pass");
    $text  = ($type == "dev" ? 'videodevice '.$d_ip."\n" : 'netcam_url '.$d_ip."\n".$user_pass."\n");
    $text .= 'text_left '.$name."\n";
    $text .= 'webcam_port '.$port."\n";
    $text .= ($alert <> '' ? 'on_movie_start /usr/local/bin/motion-web-alert-plugin/alert.sh %f'
           : '#on_movie_start /usr/local/bin/motion-web-alert-plugin/alert.sh %f');

    `echo "$text" > $PATH_THREAD/thread$id.conf`;
    set_config($id,$g_old,$group);
    $msg = "$id=$group";
    if (`cat $FILE_GROUP_THREAD | grep "^$msg$"` != ''){
      echo 'edited';
      `/usr/local/bin/motion-web-alert-plugin/motion-restart.sh`;
    }
  } 

  switch ($_POST['action'])
  {
    case 'get_num'  : number_video();  break;
    case 'add'  : add_video();  break;
    case 'cf_edit'  : cf_edit_video();  break;
    case 'edit'  : edit_video();  break;
    case 'del'  : del_video();  break;
  }
?>
