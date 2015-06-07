<?php
//for debugging the debugger
//phpinfo();
//exit();

/* keep these files separate--this isn't ideal for 
  security (but does make this file more readable) */
require_once 'utils.php';
require_once 'connect.php';

if (isset($_POST['joketext'])) {
    logstr('adding a joke');
}

if (isset($_GET['addjoke'])) {
    include 'addjoke.html.php';
    exit();
}

if (isset($_GET['deletejoke'])) {
    $id = mysqli_real_escape_string($link, $_POST['id']);
    logstr('id = ' . $id);
    $sql = 'DELETE FROM joke WHERE ID = ' . $id;
    logStr('sql = ' . $sql);
    /* header('Location: .');  
      exit(); */
    if (!\mysqli_query($link, $sql)) {
        showError('Error deleting submitted joke: ' . mysqli_error($link));
    }
    header('Location: .');
    exit();
}

echo 'Captain, database is connected; selecting jokes <br>';
$sql = 'SELECT joke.id, 
        joketext, 
        jokedate, 
        name, 
        email
    FROM 
        joke INNER JOIN author 
        ON authorid = author.id';
/* logStr($sql); */
$result = mysqli_query($link, $sql);
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $jokes[] = array(
            'id' => $row['id'],
            'text' => $row['joketext'],
            'authorname' => $row['name'],
            'authoremail' => $row['email']);
    }

    foreach ($jokes as $joke):
        echo $joke['id'] . ', is '; //where did joke.id go?
        echo $joke['text'] . '<br>';
    endforeach;

    include 'jokes.html.php';
} else {
    showError('Error fetching jokes: ' . mysqli_error($link));
}
?>
</body>
</html>
