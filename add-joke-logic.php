logstr('adding joke logic');
    /* to add a joke, first we need to look up the author (flexibly) */
    $author = mysqli_real_escape_string($link, $_POST['author']);
    $author = trim($author);
    /* we're still not considering upper/lower case correctly;
      this would suppedly work COLLATE utf8_general_ci */
    $sql = 'SELECT id, name FROM author WHERE name LIKE "' . $author . '"';
    $result = (mysqli_query($link, $sql));
    if ($result) {
        /* it seems we get *something* back 
          regardless of a match with LIKE */
        $row = mysqli_fetch_array($result);
        $id = $row['id'];
        if ($id == 0) {
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $sql = 'INSERT INTO author SET ' .
                    'name = "' . $author . '"' .
                    ', email = "' . $email . '"';
            /* printf($sql); */
            if (mysqli_query($link, $sql)) {
                $sql = 'SELECT LAST_INSERT_ID()';
                $result = (mysqli_query($link, $sql));
                $row = mysqli_fetch_array($result);
                $id = $row[0];
            } else {
                showError('Error adding author: ' . mysqli_error($link));
            }
        }
    }