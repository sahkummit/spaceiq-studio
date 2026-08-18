<?php
echo "<h3>Server PDF Tools Check</h3>";
echo "pdftoppm: " . shell_exec('which pdftoppm 2>&1') . "<br>";
echo "gs: " . shell_exec('which gs 2>&1') . "<br>";
echo "convert: " . shell_exec('which convert 2>&1') . "<br>";
echo "pdftocairo: " . shell_exec('which pdftocairo 2>&1') . "<br>";
echo "whoami: " . shell_exec('whoami 2>&1') . "<br>";
echo "safe_mode: " . (ini_get('safe_mode') ? 'ON' : 'OFF') . "<br>";
echo "disable_functions: " . ini_get('disable_functions') . "<br>";
