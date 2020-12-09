<!-- Disconnecting user from system -->

<?php

	session_start();
	session_unset();
	session_destroy();
	echo '<html><meta charset="UTF-8"><script language="javascript">alert("User was succesfully disconnected!"); document.location="../Index.php";</script></html>';


?>