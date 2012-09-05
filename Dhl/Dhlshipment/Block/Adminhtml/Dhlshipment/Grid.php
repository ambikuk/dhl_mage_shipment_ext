<?php

class Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

	public function __construct()
	{
		parent::__construct();
		$this->setId('dhlshipment');
		$this->setUseAjax(true);
		$this->setDefaultSort('created_at');
		$this->setDefaultDir('DESC');
		$this->setSaveParametersInSession(true);
	}

	protected function _getCollectionClass()
	{
		return 'sales/order_grid_collection';
	}

	protected function _prepareCollection()
	{
//		$collection = Mage::getResourceModel($this->_getCollectionClass());
		$collection = Mage::getModel('dhlshipment/dhlshipment')->getCollection();
		$collection->getSelect()->join(
				array('order' => 'sales_flat_order_grid'), 'main_table.order_id=order.increment_id', array('order.*'));
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
//		$this->addColumn('id', array(
//			'header' => Mage::helper('dhlshipment')->__('ID'),
//			'align' => 'right',
//			'width' => '50px',
//			'index' => 'id',
//		));
		$this->addColumn('real_order_id', array(
			'header' => Mage::helper('sales')->__('Order #'),
			'width' => '80px',
			'type' => 'text',
			'index' => 'increment_id',
		));
		$this->addColumn('billing_name', array(
			'header' => Mage::helper('sales')->__('Bill to Name'),
			'index' => 'billing_name',
		));

		$this->addColumn('shipping_name', array(
			'header' => Mage::helper('sales')->__('Ship to Name'),
			'index' => 'shipping_name',
		));
		$this->addColumn('grand_total', array(
			'header' => Mage::helper('sales')->__('G.T. (Purchased)'),
			'index' => 'grand_total',
			'type' => 'currency',
			'currency' => 'order_currency_code',
		));
		$config = new Dhl_Dhlshipment_Model_Carrier_Dhlshipment();
		if ($config->getConfigXml('xml_debug') == 1)
		{
			$this->addColumn('status', array(
				'header' => Mage::helper('dhlshipment')->__('Xml Sipment Validation'),
				'align' => 'left',
				'index' => 'tracking_awb',
				'renderer' => 'Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Xmltracking'
			));
		}
		$this->addColumn('tracking_awb', array(
			'header' => Mage::helper('dhlshipment')->__('Shipment Validation'),
			'align' => 'left',
			'index' => 'tracking_awb',
			'renderer' => 'Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Awb'
		));
		if ($config->getConfigXml('xml_debug') == 1)
		{
			$this->addColumn('status_pickup', array(
				'header' => Mage::helper('dhlshipment')->__('Xml Pickup'),
				'align' => 'left',
				'index' => 'pickup',
				'renderer' => 'Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Xmlpickup'
			));
		}
		$this->addColumn('pickup', array(
			'header' => Mage::helper('dhlshipment')->__('Pickup'),
			'align' => 'left',
			'index' => 'pickup',
			'renderer' => 'Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Pickup'
		));
		if ($config->getConfigXml('xml_debug') == 1)
		{
			$this->addColumn('status_return', array(
				'header' => Mage::helper('dhlshipment')->__('Xml Return'),
				'align' => 'left',
				'index' => 'return_awb',
				'renderer' => 'Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Xmlreturn'
			));
		}
		$this->addColumn('return_awb', array(
			'header' => Mage::helper('dhlshipment')->__('Return Awb'),
			'align' => 'left',
			'index' => 'return_awb',
			'renderer' => 'Dhl_Dhlshipment_Block_Adminhtml_Dhlshipment_Returnawb'
		));

//		$this->addColumn('action', array(
//			'header' => Mage::helper('dhlshipment')->__('Action'),
//			'width' => '200',
//			'type' => 'action',
//			'getter' => 'getId',
//			'actions' => array(
//				array(
//					'caption' => Mage::helper('dhlshipment')->__('Edit'),
//					'url' => array('base' => '*/*/edit'),
//					'field' => 'id'
//				),
////				array(
////					'caption' => Mage::helper('sales')->__('View'),
////					'url' => array('base' => '../index.php/admin/sales_order/view'),
////					'field' => 'order_id'
////				)
//			),
//			'filter' => false,
//			'sortable' => false,
//			'index' => 'tracking_awb',
//			'is_system' => false,
//		));

		$this->addExportType('*/*/exportCsv', Mage::helper('dhlshipment')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('dhlshipment')->__('XML'));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
//		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}