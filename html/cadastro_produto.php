<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header ("Location: ../index.php");
	}
	
	// Adiciona a Função display_campo($nome_campo, $tipo_campo)
	require_once "personalizacao_display.php";
?>

<!doctype html>
<html class="fixed">
<?php
	include_once '../dao/Conexao.php';
	include_once '../dao/CategoriaDAO.php';
	include_once '../dao/UnidadeDAO.php';
	
	if (!isset($_SESSION['unidade'])) {
		header('Location: ../controle/control.php?metodo=listarTodos&nomeClasse=UnidadeControle&nextPage=../html/cadastro_produto.php');
	}
	if(!isset($_SESSION['categoria'])){
		header('Location: ../controle/control.php?metodo=listarTodos&nomeClasse=CategoriaControle&nextPage=../html/cadastro_produto.php');	
	}
	if(isset($_SESSION['categoria']) && isset($_SESSION['unidade'])){
		$unidade = $_SESSION['unidade'];
		$categoria = $_SESSION['categoria'];

		unset($_SESSION['unidade']);
		unset($_SESSION['categoria']);


	}
?>
<head>
	<!-- Basic -->
	<meta charset="UTF-8">

	<title>Cadastro de Produto</title>
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
	<link rel="icon" href="<?php display_campo("Logo",'file');?>" type="image/x-icon" id="logo-icon">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="../assets/vendor/modernizr/modernizr.js"></script>

	<!-- Vendor -->
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
	<!-- Specific Page Vendor -->
	<script src="../assets/vendor/jquery-autosize/jquery.autosize.js"></script>	
	<!-- Theme Base, Components and Settings -->
	<script src="../assets/javascripts/theme.js"></script>	
	<!-- Theme Custom -->
	<script src="../assets/javascripts/theme.custom.js"></script>
	
	<!-- Theme Initialization Files -->
	<script src="../assets/javascripts/theme.init.js"></script>

	<!-- javascript functions -->
	<script src="../Functions/onlyNumbers.js"></script> 
	<script	src="../Functions/onlyChars.js"></script>
	<script	src="../Functions/mascara.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>

	<!-- jquery functions -->
	<script>
		$(function(){
			var categoria = <?php 
				echo $categoria;
			?>;
			var unidade = <?php 
				echo $unidade; 
			?>;
			$.each(categoria,function(i,item){
				$('#id_categoria').append('<option value="' + item.id_categoria_produto + '">' + item.descricao_categoria + '</option>');
			})
			$.each(unidade,function(i,item){
				$('#id_unidade').append('<option value="' + item.id_unidade + '">' + item.descricao_unidade + '</option>');
			})
		});
	</script>
	<script type="text/javascript">
		function validar(){
			var id_categoria = document.getElementyById("id_categoria").value;
			var id_unidade = document.getElementyById("id_unidade").value;
			if(id_categoria == "blank"){
				alert("Selecione uma categoria");
				document.getElementyById("id_categoria").focus();
				return false;
			}
			else if(id_unidade == "blank"){
				alert("Selecione uma unidade");
				document.getElementyById("id_unidade").focus();
				return false;	
			}
		}
		$('.dinheiro').mask('#.##0,00', {reverse: true});

		$(function () {
	        $("#header").load("header.php");
	        $(".menuu").load("menu.html");
	      });
	</script>
</head>
<body>
	<section class="body">
		<!-- start: header -->
		<div id="header"></div>
      	<!-- end: header -->
      		<div class="inner-wrapper">
         	<!-- start: sidebar -->
         	<aside id="sidebar-left" class="sidebar-left menuu"></aside>
			<!-- end: sidebar -->

			<section role="main" class="content-body">
				<header class="page-header">
					<h2>Cadastro</h2>
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="home.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Páginas</span></li>
							<li><span>Perfil</span></li>
						</ol>
						<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>

				<!-- start: page -->
				<div class="row">
					<div class="col-md-4 col-lg-2" style="visibility: hidden;"></div>
					<div class="col-md-8 col-lg-8" >
						<div class="tabs">
							<ul class="nav nav-tabs tabs-primary">
								<li class="active">
									<a href="#overview" data-toggle="tab">Cadastro de Produto</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="overview" class="tab-pane active">
									<form id="formulario" action="../controle/control.php" onsubmit="return validar()" autocomplete="off">
										<fieldset>
											<div class="form-group"><br>
												<label class="col-md-3 control-label">Nome do produto</label>
												<div class="col-md-8">
													<input type="text" class="form-control" name="descricao" id="produto" required>
												</div>
											</div>
										
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Categoria</label>
												<a href="adicionar_categoria.php">
													<i class="fas fa-plus w3-xlarge" style="margin-top: 0.75vw"></i>
												</a>
												<div class="col-md-6">
													<select name="id_categoria" id="id_categoria" class="form-control input-lg mb-md">
														<option selected disabled value="blank">Selecionar</option>
													</select>
												</div>	
											</div>
												
											<div class="form-group">
												<label class="col-md-3 control-label" >Unidade</label>
												<a href="adicionar_unidade.php"><i class="fas fa-plus w3-xlarge" style="margin-top: 0.75vw"></i></a>
												<div class="col-md-6">
													<select name="id_unidade" id="id_unidade" class="form-control input-lg mb-md">
														<option selected disabled value="blank">Selecionar</option>

														
													</select>
												</div>	
											</div>
												
											<div class="form-group">
												<label class="col-md-3 control-label" for="profileCompany">Código</label>
												<div class="col-md-8">
													<input type="number" name="codigo" class="form-control" id="profileCompany" id="codigo" required>

													<input type="hidden" name="nomeClasse" value="ProdutoControle">
														
													<input type="hidden" name="metodo" value="incluir">
												</div>
											</div>
												
											<div class="form-group">
												<label class="col-md-3 control-label" for="profileCompany">Valor</label>
												<div class="col-md-8">
													<input type="number" name="preco" class="form-control" step="any" placeholder="Ex: 22.00" required>

													<input type="hidden" name="nomeClasse" value="ProdutoControle">
														
													<input type="hidden" name="metodo" value="incluir">

												</div>
											</div>
											
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary" >Enviar</button>
														<input type="reset" class="btn btn-default">  
														<a href="cadastro_entrada.php" style="color: white; text-decoration: none;">
															<button class="btn btn-info" type="button">Voltar</button>
														</a>
														<a href="listar_produto.php" style="color: white; text-decoration:none;">				<button class="btn btn-success" type="button">Listar Produto</button></a>
													</div>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end: page -->
			</section>
		</div>
			
		<aside id="sidebar-right" class="sidebar-right">
			<div class="nano">
				<div class="nano-content">
					<a href="#" class="mobile-close visible-xs">
						Collapse <i class="fa fa-chevron-right"></i>
					</a>
				</div>
			</div>
		</aside>
	</section>

	<script src="../assets/vendor/jquery/jquery.js"></script>
	<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
	<!-- Specific Page Vendor -->
	<script src="../assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		
	<!-- Theme Base, Components and Settings -->
	<script src="../assets/javascripts/theme.js"></script>
		
	<!-- Theme Custom -->
	<script src="../assets/javascripts/theme.custom.js"></script>
	
	<!-- Theme Initialization Files -->
	<script src="../assets/javascripts/theme.init.js"></script>


</body>
</html>