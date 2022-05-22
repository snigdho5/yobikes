<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Auth_model extends MY_Model
{


	function __construct()
	{
		$this->table = 'users';
		$this->primary_key = 'user_id';
	}

	//users
	public function addUser($data)
	{
		$this->table = 'users';
		return $this->store($data);
	}
	public function getUserData($param = null, $many = FALSE)
	{
		$this->table = 'users';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} elseif ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by = 'user_id', $order = 'DESC', FALSE);
		} else {
			return $this->get_many();
		}
	}


	public function updateUser($data, $param)
	{
		$this->table = 'users';
		return $this->modify($data, $param);
	}
	public function delUser($param)
	{
		$this->table = 'users';
		return $this->remove($param);
	}

	//cnf
	public function addCNFEntry($data)
	{
		$this->table = 'mt_cnf_entry';
		return $this->store($data);
	}

	public function getCNFEntryData($param = null, $many = FALSE, $order_by = 'entry_id', $order = 'DESC')
	{
		$this->table = 'mt_cnf_entry';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	
	public function getCNFEntryUserData($param = null, $many = FALSE, $order = 'DESC', $order_by = 'mt_cnf_entry.entry_id', $group_by = FALSE)
	{

		$this->db->select('mt_cnf_entry.*, users.full_name AS full_name');

		$this->db->join('users', 'users.user_id = mt_cnf_entry.added_by', 'inner');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('mt_cnf_entry');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}

	public function updateCNFEntry($data, $param)
	{
		$this->table = 'mt_cnf_entry';
		return $this->modify($data, $param);
	}

	public function delCNFEntry($param)
	{
		$this->table = 'mt_cnf_entry';
		return $this->remove($param);
	}


	//cnf billing
	public function addCNFBilling($data)
	{
		$this->table = 'tbl_cnf_billing';
		return $this->store($data);
	}

	public function getCNFBillingData($param = null, $many = FALSE, $order_by = 'billing_id', $order = 'DESC')
	{
		$this->table = 'tbl_cnf_billing';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function updateCNFBilling($data, $param)
	{
		$this->table = 'tbl_cnf_billing';
		return $this->modify($data, $param);
	}

	public function delCNFBilling($param)
	{
		$this->table = 'tbl_cnf_billing';
		return $this->remove($param);
	}



	public function getCNFBillingList($param = null, $many = FALSE, $order = 'DESC', $order_by = 'tbl_cnf_billing.billing_id', $group_by = FALSE)
	{

		$this->db->select('tbl_cnf_billing.*, mt_cnf_entry.*, users.full_name AS dealer_full_name');

		$this->db->join('mt_cnf_entry', 'mt_cnf_entry.entry_id = tbl_cnf_billing.cnf_entry_id', 'inner');
		$this->db->join('users', 'users.user_id = tbl_cnf_billing.dealer_user_id', 'left');

		if ($param != null) {
			$this->db->where($param);
		}

		if ($group_by == TRUE) {
			$this->db->group_by('billing_uniqid');
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('tbl_cnf_billing');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}






	//dealer billing
	public function addDealerBilling($data)
	{
		$this->table = 'tbl_dealer_billing';
		return $this->store($data);
	}

	public function getDealerBillingData($param = null, $many = FALSE, $order_by = 'dealer_billing_id', $order = 'DESC')
	{
		$this->table = 'tbl_dealer_billing';
		if ($param != null && $many == FALSE) {
			return $this->get_one($param);
		} else if ($param != null && $many == TRUE) {
			return $this->get_many($param, $order_by, $order, FALSE);
		} else {
			return $this->get_many(null, $order_by, $order, FALSE);
		}
	}

	public function updateDealerBilling($data, $param)
	{
		$this->table = 'tbl_dealer_billing';
		return $this->modify($data, $param);
	}

	public function delDealerBilling($param)
	{
		$this->table = 'tbl_dealer_billing';
		return $this->remove($param);
	}



	public function getDealerBillingList($param = null, $many = FALSE, $order = 'DESC', $order_by = 'tbl_dealer_billing.dealer_billing_id', $group_by = FALSE)
	{

		$this->db->select('tbl_dealer_billing.*, mt_cnf_entry.*, users.full_name AS dealer_full_name');

		$this->db->join('mt_cnf_entry', 'mt_cnf_entry.entry_id = tbl_dealer_billing.cnf_entry_id', 'inner');
		$this->db->join('users', 'users.user_id = tbl_dealer_billing.dealer_user_id', 'left');

		if ($param != null) {
			$this->db->where($param);
		}

		if ($group_by == TRUE) {
			$this->db->group_by('billing_uniqid');
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('tbl_dealer_billing');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row();
		} else {
			return $query->result();
		}
	}



}
