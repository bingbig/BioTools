<?php
namespace BioTools\Tree;

class TreeFileFormat
{
	/**
	 * Turn array to newick format string
	 *
	 * @param array $tree
	 * @return string
	 */
	static public function ArrayToNewick (array $tree)
	{
		return self::JsonToNewick(json_encode($tree));
	}

	/**
	 * Turn Json to newick format string
	 *
	 * @param array $tree
	 * @return string
	 */

	static public function JsonToNewick ($tree)
	{
		return 'newick';
	}
}