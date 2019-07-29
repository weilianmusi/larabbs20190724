<?php

$str = "Bill & 'Steve'";  //Bill &amp; 'Steve'
echo htmlspecialchars($str, ENT_NOQUOTES); // 不转换任何引号