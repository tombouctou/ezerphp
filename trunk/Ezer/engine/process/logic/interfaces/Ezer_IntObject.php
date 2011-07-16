<?php
interface Ezer_IntObject
{
	/**
	 * @return array<string> custom data fields
	 */
	public function getCustomFields();
	
	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return Ezer_IntPeer
	 */
	public function getPeer();
}