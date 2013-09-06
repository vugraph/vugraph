<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ClearInactiveUsers extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'task:clear-inactive-users';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete inactive users that are older than a threshold value.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$query = 'DELETE FROM users WHERE activated=0 AND created_at < DATE_SUB(NOW(), INTERVAL '.intval($this->option('hours')).' HOUR)';
		$cnt = DB::delete($query);
		$this->line($cnt.' rows were deleted.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
/*	protected function getArguments()
	{
		return array(
			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	} */

	/**
	 * Get the console command options.
	 *
	 * @return array
     * $name        The option name
     * $shortcut    The shortcut (can be null)
     * $mode        The option mode: One of the InputOption::VALUE_* constants
     * $description A description text
     * $default     The default value (must be null for InputOption::VALUE_REQUIRED or InputOption::VALUE_NONE)

	 */
	protected function getOptions()
	{
		return array(
			array('hours', null, InputOption::VALUE_OPTIONAL, 'Threshold in hours.', '48')
		);
	}

}