<?php

class Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Checkawb extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

	public function render(Varien_Object $row)
	{
		$value = $row->getData($this->getColumn()->getIndex());
		if ($value > 0)
			return '<a href="'.$this->changeUrl($row->getEntityId()).'">'.$value.'<a>';
		else
			return 'none';
	}
	public function changeUrl($id){
		$adminUrl = (string)Mage::getConfig()->getNode('admin/routers/adminhtml/args/frontName');
		$name = $this->getUrl('/sales_order/view', array('order_id' => $id));
		$url = str_replace('dhlshipment', $adminUrl, $name);
		return $url;
	}
}

?>
