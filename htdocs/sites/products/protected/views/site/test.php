<?php 
namespace tFramework;
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'views'.DS.'snipplets'.DS.'tSnipplet.php';
?>
<div id="layout" class="pure-g">
	<div id="sidebar" class="sidebar pure-u-1 pure-u-md-1-4">
		<div id="header" class="header">
			<h1 class="brand-title">Diimo</h1>
			<h2 class="brand-tagline">Ammattilaiset vastaavat</h2>
			<nav class="nav">
				<ul class="nav-list">
					<li class="nav-item">
						<a class="pure-button" href="">PHP ohjelmointi?</a>
					</li>
					<li class="nav-item">
						<a class="pure-button" href="">Tietoja aiheesta x?</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div id="content" class="content pure-u-1 pure-u-md-3-4">
		<div>
			<p id="test">hello test</p>
			<h1>Main homepage</h1>
			<a 
			data-tta="true" 
			data-ttal="Product Page Click"
			href="http://<?php echo HOST; ?>/product?pr=1">Product</a>
			<a 
			data-tta="true" 
			data-ttal="Google"
			href="http://www.google.fi">www.google.fi</a>
			<!-- <a href="http://<?php // echo HOST; ?>/cms">CMS</a> -->
			<?php // echo $this->loggedIn; ?>
		</div>
	</div>
</div>