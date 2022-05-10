<h1>Welcome to <?= $data['title'] ?></h1>
<h3>Here is list of all our users</h3>
<?php foreach ($data['users'] as $user) {
    echo "Information: " . $user->username . '  ' . $user->email;
    echo "<br/>";
} ?>