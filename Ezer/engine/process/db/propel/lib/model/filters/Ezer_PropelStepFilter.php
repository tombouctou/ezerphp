<?php


/**
 * @package    lib.filter
 */
class Ezer_PropelStepFilter extends Ezer_PropelFilter
{
	public function __construct()
	{
		parent::__construct(new Ezer_PropelStepPeer());
	}
}
