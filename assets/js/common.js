$(function() {

	var $delete_article = $('.delete_entry');

	if ($delete_article.length) {

		$delete_article.click(function() {

			return confirm("Do you really want to delete entry?");

		});

	}

});