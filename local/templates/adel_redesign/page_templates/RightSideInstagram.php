<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php
	/**
	 * by Studio Benefit.
	 * User: i_Mrz
	 * Date: 02.10.2017
	 */

	/*Переменные*/
	$tocen  = "5315426658.ba4c844.0aabcee3c6554ca0a22e6896233193c7"; # Ключь для доступа получил тут http://instagramwordpress.rafsegat.com/docs/get-access-token/
	$user   = "apteka_adel"; # От кого получать посты
	$num    = 10; # Количество выводимых постов

	/*Функции*/
	function go_curl($url)
	{
		$go_c = curl_init();
		curl_setopt( $go_c, CURLOPT_URL, $url );
		curl_setopt( $go_c, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $go_c, CURLOPT_TIMEOUT, 20 );
		$json_return = curl_exec( $go_c );
		curl_close( $go_c ); return json_decode( $json_return );
	}

	/* Получаем id пользователя */
	$go_user = go_curl("https://api.instagram.com/v1/users/search?q=" . $user . "&access_token=" . $tocen);
	$user_id = $go_user->data[0]->id;

	/* Получаем посты */
	$return = go_curl("https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $tocen.'&count='. $num);

?>


<!--<?php //print_r($return->data); ?>-->

<style>
		
		/* Использует */
		.inst_widget {
			width: 100%;
			padding: 10px;
		}
		
		.inst_widget:after {content:' '; display:block; clear:both; width:100%}
		
		.inst_widget > a.item {
			display: block;
			width: 50%;
			float: left;
			padding: 3px;
		}
		.inst_widget > a.item img {
			transition: transform 300ms;
		}
		.inst_widget > a.item:hover img {
			transform: scale(1.05);
		}
		.inst_widget > a.item:nth-child(n+7) {
			display: none;
		}
		.inst_widget img {
			max-width: 100%;
		}

		@media (min-width: 768px) and (max-width: 1024px) {
			.inst_widget {
				width: 100%;
			}
			.inst_widget > a.item {
				width: 20%;
			}
		  .inst_widget > a.item:nth-child(n+7) {
			  display: block;
		  }
		}

	</style>

<div class="widget">
    <div class="title">Наш инстраграм</div>
   
   <!--<script src="https://lightwidget.com/widgets/lightwidget.js"></script>
    <iframe src="https://lightwidget.com/widgets/bcc638e5503959c49767e5f3d2b77e1b.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>-->
    
    
    <!-- INSTAGRAM WIDGET -->
		<div class="inst_widget">
			<?php foreach ($return->data as $item) : ?>
				<a href="<?=$item->link?>" class="item" target="_blank" rel="nofollow">
					<img src="<?=$item->images->standard_resolution->url?>" alt="Аптека Adel в Instagram"/>
				</a>
			<?php endforeach; ?>
		</div>
    

    <a href="https://www.instagram.com/apteka_adel/" target="_blank" class="btn">Подписаться</a>
</div>
<?
/*
if($USER->IsAdmin()):
	echo "<pre>"; echo print_r($return); echo "</pre>";
endif;
*/
?>