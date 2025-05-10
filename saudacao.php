<?php
if ($_POST['nome']) {
    echo "Bem-vindo, " .$_POST['nome'];
} else {
    echo "<form method='post'>Nome:    
       <input name='nome'></form>";
}
?>