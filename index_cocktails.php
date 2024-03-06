<?php

// to fetch the data
function fetchCocktails() {
    $api_url = 'https://www.thecocktaildb.com/api/json/v1/1/search.php?s=';
    $response = file_get_contents($api_url);
    return json_decode($response, true)['drinks'];
}

	// display/view list of cocktails
	function displayCocktails($cocktails) {
	echo '<html>';
		
	echo '<head>';
	echo '<title>Cocktails</title>';
	echo '<style>';
	echo 'body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f0f0; margin: 0; padding: 0; }';
	echo '.container { max-width: 800px; margin: 20px auto; background-color: #fff; padding: 20px; }'; 
	echo 'h2 { color: #333; text-align: center; }';
	echo 'ul { list-style-type: none; padding: 0; display: flex; flex-wrap: wrap; }'; 
	echo 'li { margin: 10px; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease; flex: 1 0 200px; text-align: center; }';
    echo 'li:hover { background-color: #f5f5f5; }';
    echo 'a { text-decoration: none; color: #007bff; }';
    echo 'a:hover { text-decoration: underline; }';
    echo 'img { max-width: 100%; max-height: 150px; border-radius: 5px; margin-bottom: 10px; }';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    
    echo '<div class="container">';
    echo '<h2>List of Cocktails</h2>';
    echo '<ul>';
    foreach ($cocktails as $cocktail) {
        echo '<li>';
        echo '<a href="?cocktail=' . $cocktail['idDrink'] . '">';
        echo '<img src="' . $cocktail['strDrinkThumb'] . '" alt="' . $cocktail['strDrink'] . '">';
        echo '<br>' . $cocktail['strDrink'] . '</a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '</body>';
	
    echo '</html>';
}

// display/view details of cocktails
function displayCocktailDetails($cocktailId) {
    $api_url = 'https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=' . $cocktailId;
    $response = file_get_contents($api_url);
    $cocktail = json_decode($response, true)['drinks'][0];

    echo '<html>';
	
    echo '<head>';
    echo '<title>' . $cocktail['strDrink'] . '</title>';
    echo '<style>';
    echo 'body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f0f0; margin: 0; padding: 0; }';
    echo '.container { max-width: 600px; margin: 20px auto; background-color: #fff; padding: 20px; }'; 
    echo 'h2 { color: #333; text-align: center; }';
    echo 'img { max-width: 100%; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-bottom: 20px; }';
    echo 'p { color: #555; }';
    echo '</style>';
    echo '</head>';
	
    echo '<body>';
    echo '<div class="container">';
    echo '<h2>' . $cocktail['strDrink'] . '</h2>';
    echo '<img src="' . $cocktail['strDrinkThumb'] . '" alt="' . $cocktail['strDrink'] . '">';
    echo '<p>' . $cocktail['strInstructions'] . '</p>';  
    echo '</div>';
    echo '</body>';
	
    echo '</html>';
}

// fetch logic
$cocktails = fetchCocktails();

if (isset($_GET['cocktail'])) {
    $selectedCocktailId = $_GET['cocktail'];
    displayCocktailDetails($selectedCocktailId);
} else {
    displayCocktails($cocktails);
}

?>
