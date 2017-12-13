
    <?php
    $DOCUMENT = HtmlDocument::getCurrentInstance();

    $DOCUMENT -> addHeader('<meta http-equiv="content-type" content="text/html" charset="UTF-8"/>','LAST');
    $DOCUMENT -> addHeader('<meta name="robots" content="noindex,follow">','LAST');
    $DOCUMENT -> addHeader('<link rel="stylesheet" type="text/css" media="all" href="templates/default/styles/style.css">','LAST');
    $DOCUMENT -> addHeader('<link rel="stylesheet" type="text/css" media="all" href="templates/default/styles/boat.css">','LAST');
    if(!$DOCUMENT->isHeaderSet('title'))$DOCUMENT->addUniqueHeader('title','<title>Amap pain</title>' );
    ?>

<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<h1 id="site-title"><span><a href="https://wp-themes.com/" title="Theme Preview" rel="home">Amap Pain</a></span></h1>
				<div id="site-description">Previewing Another WordPress Blog</div>
				<img src="images/banniere.jpg" alt="" height="313" width="980">
			</div><!-- #branding -->
			<nav id="access" role="navigation">
				<div class="skip-link screen-reader-text"><a href="#content" title="Skip to content">Skip to content</a></div>
				<div class="menu">
					<ul>
						<li class="page_item page-item-2"><a href="?page_id=2">Accueil</a></li>
                        <li class="page_item page-item-3"><a href="?page=personne/personne">Clients</a></li>
						<li class="page_item page-item-46 page_item_has_children">
                            <a href="?page=commande/commande">Commandes</a>
                            <ul class="children">
                                <li class="page_item page-item-49">
                                    <a href="?page=commande/commande-date">Semaine</a>
                                </li>
                                <li class="page_item page-item-49">
                                    <a href="?page=commande/commande">Toutes</a>
                                </li>
                            </ul>
                        </li>

                        <li class="page_item page-item-4"><a href="?page=cheque/cheque">Chèques</a></li>
                        <li class="page_item page-item-5"><a href="?page=pain/pain">Pains</a></li>
                        <li class="page_item page-item-5"><a href="?page=commande/commande-semaine">Test</a></li>
					</ul>
				</div>
			</nav><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">
        <div id="container">
            <main id="content" role="main">
                <?php
                echo HtmlDocument::getCurrentInstance()->getMainContent();
                ?>
            </main>
        </div>
    </div>

	<div id="footer" role="contentinfo">
		<div id="colophon">



			<div id="site-info">
				<a href="https://wp-themes.com/" title="Theme Preview" rel="home">
					Amap Pain				</a>
			</div><!-- #site-info -->

			<div id="site-generator">
								<a href="https://wordpress.org/" title="Semantic Personal Publishing Platform">Proudly powered by WordPress.</a>
			</div><!-- #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->
