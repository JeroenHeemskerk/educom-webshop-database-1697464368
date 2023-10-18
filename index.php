<?php
    include 'user_service.php';
    include 'file_repository.php';
    include 'validations.php';
    include 'session_manager.php';

    session_start();

    $page = getRequestedPage();
    $data = processRequest($page);
    showResponsePage($data);

    function getRequestedPage() {
    
        //Indien sprake is van een POST-request wordt onderzocht welk formulier is opgegeven
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            return getPostVar('page', 'home');
    
        //Indien sprake is van een GET-request wordt bepaald welke pagina weergegeven moet worden
        } else if ($_SERVER["REQUEST_METHOD"] == "GET"){        
            return getUrlVar('page', 'home');            
        }
    }
    
    function getPostVar($key, $default=''){
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
	
	function getUrlVar($key, $default='') { 
		return isset($_GET[$key]) ? $_GET[$key] : $default; 
	} 

    function processRequest($page) {
    
        switch ($page) {        
            case "login":            
                $data = validateLogin();
                if ($data['valid']) {                
                    loginUser($data['name']);
                    $page = "home";
                }
                break;        
            case "logout":        
                logoutUser();
                $page = "home";
                break;        
            case "contact":            
                $data = validateContact();
                if ($data['valid']) {                
                    $page = "thanks";
                }
                break;
            case "register":
                $data = validateRegister();
                if ($data['valid']) {
                    registerNewAccount($data);
                    $page = "login";
                }
        }
        
        //Aan $data wordt een array menu toegevoegd met de standaard weer te geven items
        //Naar aanleiding van of de user ingelogd is wordt register en login of logout toegevoegd
        $data['menu'] = array('home' => 'Home', 'about' => 'About', 'contact' => 'Contact');
        if (isUserLoggedIn()) {
            $data['menu']['logout'] = "Logout " . getLoggedInUserName();
        } else {
            $data['menu']['register'] = "Register";
            $data['menu']['login'] = "Login";
        }
    
        $data['page'] = $page;
    
        return $data;
    }

    function showResponsePage($data){
    
        showHTMLStart();
        showHeadSection($data);
        showBodySection($data);    
        showFooter();
        showHTMLEnd();
    }

    function showHeadSection ($data) {
    
        echo '<head>';
        echo '<title>';
		
		//getHeader haalt de header van de desbetreffende pagina en de header wordt vervolgens gebruikt om de title aan te maken
		$header = getHeader($data);
		if ($header == 'Home') {
			echo 'Nick zijn website';
		} else {
			echo $header;
		}		
        
        echo '</title>';
        echo '<link rel="stylesheet" href="./CSS/stylesheet.css">';
        echo '</head>';
    }

    function showBodySection($data) {
    
        echo '<body class="pagetext">';    
        showHeader($data);    
        showNavMenu($data);    
        showContent($data);    
        echo '</body>';
    }

    function showContent($data) {
    
        switch ($data['page']) {
            case "home":
                showHomeBody();
                break;
            case "about":
                showAboutBody();
                break;
            case "contact":
                showContactBody($data);
                break;
            case "register":
                showRegisterBody($data);
                break;
            case "login":
                showLoginBody($data);
                break;
            case "thanks":
                showThanksBody($data);
                break;
            default:
                showHomeBody();
                break;
        }
    }

    function showNavMenu($data) {
        
        //Het navigatiemenu wordt door middel van de eerder gedefinieerde items in processRequest opgemaakt
        echo '<ul class="nav">';        
        foreach($data['menu'] as $link => $label) {
            showMenuItem($link, $label);
        }
        echo '</ul><br>';                
    }

    function showMenuItem($page, $title) {
        echo '<li><a href="index.php?page=' . $page . '">' . $title . '</a></li>';
    }
	
	function showHeader($data) {
		echo '<h1>' . getHeader($data) . '</h1>';
	}

    function getHeader($data) {
        
        //Returnt de header vanuit de desbetreffende pagina en include daarmee ook de respectievelijke php file
        switch ($data['page']) {
            case "home":
                require_once 'home.php';
                return getHomeHeader();
            case "about":
                require_once 'about.php';
                return getAboutHeader();
            case "contact":
                require_once 'contact.php';
                return getContactHeader();
            case "register":
                require_once 'register.php';
                return getRegisterHeader();
            case "login":
                require_once 'login.php';
                return getLoginHeader();
            case "thanks":
                require_once 'thanks.php';
				return getThanksHeader();
            default:
                require_once 'home.php';
                return getHomeHeader();
        }
    }

    function showFooter() {
    
        echo '<footer><p>&copy 2023<br>Nick Koole</p></footer>';
    }

    function showHTMLStart() {
    
        echo "<html>";
    }

    function showHTMLEnd() {
    
        echo "</html>";
    }
?>



