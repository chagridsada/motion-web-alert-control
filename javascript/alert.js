function load_alert(){
var js = 
'?alert_on=' + encodeURIComponent(document.getElementById('alert_on').checked) +
'&intrude_on=' + encodeURIComponent(document.getElementById('intrude_on').checked) +
'&powerdown_on=' + encodeURIComponent(document.getElementById('powerdown_on').checked) +
'&sms_on=' + encodeURIComponent(document.getElementById('sms_on').checked) +
'&twitter_on=' + encodeURIComponent(document.getElementById('twitter_on').checked) +
'&alert_on_old=' + encodeURIComponent(document.getElementById('alert_on_old').value) +
'&intrude_on_old=' + encodeURIComponent(document.getElementById('intrude_on_old').value) +
'&powerdown_on_old=' + encodeURIComponent(document.getElementById('powerdown_on_old').value) +
'&sms_on_old=' + encodeURIComponent(document.getElementById('sms_on_old').value) +
'&twitter_on_old=' + encodeURIComponent(document.getElementById('twitter_on_old').value);
return js;
}

function load_alert1(){
var js = 
'?mo=' + encodeURIComponent(document.getElementById('mo').checked) +
'&tu=' + encodeURIComponent(document.getElementById('tu').checked) +
'&we=' + encodeURIComponent(document.getElementById('we').checked) +
'&th=' + encodeURIComponent(document.getElementById('th').checked) +
'&fr=' + encodeURIComponent(document.getElementById('fr').checked) +
'&sa=' + encodeURIComponent(document.getElementById('sa').checked) +
'&su=' + encodeURIComponent(document.getElementById('su').checked) +
'&mo_time_all_old=' + encodeURIComponent(document.getElementById('mo_time_all_old').value) +
'&tu_time_all_old=' + encodeURIComponent(document.getElementById('tu_time_all_old').value) +
'&we_time_all_old=' + encodeURIComponent(document.getElementById('we_time_all_old').value) +
'&th_time_all_old=' + encodeURIComponent(document.getElementById('th_time_all_old').value) +
'&fr_time_all_old=' + encodeURIComponent(document.getElementById('fr_time_all_old').value) +
'&sa_time_all_old=' + encodeURIComponent(document.getElementById('sa_time_all_old').value) +
'&su_time_all_old=' + encodeURIComponent(document.getElementById('su_time_all_old').value) +
'&mo_time=' + encodeURIComponent(document.getElementsByName('mo_time')[0].checked) +
'&tu_time=' + encodeURIComponent(document.getElementsByName('tu_time')[0].checked) +
'&we_time=' + encodeURIComponent(document.getElementsByName('we_time')[0].checked) +
'&th_time=' + encodeURIComponent(document.getElementsByName('th_time')[0].checked) +
'&fr_time=' + encodeURIComponent(document.getElementsByName('fr_time')[0].checked) +
'&sa_time=' + encodeURIComponent(document.getElementsByName('sa_time')[0].checked) +
'&su_time=' + encodeURIComponent(document.getElementsByName('su_time')[0].checked) +
'&mo_time_old=' + encodeURIComponent(document.getElementById('mo_time_old').value) +
'&tu_time_old=' + encodeURIComponent(document.getElementById('tu_time_old').value) +
'&we_time_old=' + encodeURIComponent(document.getElementById('we_time_old').value) +
'&th_time_old=' + encodeURIComponent(document.getElementById('th_time_old').value) +
'&fr_time_old=' + encodeURIComponent(document.getElementById('fr_time_old').value) +
'&sa_time_old=' + encodeURIComponent(document.getElementById('sa_time_old').value) +
'&su_time_old=' + encodeURIComponent(document.getElementById('su_time_old').value) +
'&hr_mo_start=' + encodeURIComponent(document.getElementById('hr_mo_start').value) + 
'&hr_tu_start=' + encodeURIComponent(document.getElementById('hr_tu_start').value) + 
'&hr_we_start=' + encodeURIComponent(document.getElementById('hr_we_start').value) + 
'&hr_th_start=' + encodeURIComponent(document.getElementById('hr_th_start').value) + 
'&hr_fr_start=' + encodeURIComponent(document.getElementById('hr_fr_start').value) + 
'&hr_sa_start=' + encodeURIComponent(document.getElementById('hr_sa_start').value) + 
'&hr_su_start=' + encodeURIComponent(document.getElementById('hr_su_start').value) + 
'&hr_mo_end=' + encodeURIComponent(document.getElementById('hr_mo_end').value) + 
'&hr_tu_end=' + encodeURIComponent(document.getElementById('hr_tu_end').value) + 
'&hr_we_end=' + encodeURIComponent(document.getElementById('hr_we_end').value) + 
'&hr_th_end=' + encodeURIComponent(document.getElementById('hr_th_end').value) + 
'&hr_fr_end=' + encodeURIComponent(document.getElementById('hr_fr_end').value) + 
'&hr_sa_end=' + encodeURIComponent(document.getElementById('hr_sa_end').value) + 
'&hr_su_end=' + encodeURIComponent(document.getElementById('hr_su_end').value) + 
'&min_mo_start=' + encodeURIComponent(document.getElementById('min_mo_start').value) + 
'&min_tu_start=' + encodeURIComponent(document.getElementById('min_tu_start').value) + 
'&min_we_start=' + encodeURIComponent(document.getElementById('min_we_start').value) + 
'&min_th_start=' + encodeURIComponent(document.getElementById('min_th_start').value) + 
'&min_fr_start=' + encodeURIComponent(document.getElementById('min_fr_start').value) + 
'&min_sa_start=' + encodeURIComponent(document.getElementById('min_sa_start').value) + 
'&min_su_start=' + encodeURIComponent(document.getElementById('min_su_start').value) + 
'&min_mo_end=' + encodeURIComponent(document.getElementById('min_mo_end').value) + 
'&min_tu_end=' + encodeURIComponent(document.getElementById('min_tu_end').value) + 
'&min_we_end=' + encodeURIComponent(document.getElementById('min_we_end').value) + 
'&min_th_end=' + encodeURIComponent(document.getElementById('min_th_end').value) + 
'&min_fr_end=' + encodeURIComponent(document.getElementById('min_fr_end').value) + 
'&min_sa_end=' + encodeURIComponent(document.getElementById('min_sa_end').value) + 
'&min_su_end=' + encodeURIComponent(document.getElementById('min_su_end').value) +
'&alert_day=' + encodeURIComponent(document.getElementById('alert_day').value) ;
return js;
}
