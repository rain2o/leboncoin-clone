<?php

namespace App\Utils;

/**
 * Class Slugger
 * @package App\Utils
 */
class Slugger
{

	/**
	 * Converts string to url-friendly slug.
	 *
	 * @param string $value
	 * @return string
	 */
	public function slugify( string $value ): string
	{
		return preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($value));
	}

}