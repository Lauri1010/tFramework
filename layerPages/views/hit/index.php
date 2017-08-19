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
			<h1>Analytics testing</h1>
			<table class="pure-table">
			<thead>
        	<tr>
            	<th>Page title</th>
           	 	<th>Request_ip</th>
           	 	<th>Email</th>
           	 	<th>event_type_description</th>
           	 	<th>html_classes</th>
        	</tr>
    		</thead>
    		<tbody>
			<?php 
			
				foreach($this->af->hits as $hit){
					echo "<tr>";
					echo "<td>".$hit['page_title']."</td>";
					echo "<td>".$hit['request_ip']."</td>";
					echo "<td>".$hit['email']."</td>";
					echo "<td>".$hit['event_type_description']."</td>";
					echo "<td>".$hit['html_classes']."</td>";
					echo "</tr>";
				}
			
			?>
			</tbody>
			</table>
		</div>
	</div>
</div>