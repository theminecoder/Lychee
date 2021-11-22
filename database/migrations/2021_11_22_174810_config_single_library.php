<?php

use App\Models\Configs;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ConfigSingleLibrary extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		defined('BOOL') or define('BOOL', '0|1');

		DB::table('configs')->insert([
			[
				'key' => 'single_library',
				'value' => '0',
				'confidentiality' => 3,
				'cat' => 'config',
				'type_range' => BOOL,
			],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Configs::where('key', '=', 'single_library')->delete();
	}
}
