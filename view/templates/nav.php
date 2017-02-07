<?php 
    if (!defined('INCLUDE_CHECK')) {
        http_response_code(404); die;
    }

    $nav_params = array('loginbtn'=>'Connexion','loginlink'=>'login');
    $conn_confirmation = '';
    if(isset($_SESSION['id']) && $_SESSION['id'] != null){
        $nav_params['loginbtn'] = 'Déconnexion';
        $nav_params['loginlink'] = 'logout';
        $conn_confirmation = 'Bonjour, '.$_SESSION['name'];
    }
?>
<!-- Fixed navbar -->
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="./books.php" class="navbar-brand">Projet 151</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a><span class="welcome-message"><?php echo htmlentities($conn_confirmation); ?></span></a></li>
				<li><a href="books.php">Magasin</a></li>
				<?php 
					//Nav bar for logged in user
					if (isset($_SESSION['id'])){
						echo '<li><a href="my_comments.php">Mes commentaires</a></li>';
                                                echo '<li><a href="order.php">Mes commandes</a></li>';
                                                echo '<li><a href="my_account.php">Mes informations</a></li>';
					}

					//Nav bar for admin
					if (isset($_SESSION['right']) && $_SESSION['right'] == 1){
						echo '<li class="dropdown">';
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="admin-menu">Administration</span> <span class="caret"></span></a>';
						echo '<ul class="dropdown-menu">';
						echo '<li><a href="new_book.php"><span class="admin-menu">Ajouter un livre</span></a></li>';
						echo '<li><a href="comments_mgmt.php"><span class="admin-menu">Commentaires</span></a></li>';
                                                echo '<li><a href="order.php?by=status&value=0"><span class="admin-menu">Commandes</span></a></li>';
                                                echo '<li><a href="user_list.php"><span class="admin-menu">Utilisateurs</span></a></li>';
						echo '</ul>';
						echo '</li>';
					}
				?>
				<li><a href="<?php echo './'.$nav_params['loginlink'].'.php'; ?>"><?php echo $nav_params['loginbtn']; ?></a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>