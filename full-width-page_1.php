	<?php
	/* MODIFICA PJ */

		// Gli argomenti
		// elenco delle specifiche degli argomenti > https://codex.wordpress.org/it:Riferimento_classi/WP_Query
		$args = array (
			'post_status' => 'publish', // solo gli articoli pubblicati
			'posts_per_page' => -1, // -1 vuol dire tutti, se invece si mette un numero positvo come 5 o 10, restituisce 5 o 10 articoli
			'cat' => 129, // indica l'ID della categoria dove filtrare gli articoli
			'orderby' => 'title', // se si vuole ordinare per titolo
			'order' => 'ASC' // ASC o DESC > crescente o discindente ?
		);

		/* La Query */
		$query = new WP_Query( $args );

		/*
		L'obiettivo è di creare un elenco <ul> in codice HTML
		dove gli elementi listati sono generati dal PHP.
		Il PHP con una QUERY (simile a SQL) interroga il DB di Wordpress
		ed estrae i dati, li ordina e li filtra in base alla categoria scelta

		Esempio HTML che si vuole ricostruire

		<ul>
			<li><a href="http://indirizzourl_1.html">Titolo Articolo 1</a></li>
			<li><a href="http://indirizzourl_2.html">Titolo Articolo 2</a></li>
			<li>...</li>
		</ul>

		*/

		echo "<ul>";

		// inizio del LOOP
		while( $query->have_posts() ):

			$query->next_post();
			$link_articolo = get_permalink( $query->post->ID );
			$titolo_articolo = get_the_title( $query->post->ID );

			echo "<li><a href='$link_articolo'>$titolo_articolo</a></li>";

		endwhile;
		// fine del LOOP

		echo "</ul>";

		// Ripristina Query & Post Data originali
		wp_reset_query();
		wp_reset_postdata();

	/* MODIFICA PJ END */

?>
