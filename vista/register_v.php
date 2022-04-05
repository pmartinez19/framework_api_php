<?php
    #formulari de registre
    echo '<form action="/framework_api_php/user/register" method="post">';
    echo '<h3>Registre</h3>';
    echo '<label for="username">Username:</label>';
    echo '<input type="text" name="username" id="username" required>';
    echo '<label for="name">Name:</label>';
    echo '<input type="text" name="name" id="name" required>';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" name="email" id="email" required>';
    echo '<label for="pass">Password:</label>';
    echo '<input type="password" name="pass" id="pass" required>';
    echo '<input type="submit" value="Registrar">';
    echo '</form>';

?>
</body>
</html>