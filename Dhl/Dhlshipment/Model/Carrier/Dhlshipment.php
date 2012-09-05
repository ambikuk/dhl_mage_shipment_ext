<?php

/*
 * Dhlshipment
 * ambikuk@gmail.com
 * technolyze.net
 */

class Dhl_Dhlshipment_Model_Carrier_Dhlshipment extends Dhl_Dhlshipment_Model_Carrier_Abstract
{

	public function __construct()
	{
		$timestamp = time();
		$this->time = date('c', $timestamp);
		$data = array();
		for ($i = 0; $i < 31; $i++)
		{
			$data[$i] = rand(1, 9);
		}
		$this->mref = implode('', $data);
	}
	protected $_code = 'dhlshipment';

//	public function getGatewayUrl()
//	{
//		return $this->getConfigData('gateway_url');
//	}
//
//	public function getXmlUserId()
//	{
//		return $this->getConfigData('id');
//	}
//
//	public function getXmlPassword()
//	{
//		return $this->getConfigData('password');
//	}
//
//	public function getXmlPaymentCountry()
//	{
//		return $this->getConfigData('payment_country');
//	}
//
//	public function getXmlWeightUnit()
//	{
//		return $this->getConfigData('weight_unit');
//	}
//
//	public function getXmlDimensionUnit()
//	{
//		return $this->getConfigData('dimension_unit');
//	}
//
//	public function getXmlPaymentAccountNumber()
//	{
//		return $this->getConfigData('payment_account_number');
//	}
//
//	public function getXmlNetworkTypeCode()
//	{
//		return $this->getConfigData('network_type_code');
//	}
//
//	public function getXmlDuitableFlag()
//	{
//		return $this->getConfigData('duitable_flag');
//	}
//
//	public function getXmlDuitableCurrency()
//	{
//		return $this->getConfigData('dutiable_currency');
//	}
//
//	public function getXmlGlobalProductCode()
//	{
//		return $this->getConfigData('global_product_code');
//	}
//
//	public function getXmlReadyTimeGmt()
//	{
//		return $this->getConfigData('ready_time_gmt');
//	}
//
//	public function getXmlShipmentType()
//	{
//		return $this->getConfigData('shipment_type');
//	}
//
//	public function getXmlAllowedMethods()
//	{
//		return $this->getConfigData('allowed_methods');
//	}
//
//	public function getXmlTransitTime()
//	{
//		return $this->getConfigData('transit_time');
//	}
//
//	public function getXmlAddTransitDay()
//	{
//		return $this->getConfigData('add_transit_day');
//	}
//
//	public function getXmlShowPayment()
//	{
//		return $this->getConfigData('show_payment');
//	}
//
//	public function getXmlHandlingFee()
//	{
//		return $this->getConfigData('handling_fee');
//	}
//
//	public function getXmlXmlDebug()
//	{
//		return $this->getConfigData('xml_debug');
//	}
//	
//	public function getXmlCreditMemoReturn()
//	{
//		return $this->getConfigData('credit_memo_return');
//	}
	
	public function getConfigXml($xmlName)
	{
		return $this->getConfigData($xmlName);
	}

	public function getCode($type, $code = '')
	{
		static $codes;
		$codes = array(
			'service' => array(
				'1' => Mage::helper('dhlshipment')->__('CUSTOMS SERVICES'),
				'3' => Mage::helper('dhlshipment')->__('EASY SHOP'),
				'4' => Mage::helper('dhlshipment')->__('JETLINE'),
				'8' => Mage::helper('dhlshipment')->__('EXPRESS EASY'),
				'E' => Mage::helper('dhlshipment')->__('EXPRESS 9:00'),
				'F' => Mage::helper('dhlshipment')->__('FREIGHT WORLDWIDE'),
				'H' => Mage::helper('dhlshipment')->__('ECONOMY SELECT'),
				'J' => Mage::helper('dhlshipment')->__('JUMBO BOX'),
				'M' => Mage::helper('dhlshipment')->__('EXPRESS 10:30'),
				'P' => Mage::helper('dhlshipment')->__('EXPRESS WORLDWIDE'),
				'Q' => Mage::helper('dhlshipment')->__('MEDICAL EXPRESS'),
				'V' => Mage::helper('dhlshipment')->__('EUROPACK'),
				'Y' => Mage::helper('dhlshipment')->__('EXPRESS 12:00')
			),
			'shipment_type' => array(
				'P' => Mage::helper('dhlshipment')->__('Single'),
				'M' => Mage::helper('dhlshipment')->__('Multiple'),
			),
			'show_payment' => array(
				'T' => Mage::helper('dhlshipment')->__('Total'),
				'B' => Mage::helper('dhlshipment')->__('Breakdown'),
			),
			'creditmemoreturn' => array(
				'A' => Mage::helper('dhlshipment')->__('Automatic'),
				'M' => Mage::helper('dhlshipment')->__('Manual'),
			),
		);


		if (!isset($codes[$type]))
		{
			return false;
		}
		elseif ('' === $code)
		{
			return $codes[$type];
		}

		if (!isset($codes[$type][$code]))
		{
			return false;
		}
		else
		{
			return $codes[$type][$code];
		}
	}

}
