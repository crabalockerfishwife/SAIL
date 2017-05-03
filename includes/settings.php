<?php

	//Array of fields used in Albums table
	$album_fields = array(
		array( 
			'term' => 'album_id',
			'heading' => 'Album ID',
			'filter' => FILTER_SANITIZE_NUMBER_INT,
		),
		array( 
			'term' => 'title',
			'heading' => 'Title',
			'filter' => FILTER_SANITIZE_STRING,
		),
		array( 
			'term' => 'date_created',
			'heading' => 'Date Created',
			'filter' => null,
		),
		array( 
			'term' => 'date_modified',
			'heading' => 'Date Modified',
			'filter' => null,
		),
		array( 
			'term' => 'description',
			'heading' => 'Description',
			'filter' => FILTER_SANITIZE_STRING,
		),
		array( 
			'term' => 'num_images',
			'heading' => 'Number of Images',
			'filter' => FILTER_SANITIZE_NUMBER_INT,
		),
	);

	//Array of fields used in Images table
	$image_fields = array(
		array( 
			'term' => 'image_id',
			'heading' => 'Image ID',
			'filter' => FILTER_SANITIZE_NUMBER_INT,
		),
		array( 
			'term' => 'title',
			'heading' => 'Title',
			'filter' => FILTER_SANITIZE_STRING,
		),
		array( 
			'term' => 'caption',
			'heading' => 'Caption',
			'filter' => FILTER_SANITIZE_STRING,
		),
		array( 
			'term' => 'file_name',
			'heading' => 'Filename',
			'filter' => FILTER_SANITIZE_STRING,
		),
		array( 
			'term' => 'credit',
			'heading' => 'Credit',
			'filter' => FILTER_SANITIZE_STRING,
		),
	);

	//Array of fields used in ImageInAlbum table
	$imageinalbum_fields = array(
		array( 
			'term' => 'album_id',
			'heading' => 'Album ID',
			'filter' => FILTER_SANITIZE_NUMBER_INT,
		),
		array( 
			'term' => 'image_id',
			'heading' => 'Image ID',
			'filter' => FILTER_SANITIZE_NUMBER_INT,
		),
	);

?>