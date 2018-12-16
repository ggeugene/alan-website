jQuery(function($){

	var $lang = jQuery('html').attr('lang');
	var $defaulTtext,
			$loadingText;

	switch($lang) {
		case 'ru-RU':
			$defaulTtext = 'Загрузить еще';
			$loadingText = 'Загрузка...';
			break;
		case 'en-US':
			$defaulTtext = 'Load More';
			$loadingText = 'Loading...';
			break;
		case 'uk-UA':
		default:
			$defaulTtext = 'Завантажити ще';
			$loadingText = 'Завантаження...';
			break;
	}

	$('.loadmore').text($defaulTtext);
	$('.loadmore').click(function(){

		var button = $(this),
		    data = {
			'action': 'loadmore',
			'page' : button.parent().prev('ul').data('page'),
		    'tag': button.parent().prev('ul').data('tag'),
		    'cat': button.parent().prev('ul').data('cat')
		};

		$.ajax({
			url : workrocks_products_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
                button.text($loadingText); // change the button text, you can also add a preloader image
                console.dir(data);
			},
			success : function( data ){
                console.dir(data);
				if( data ) {
					button.text($defaulTtext).parent().prev('ul').append(data); // insert new posts
					button.parent().prev('ul').data().page++;
					console.log(button.parent().prev('ul').data().page);
					if ( button.parent().prev('ul').data('page') == button.parent().prev('ul').data('pages') )
						button.remove(); // if last page, remove the button
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});
