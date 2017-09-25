<?php $cakeDescription = 'Projects management'; ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <?= $this->Html->charset('UTF-8') ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1.0'); ?>
    <?= $this->Html->meta('description', 'Projects management application'); ?>
    <?= $this->Html->meta('author', 'Khidma company'); ?>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('consult/normalize.css') ?>
    <?= $this->Html->css('consult/flickity.css') ?>
    <?= $this->Html->css('consult/main.css') ?>
    <?= $this->Html->css('consult/style.css') ?>
    <!-- Font Awesome -->
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') ?>   
    <?= $this->Html->script('consult/modernizr.custom.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<div class="container">
		<div class="hero">
			<div class="hero__back hero__back--static"></div>
			<div class="hero__back hero__back--mover"></div>
			<div class="hero__front"></div>
		</div>
		<header class="codrops-header">
			<!--div class="codrops-links">
				<a class="codrops-icon codrops-icon--prev" href="http://tympanus.net/Development/InteractiveColoringConcept/" title="Previous Demo"><span>Previous Demo</span></a>
				<a class="codrops-icon codrops-icon--drop" href="http://tympanus.net/codrops/2015/05/06/photography-website-concept/" title="Back to the article"><span>Back to the Codrops article</span></a>
			</div>
			<h1 class="codrops-title">Christian Zana <span>Photography</span></h1-->
			<nav class="menu">
				<a class="menu__item" href="#"><span>About</span></a>
				<!--a class="menu__item menu__item--current" href="#"><span>Dashboard</span></a-->
                                <?= $this->Html->link('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'menu__item menu__item--current']); ?>
				<!--a class="menu__item" href="#"><span>Contact</span></a-->
			</nav>
		</header>
		<div class="stack-slider">
			<div class="stacks-wrapper">
				<?=$this->fetch('content');?>
			</div>
			<!-- /stacks-wrapper -->
		</div>
		<!-- /stacks -->
                <?= $this->Html->image('consult/three-dots.svg', ['class' => 'loader', 'width' => '60', 'alt' => 'Loader image']); ?>
	</div>
    
	<!-- /container -->
	<!-- Flickity v1.0.0 http://flickity.metafizzy.co/ -->
        <?= $this->Html->script('consult/flickity.pkgd.min.js'); ?>
        <?= $this->Html->script('consult/smoothscroll.js'); ?>
        <?= $this->Html->script('consult/main.js'); ?>
</body>
</html>