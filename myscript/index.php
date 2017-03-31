<?php
echo <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MySedona</title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=League Gothic">
	<link rel="stylesheet" type="text/css" href="./css/index.css">
</head>


<body>



	<header class="header-main">
		<div class="header-main__bg">
			<div class="header-main__wrap">
				<div class="header-main__icon-logo"></div>
				<nav class="header-main__nav">
					<ul>
						<li class="header-main__nav--active"><a href="">our story</a></li>
						<li><a href="">services</a></li>
						<li><a href="">work</a></li>
						<li><a href="">journal</a></li>
						<li><a href="">contact</a></li>
						<li><a href="">work</a></li>
						<li><a href="">journal</a></li>
					</ul>
				</nav>
				<a class="button button--menu">call us</a>
			</div>
		</div>
		<div class="header-main__wrap header-main__wrap--h1">
			<h1 class="header-main__h1 header-main__h1--none">
				travel with us to the Montains
			</h1>
			<img src="./img/header-nav__h1.png" class="header-main__h1-vector" alt="to the Montains">
			<p class="header-main__descr">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidid
			</p>
			<a class="button button--h1">order now</a>
		</div>
	</header>



	<article class="blog">
		<div class="blog__wrap">
			<div class="icon-polyline icon-polyline--blog"></div>
			<div class="blog__about">about us</div>
			<h1 class="blog__h1">
				Aliquam sed posuere urna, et gravida nisl. Praesent interdum nist libero, pretuim egestas purus eleifend vitae. Marius suscipit vel lectus at luctus.
			</h1>
			<a class="button button--blog">read more</a>
			<img src="./img/blog_bg1.jpg" alt="" class="blog__bg1">
			<img src="./img/blog_bg2.jpg" alt="" class="blog__bg2">
		</div>
	</article>



	<article class="journal">
		<div class="journal__wrap">
			<div class="icon-polyline icon-polyline--journal"></div>
			<h1 class="jornal__h1">our journal</h1>
		</div>

		<div class="journal__post-wrap">
			<section class="journal__post journal__post--water">
				<a href="#">
					<div class="journal__pic journal__pic--water">
						<div class="icon-journal-drop icon-journal-drop--pos"></div>
						<div class="icon-journal__post-bg icon-journal__post-bg--water-pos"></div>
					</div>
					<div class="journal__post-dsc journal__post-dsc--water">
						<div class="journal__post-title">water</div>
						<h1 class="journal__post-h1">LITTLE PIECES OF<br>OUR PROUDNESS</h1>
						<p class="journal__post-p">What do you do better than your<br>competitors? What are you proud of? What details and advantages of your product you want people to know about?</p>
						<p class="journal__post-num">03</p>
					</div>
				</a>
			</section>

			<section class="journal__post">
				<a href="#">
					<div class="journal__pic journal__pic--love">
						<div class="icon-journal-heart icon-journal-heart--pos"></div>
						<div class="icon-journal__post-bg icon-journal__post-bg--heart-pos"></div>
					</div>
					<div class="journal__post-dsc">
						<div class="journal__post-title">love</div>
						<h1 class="journal__post-h1">Lorem ipsum dolor sit amet,<br>consectetur adipisicing elit, sed do</h1>
						<p class="journal__post-p">You know how to make best coffee in the universe? Or, maybe you’re very good in  designing gloves? Tell everyone about your experience and skills.</p>
						<p class="journal__post-num">01</p>
					</div>
				</a>
			</section>

			<section class="journal__post">
				<a href="#">
					<div class="journal__post-dsc journal__post-dsc--tree">
						<div class="journal__post-title">tree</div>
						<h1 class="journal__post-h1">Lorem ipsum dolor sit<br>amet,<s>consectetur</s><br>adipisicing elit.</h1>
						<p class="journal__post-p">The way to a successful brand is hard, but always very interesting. Share the full story of your project – from the very first day until now.</p>
						<p class="journal__post-num">02</p>
					</div>
					<div class="journal__pic journal__pic--tree">
						<div class="icon-journal-leaf icon-journal-leaf--pos"></div>
						<div class="icon-journal__post-bg icon-journal__post-bg--tree-pos"></div>
					</div>
				</a>
			</section>

		</div>
	</article>



	<div class="offer">
		<div class="offer__wrap">
			<div class="icon-polyline icon-polyline--offer"></div>
			<div class="offer__h1">do you wanna go?</div>
			<p class="offer__p">Aliquam sed posuere urna, et gravida nisl. Praesent<br> 
				interdum nisl libero, pretium egestas purus eleifend vitae. Mauris suscipit vel lectus at luctus.
			</p>

			<form class="offer__form">
				<div class="offer__form-text">Your name:</div>
				<input type="text" class="offer__form-name">

				<div class="offer__form-text offer__form-text--phone">Your phone:</div>
				<input type="text" class="offer__form-phone">

				<button class="button button--offer" type="submit">order now</button>
			</form>
			<br>
			<div class="icon-offer__locked icon-offer__locked--pos"></div>
			<div class="offer__warn">*Your data will not be transferred</div>
		</div>
	</div>



	<section class="scheme">
		<div class="scheme__wrap">
			<div class="icon-polyline icon-polyline--scheme"></div>
			<h1 class="scheme__h1">
				how we work
			</h1>
			<div class="scheme__bg1">
				<div class="scheme__circle"></div>
			</div>
			<div class="scheme__1234">
				<div class="icon-scheme__drop1 icon-scheme__drop1--pos"></div>

				<section class="scheme__block scheme__block--1">
					<div class="scheme__block-num scheme__block-num--1">1</div>
					<div class="scheme__block-icon scheme__block-icon--1">
						<div class="icon-scheme_bg icon-scheme_bg--pos"></div>
						<div class="icon-scheme_copy icon-scheme_copy--pos"></div>
					</div>
					<div class="scheme__block-h1 scheme__block-h1--1">Lorem ipsum dolor sit</div>
					<div class="scheme__block-p scheme__block-p--1">amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</div>
				</section>

				<section class="scheme__block scheme__block--1">
					<div class="scheme__block-num scheme__block-num--1">1</div>
					<div class="scheme__block-icon scheme__block-icon--1">
						<div class="icon-scheme_bg icon-scheme_bg--pos"></div>
						<div class="icon-scheme_pip icon-scheme_copy--pos"></div>
					</div>
					<div class="scheme__block-h1 scheme__block-h1--1">Lorem ipsum dolor sit</div>
					<div class="scheme__block-p scheme__block-p--1">amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</div>
				</section>

				<section class="scheme__block scheme__block--1">
					<div class="scheme__block-num scheme__block-num--1">1</div>
					<div class="scheme__block-icon scheme__block-icon--1">
						<div class="icon-scheme_bg icon-scheme_bg--pos"></div>
						<div class="icon-scheme_read icon-scheme_copy--pos"></div>
					</div>
					<div class="scheme__block-h1 scheme__block-h1--1">Lorem ipsum dolor sit</div>
					<div class="scheme__block-p scheme__block-p--1">amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</div>
				</section>

				<section class="scheme__block scheme__block--1">
					<div class="scheme__block-num scheme__block-num--1">1</div>
					<div class="scheme__block-icon scheme__block-icon--1">
						<div class="icon-scheme_bg icon-scheme_bg--pos"></div>
						<div class="icon-scheme_ok icon-scheme_copy--pos"></div>
					</div>
					<div class="scheme__block-h1 scheme__block-h1--1">Lorem ipsum dolor sit</div>
					<div class="scheme__block-p scheme__block-p--1">amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</div>
				</section>

				<div class="icon-scheme__drop2 icon-scheme__drop2--pos"></div>
			</div>	
		</div>
	</section>



	<article class="travel">
		<div class="travel__wrap">

			<div class="icon-polyline icon-polyline--travel"></div>
			<h1 class="travel__h1">travel with us</h1>

			<section class="travel__block travel__block--1">
				<a href="#">
					<div class="travel__star">
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
					</div>
					<h1 class="travel__block-h1">Carpathian</h1>
					<div class="travel__block-p">Lorem ipsum dolor si amet, consectetur</div>
					<div class="travel__block-price">
						<div class="travel__block-price-full">3150$</div>
						<div class="travel__block-price-sale">$793</div>
					</div>
				</a>
			</section>

			<section class="travel__block travel__block--2">
				<a href="#">
					<div class="travel__star">
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
					</div>
					<h1 class="travel__block-h1">Alps</h1>
					<div class="travel__block-p">Lorem ipsum dolor si amet, consectetur</div>
					<div class="travel__block-price">
						<div class="travel__block-price-full">3150$</div>
						<div class="travel__block-price-sale">$1893</div>
					</div>
				</a>
			</section>

			<section class="travel__block travel__block--3">
				<a href="#">
					<div class="travel__star">
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
					</div>
					<h1 class="travel__block-h1">Pyrenees</h1>
					<div class="travel__block-p">Lorem ipsum dolor si amet, consectetur</div>
					<div class="travel__block-price">
						<div class="travel__block-price-full">3150$</div>
						<div class="travel__block-price-sale">$2593</div>
					</div>
				</a>
			</section>

			<section class="travel__block travel__block--4">
				<a href="#">
					<div class="travel__star">
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
					</div>
					<h1 class="travel__block-h1">Rocky</h1>
					<div class="travel__block-p">Lorem ipsum dolor si amet, consectetur</div>
					<div class="travel__block-price">
						<div class="travel__block-price-full">3150$</div>
						<div class="travel__block-price-sale">$2123</div>
					</div>
				</a>
			</section>

			<section class="travel__block travel__block--5">
				<a href="#">
					<div class="travel__star">
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
						<div class="icon-star icon-star--travel"></div>
					</div>
					<h1 class="travel__block-h1">Kavkaz</h1>
					<div class="travel__block-p">Lorem ipsum dolor si amet, consectetur</div>
					<div class="travel__block-price">
						<div class="travel__block-price-full">3150$</div>
						<div class="travel__block-price-sale">$593</div>
					</div>
				</a>
			</section>

		</div>
	</article>



	<div class="gallery">
		<div class="gallery__wrap">
			<div class="icon-polyline icon-polyline--gallery"></div>
			<h1 class="gallery__h1">gallery</h1>

			<div class="gallery__col gallery__col--1">
				<img src="./img/gallery_bg1.jpg" alt="">
				<img src="./img/gallery_bg2.jpg" alt="">
			</div>
			<div class="gallery__col gallery__col--2">
				<img src="./img/gallery_bg3.jpg" alt="">
				<img src="./img/gallery_bg4.jpg" alt="">
			</div>
			<div class="gallery__col gallery__col--3">
				<img src="./img/gallery_bg5.jpg" alt="">
				<img src="./img/gallery_bg6.jpg" alt="">
			</div>
		</div>


		<!--<div class="gallery__wrap gallery__wrap--flex">
			<img src="./img/gallery_bg1.jpg" alt="">
			<img src="./img/gallery_bg2.jpg" alt="">
			<img src="./img/gallery_bg3.jpg" alt="">
			<img src="./img/gallery_bg4.jpg" alt="">
			<img src="./img/gallery_bg5.jpg" alt="">
			<img src="./img/gallery_bg6.jpg" alt="">
		</div>-->


	</div>



	<div class="logos">

		<div class="logos__wrap">
			<div class="icon-logos_slack"></div>
			<div class="icon-logos_delta"></div>
			<div class="icon-logos_google"></div>
			<div class="icon-logos_faceboock"></div>
			<div class="icon-logos_spotily"></div>
			<div class="icon-logos_nike"></div>
		</div>
		
	</div>



	<section class="our">
		<div class="our__wrap">

			<div class="icon-polyline icon-polyline--our"></div>
			<h1 class="gallery__h1">our clients say</h1>
			
			<div class="our__people">
				<div class="our__people-quot">"</div>
				<div class="our__people-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do  enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse </div>
				<div class="our__people-photo"></div>
				<div class="our__people-name"><b>Pavliv Yaroslav</b> Web designer</div>
			</div>

			<div class="our__people">
				<div class="our__people-quot">"</div>
				<div class="our__people-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do  enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse </div>
				<div class="our__people-photo"></div>
				<div class="our__people-name"><b>Pavliv Yaroslav</b> Web designer</div>
			</div>

			<form action="#" class="our__contact">
				<h1 class="our__contact-h1">contacts</h1>
				<h1 class="our__contact-p">Sign up for our newsletter to receive updates</h1>
				<input type="text" class="our__contact-name"  placeholder="Name">
				<input type="phone" class="our__contact-phone"  placeholder="Phone">
				<input type="email" class="our__contact-email"  placeholder="E-mail">
				<input type="send" class="our__contact-send" value="SEND">
			</form>

		</div>
	</section>



	<footer class="footer">
		<div class="footer__wrap">
			<div class="footer__copyr">All rights reserved 2015</div>
			<div class="footer__social">
				<a href="#" class="footer__twitter">
					<div class="icon-footer_twitter icon-footer_twitter--pos"></div>
				</a>
				<a href="#" class="footer__facebook">
					<div class="icon-footer_facebook icon-footer_facebook--pos"></div>
				</a>
				<a href="#" class="footer__vk">
					<div class="icon-footer_vk icon-footer_vk--pos"></div>
				</a>
			</div>
			<div class="footer__tel">1 234 243 123</div>
		</div>
	</footer>


</body>
</html>
END;
?>