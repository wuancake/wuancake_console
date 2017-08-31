<?php

if (isset($_GET['param'])) {
	if ($_GET['param']<1) {
		echo json_encode(['error'=>'param must be greater than 0']);
	}
	else
		echo json_encode(['info'=>$_GET['param']]);
}
else
	echo json_encode(['error'=>'must have param']);