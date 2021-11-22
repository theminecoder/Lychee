<?php

namespace App\Actions\Albums;

use App\Actions\ReadAccessFunctions;
use App\Facades\AccessControl;
use App\Models\Configs;
use Illuminate\Support\Collection as BaseCollection;

class Prepare
{
	/**
	 * @var ReadAccessFunctions
	 */
	private $readAccessFunctions;

	public function __construct(ReadAccessFunctions $readAccessFunctions)
	{
		$this->readAccessFunctions = $readAccessFunctions;
	}

	/**
	 * Given a list of albums, generate an array to be returned.
	 *
	 * @param BaseCollection[Album] $albums
	 *
	 * @return array
	 */
	public function do(BaseCollection $albums)
	{
		$return = [];
		foreach ($albums as $_ => $album) {
			$album_array = $album->toReturnArray();

			if (AccessControl::is_logged_in()) {
				$album_array['owner'] = !Configs::get_value("single_library", false) ? $album->owner->name() : AccessControl::user()->name();
			}

			// Add to return
			$return[] = $album_array;
		}

		return $return;
	}
}
