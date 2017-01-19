<?php  
$cfg['blowfish_secret'] = 'DFn$risyMgAxC]2xrwYoy-5yIVODZU7JTh%Vbz81s';  // use here a value of your choice  
$i = 0;  
/* First server */  
$i++;  
/* Authentication type */  
$cfg['Servers'][$i]['auth_type'] = 'cookie';  
/* Server parameters */  
$cfg['Servers'][$i]['host'] = 'ustuscan.database.windows.net';  // Replace with value from connection string  
$cfg['Servers'][$i]['connect_type'] = 'tcp';  
$cfg['Servers'][$i]['compress'] = false;  
$cfg['Servers'][$i]['extension'] = 'mysqli';  
$cfg['Servers'][$i]['AllowNoPassword'] = true;  
?>  