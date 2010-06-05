<?php
interface Ezer_IntBusinessProcess extends Ezer_IntScope
{
	/**
	 * @return array<Ezer_IntImport>
	 */
	public function getImports();
	
	/**
	 * @param array $variables
	 * @return Ezer_BusinessProcessInstance
	 */
	public function &createBusinessProcessInstance(array $variables);
}