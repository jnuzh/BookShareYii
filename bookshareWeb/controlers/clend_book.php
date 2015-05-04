<?php
	require '../models/BooksModel.php';
	$own_books = new Books();
	$own_books->selectBooksByOwnerIsLent($_COOKIE['username']);
	$own_books = $own_books->getBooks();

	
	
	$bookslength = count($own_books);
	for($i = 0; $i < $bookslength; $i = $i + 1){
		$own_books[$i]['owner'] = base64_encode($own_books[$i]['owner']);
		$own_books[$i]['id'] = base64_encode($own_books[$i]['id']);
		$own_books[$i]['name'] = base64_encode($own_books[$i]['name']);
		$own_books[$i]['isbn'] = base64_encode($own_books[$i]['isbn']);
		$own_books[$i]['author'] = base64_encode($own_books[$i]['author']);
		$own_books[$i]['description'] = base64_encode($own_books[$i]['description']);
		$own_books[$i]['publisher'] = base64_encode($own_books[$i]['publisher']);
		$own_books[$i]['holder'] = base64_encode($own_books[$i]['holder']);
		$own_books[$i]['visibility'] = base64_encode($own_books[$i]['visibility']);
		$own_books[$i]['large_img'] = base64_encode($own_books[$i]['large_img']);
		$own_books[$i]['medium_img'] = base64_encode($own_books[$i]['medium_img']);
		$own_books[$i]['small_img'] = base64_encode($own_books[$i]['small_img']);
		$own_books[$i]['tags'] = base64_encode($own_books[$i]['tags']);
	}
	
	echo "<form style='display:none;' id='form1' name='form1' method='post' action='../views/vlend_book.php'>
              <input name='own_books' type='text' value='".serialize($own_books)."' />
            </form>
            <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
