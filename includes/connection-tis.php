<?php
$db='mysql:host=127.0.0.1;dbname=ident';
$username='sa';
$password='sa';
$options=array(
	PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES TIS620',
		);

	try {
	$conn=new PDO($db,$username,$password,$options);
	
	} 
	catch(PDOException $e){
		echo '�������ö�Դ��Ͱҹ��������' .$e->getMessage();
	}
	

//$ipserver="www.phukieo.net/pk-mav";
$hos="�ç��Һ������������������õ�";
$title="pk-mav";
$boss="������Ҿ  ���ҭǧ��";
$today=date('Y-m-d');
$t=date('H:i:s');
$y2=date('Y');
$y3=$y2-1;
$y1=$y2+543;

//limit query
$limit=10;

