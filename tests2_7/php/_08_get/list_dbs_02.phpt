--TEST--
cubrid_list_dbs for APIS-135 Issue
--SKIPIF--
<?php
require_once('skipif.inc');
require_once('skipifconnectfailure.inc')
?>
--FILE--
<?php
include_once("connect.inc");
$conn = cubrid_connect_with_url($connect_url, $user, $passwd);
if (!$conn) {
    printf("[001] [%d] %s\n", cubrid_errno($conn), cubrid_error($conn));
    exit(1);
}
printf("#####positive example#####\n");
$db_list = cubrid_list_dbs($conn);
var_dump($db_list);
//no parameter
$db_list2 = cubrid_list_dbs();
var_dump($db_list2);


printf("\n\n#####negative example#####\n");
cubrid_disconnect($conn);
$db_list2 = cubrid_list_dbs($conn);
if(FALSE ==$db_list2 ){
   printf("[002]Expect: return false. [%d] %s\n", cubrid_errno($conn), cubrid_error($conn));
}else{
   var_dump($db_list2);
}

print "Finished!\n";
?>
--CLEAN--
--EXPECTF--
#####positive example#####
array(3) {
  [0]=>
  string(5) "phpdb"
  [1]=>
  string(7) "largedb"
  [2]=>
  string(6) "demodb"
}
array(3) {
  [0]=>
  string(5) "phpdb"
  [1]=>
  string(7) "largedb"
  [2]=>
  string(6) "demodb"
}


#####negative example#####

Warning: cubrid_list_dbs(): supplied resource is not a valid CUBRID Connect resource in %s on line %d

Warning: cubrid_errno(): supplied resource is not a valid CUBRID Connect resource in %s on line %d

Warning: cubrid_error(): supplied resource is not a valid CUBRID Connect resource in %s on line %d
[002]Expect: return false. [0] 
Finished!
